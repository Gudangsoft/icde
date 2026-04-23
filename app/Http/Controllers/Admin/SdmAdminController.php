<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sdm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SdmAdminController extends Controller
{
    public function index()
    {
        $sdm = Sdm::orderBy('urutan')->get();
        return view('admin.sdm.index', compact('sdm'));
    }

    public function create()
    {
        return view('admin.sdm.form', ['sdm' => new Sdm(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
            'keahlian'   => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'urutan'     => 'nullable|integer',
            'foto'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'deskripsi', 'keahlian', 'pendidikan', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sdm', 'public');
        }

        Sdm::create($data);

        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil ditambahkan.');
    }

    public function edit(Sdm $sdm)
    {
        return view('admin.sdm.form', ['sdm' => $sdm, 'action' => 'edit']);
    }

    public function update(Request $request, Sdm $sdm)
    {
        $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'deskripsi'  => 'nullable|string',
            'keahlian'   => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'urutan'     => 'nullable|integer',
            'foto'       => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan', 'deskripsi', 'keahlian', 'pendidikan', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            if ($sdm->foto) Storage::disk('public')->delete($sdm->foto);
            $data['foto'] = $request->file('foto')->store('sdm', 'public');
        }

        $sdm->update($data);

        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil diperbarui.');
    }

    public function destroy(Sdm $sdm)
    {
        if ($sdm->foto) Storage::disk('public')->delete($sdm->foto);
        $sdm->delete();
        return redirect()->route('admin.sdm.index')->with('sukses', 'Tenaga ahli berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = Sdm::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->foto) Storage::disk('public')->delete($item->foto);
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }

    // ── EXPORT ──────────────────────────────────────────────
    public function export()
    {
        $sdm = Sdm::orderBy('urutan')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Tenaga Ahli');

        $headers = ['ID', 'Nama', 'Jabatan', 'Keahlian', 'Pendidikan', 'Urutan', 'Aktif'];
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setRGB('1B6CA8');
            $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FFFFFF');
        }

        foreach ($sdm as $row => $item) {
            $r = $row + 2;
            $sheet->setCellValue('A' . $r, $item->id);
            $sheet->setCellValue('B' . $r, $item->nama);
            $sheet->setCellValue('C' . $r, $item->jabatan);
            $sheet->setCellValue('D' . $r, $item->keahlian ?? '');
            $sheet->setCellValue('E' . $r, $item->pendidikan ?? '');
            $sheet->setCellValue('F' . $r, $item->urutan);
            $sheet->setCellValue('G' . $r, $item->aktif ? 'Ya' : 'Tidak');
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'sdm_' . date('Ymd_His') . '.xlsx';
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
        $sheet->setTitle('Tenaga Ahli');

        $headers = ['Nama *', 'Jabatan *', 'Keahlian', 'Pendidikan', 'Urutan', 'Aktif (Ya/Tidak)'];
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
        $sheet->setCellValue('A2', 'Nama Tenaga Ahli');
        $sheet->setCellValue('B2', 'Ahli Sipil');
        $sheet->setCellValue('C2', 'Konstruksi Bangunan');
        $sheet->setCellValue('D2', 'S1 Teknik Sipil');
        $sheet->setCellValue('E2', '1');
        $sheet->setCellValue('F2', 'Ya');

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, 'template_import_sdm.xlsx', [
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
        $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $inserted = 0;
        $errors   = [];

        foreach ($rows as $rowNum => $row) {
            if ($rowNum === 1) continue; // skip header
            $nama = trim($row['A'] ?? '');
            $jabatan = trim($row['B'] ?? '');
            if ($nama === '' || $jabatan === '') continue;

            try {
                Sdm::create([
                    'nama'       => $nama,
                    'jabatan'    => $jabatan,
                    'keahlian'   => trim($row['C'] ?? '') ?: null,
                    'pendidikan' => trim($row['D'] ?? '') ?: null,
                    'urutan'     => is_numeric($row['E'] ?? '') ? (int)$row['E'] : 0,
                    'aktif'      => strtolower(trim($row['F'] ?? 'ya')) !== 'tidak',
                ]);
                $inserted++;
            } catch (\Exception $e) {
                $errors[] = 'Baris ' . $rowNum . ': ' . $e->getMessage();
            }
        }

        $msg = "Berhasil mengimpor {$inserted} data SDM.";
        if ($errors) $msg .= ' Gagal: ' . implode('; ', array_slice($errors, 0, 3));

        return redirect()->route('admin.sdm.index')->with('sukses', $msg);
    }
}
