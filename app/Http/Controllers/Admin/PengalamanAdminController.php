<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengalaman;
use App\Models\Klien;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PengalamanAdminController extends Controller
{
    public function index()
    {
        $query = Pengalaman::orderBy('tahun', 'desc')->orderBy('urutan');

        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        $pengalaman = $query->paginate(15)->withQueryString();
        return view('admin.pengalaman.index', compact('pengalaman'));
    }

    public function create()
    {
        $klienList = Klien::where('aktif', true)->orderBy('nama')->pluck('nama');
        return view('admin.pengalaman.form', ['pengalaman' => new Pengalaman(), 'action' => 'create', 'klienList' => $klienList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek'   => 'required|string|max:255',
            'pemberi_kerja' => 'required|string|max:255',
            'lokasi'        => 'nullable|string|max:150',
            'tahun'         => 'required|string|max:10',
            'deskripsi'     => 'nullable|string',
            'kategori'      => 'nullable|string|max:100',
            'urutan'        => 'nullable|integer',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galeri_proyek.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $data = $request->only(['nama_proyek', 'pemberi_kerja', 'lokasi', 'tahun', 'deskripsi', 'kategori', 'urutan']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('pengalaman/logo', 'public');
        }

        if ($request->hasFile('galeri_proyek')) {
            $galeri = [];
            foreach ($request->file('galeri_proyek') as $foto) {
                $galeri[] = $foto->store('pengalaman/galeri', 'public');
            }
            $data['galeri_proyek'] = $galeri;
        }

        Pengalaman::create($data);

        return redirect()->route('admin.pengalaman.index')->with('sukses', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit(Pengalaman $pengalaman)
    {
        $klienList = Klien::where('aktif', true)->orderBy('nama')->pluck('nama');
        return view('admin.pengalaman.form', ['pengalaman' => $pengalaman, 'action' => 'edit', 'klienList' => $klienList]);
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $request->validate([
            'nama_proyek'   => 'required|string|max:255',
            'pemberi_kerja' => 'required|string|max:255',
            'lokasi'        => 'nullable|string|max:150',
            'tahun'         => 'required|string|max:10',
            'deskripsi'     => 'nullable|string',
            'kategori'      => 'nullable|string|max:100',
            'urutan'        => 'nullable|integer',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'galeri_proyek.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $data = $request->only(['nama_proyek', 'pemberi_kerja', 'lokasi', 'tahun', 'deskripsi', 'kategori', 'urutan']);

        if ($request->hasFile('logo')) {
            if ($pengalaman->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($pengalaman->logo);
            }
            $data['logo'] = $request->file('logo')->store('pengalaman/logo', 'public');
        }

        // Always merge with existing gallery if uploading new ones
        if ($request->hasFile('galeri_proyek')) {
            $galeri = $pengalaman->galeri_proyek ?? [];
            foreach ($request->file('galeri_proyek') as $foto) {
                $galeri[] = $foto->store('pengalaman/galeri', 'public');
            }
            $data['galeri_proyek'] = $galeri;
        }

        // If user wants to delete specific images from gallery
        if ($request->filled('hapus_galeri')) {
            $toKeep = [];
            $toDelete = $request->hapus_galeri; 
            $existing = $pengalaman->galeri_proyek ?? [];
            foreach ($existing as $img) {
                if (in_array($img, $toDelete)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($img);
                } else {
                    $toKeep[] = $img;
                }
            }
            $updatedGaleri = $toKeep;
            if ($request->hasFile('galeri_proyek')) {
                foreach ($request->file('galeri_proyek') as $foto) {
                    $updatedGaleri[] = $foto->store('pengalaman/galeri', 'public');
                }
            }
             $data['galeri_proyek'] = $updatedGaleri;
        }

        $pengalaman->update($data);

        return redirect()->route('admin.pengalaman.index')->with('sukses', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        if ($pengalaman->logo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pengalaman->logo);
        }
        if ($pengalaman->galeri_proyek) {
            foreach ($pengalaman->galeri_proyek as $foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($foto);
            }
        }
        $pengalaman->delete();
        return redirect()->route('admin.pengalaman.index')->with('sukses', 'Pengalaman berhasil dihapus.');
    }

    // ── EXPORT ──────────────────────────────────────────────
    public function export()
    {
        $query = Pengalaman::orderBy('tahun', 'desc')->orderBy('urutan');
        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }
        $data = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pengalaman');

        $headers = ['ID', 'Nama Proyek', 'Pemberi Kerja', 'Lokasi', 'Tahun', 'Kategori', 'Deskripsi', 'Urutan'];
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setRGB('1B6CA8');
            $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FFFFFF');
        }

        foreach ($data as $row => $item) {
            $r = $row + 2;
            $sheet->setCellValue('A' . $r, $item->id);
            $sheet->setCellValue('B' . $r, $item->nama_proyek);
            $sheet->setCellValue('C' . $r, $item->pemberi_kerja);
            $sheet->setCellValue('D' . $r, $item->lokasi ?? '');
            $sheet->setCellValue('E' . $r, $item->tahun);
            $sheet->setCellValue('F' . $r, $item->kategori ?? '');
            $sheet->setCellValue('G' . $r, $item->deskripsi ?? '');
            $sheet->setCellValue('H' . $r, $item->urutan);
        }

        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'pengalaman_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    // ── TEMPLATE IMPORT ──────────────────────────────────────
    public function importTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pengalaman');

        $headers = ['Nama Proyek *', 'Pemberi Kerja *', 'Lokasi', 'Tahun *', 'Kategori', 'Deskripsi', 'Urutan'];
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setRGB('F5A623');
            $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FFFFFF');
        }
        // Sample row
        $sheet->setCellValue('A2', 'Penyusunan RPJMD Kota X');
        $sheet->setCellValue('B2', 'Bappeda Kota X');
        $sheet->setCellValue('C2', 'Kota X');
        $sheet->setCellValue('D2', date('Y'));
        $sheet->setCellValue('E2', 'Perencanaan Pembangunan');
        $sheet->setCellValue('F2', 'Deskripsi singkat proyek');
        $sheet->setCellValue('G2', '1');

        // Note sheet
        $note = $spreadsheet->createSheet();
        $note->setTitle('Kategori');
        $note->setCellValue('A1', 'Daftar Kategori yang Valid:');
        $note->getStyle('A1')->getFont()->setBold(true);
        $kategori = [
            'Perencanaan Pembangunan',
            'Evaluasi Pembangunan',
            'Analisis Pengelolaan Keuangan dan Aset Daerah',
            'Perencanaan Sektoral',
            'Penelitian dan Pengkajian',
            'Peningkatan Kapasitas SDM Aparatur',
        ];
        foreach ($kategori as $i => $k) {
            $note->setCellValue('A' . ($i + 2), $k);
        }
        $note->getColumnDimension('A')->setAutoSize(true);

        foreach (range('A', 'G') as $col) {
            $spreadsheet->getSheet(0)->getColumnDimension($col)->setAutoSize(true);
        }
        $spreadsheet->setActiveSheetIndex(0);

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, 'template_import_pengalaman.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    // ── IMPORT ──────────────────────────────────────────────
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|max:5120',
        ]);

        $file = $request->file('file_excel');
        $spreadsheet = IOFactory::load($file->getPathname());
        $rows = $spreadsheet->getSheet(0)->toArray(null, true, true, true);

        $inserted = 0;
        $errors   = [];

        foreach ($rows as $rowNum => $row) {
            if ($rowNum === 1) continue; // skip header
            $namaProyek = trim($row['A'] ?? '');
            $pemberiKerja = trim($row['B'] ?? '');
            $tahun = trim($row['D'] ?? '');
            if ($namaProyek === '' || $pemberiKerja === '' || $tahun === '') continue;

            try {
                Pengalaman::create([
                    'nama_proyek'   => $namaProyek,
                    'pemberi_kerja' => $pemberiKerja,
                    'lokasi'        => trim($row['C'] ?? '') ?: null,
                    'tahun'         => $tahun,
                    'kategori'      => trim($row['E'] ?? '') ?: null,
                    'deskripsi'     => trim($row['F'] ?? '') ?: null,
                    'urutan'        => is_numeric($row['G'] ?? '') ? (int)$row['G'] : 0,
                ]);
                $inserted++;
            } catch (\Exception $e) {
                $errors[] = 'Baris ' . $rowNum . ': ' . $e->getMessage();
            }
        }

        $msg = "Berhasil mengimpor {$inserted} data pengalaman.";
        if ($errors) $msg .= ' Gagal: ' . implode('; ', array_slice($errors, 0, 3));

        return redirect()->route('admin.pengalaman.index')->with('sukses', $msg);
    }

    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Pengalaman::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->logo);
            }
            if ($item->galeri_proyek) {
                foreach ($item->galeri_proyek as $foto) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($foto);
                }
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
