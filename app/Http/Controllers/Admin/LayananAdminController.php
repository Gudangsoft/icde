<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LayananAdminController extends Controller
{
    public function index()
    {
        $layanan = Layanan::orderBy('urutan')->get();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.form', ['layanan' => new Layanan(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'ikon', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.form', ['layanan' => $layanan, 'action' => 'edit']);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon'      => 'nullable|string|max:50',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'ikon', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('sukses', 'Layanan berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = Layanan::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->gambar) Storage::disk('public')->delete($item->gambar);
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }

    // ── EXPORT ──────────────────────────────────────────────
    public function export()
    {
        $layanan = Layanan::orderBy('urutan')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Layanan');

        $headers = ['ID', 'Judul', 'Deskripsi', 'Ikon', 'Urutan', 'Aktif'];
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setRGB('1B6CA8');
            $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FFFFFF');
        }

        foreach ($layanan as $row => $item) {
            $r = $row + 2;
            $sheet->setCellValue('A' . $r, $item->id);
            $sheet->setCellValue('B' . $r, $item->judul);
            $sheet->setCellValue('C' . $r, $item->deskripsi);
            $sheet->setCellValue('D' . $r, $item->ikon ?? '');
            $sheet->setCellValue('E' . $r, $item->urutan);
            $sheet->setCellValue('G' . $r, $item->aktif ? 'Ya' : 'Tidak');
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'layanan_' . date('Ymd_His') . '.xlsx';
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
        $sheet->setTitle('Layanan');

        $headers = ['Judul *', 'Deskripsi *', 'Ikon (CSS Class)', 'Urutan', 'Aktif (Ya/Tidak)'];
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
        $sheet->setCellValue('A2', 'Layanan Contoh');
        $sheet->setCellValue('B2', 'Deskripsi lengkap layanan.');
        $sheet->setCellValue('C2', 'bi bi-star');
        $sheet->setCellValue('D2', '1');
        $sheet->setCellValue('E2', 'Ya');

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, 'template_import_layanan.xlsx', [
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
            $judul = trim($row['A'] ?? '');
            $deskripsi = trim($row['B'] ?? '');
            if ($judul === '' || $deskripsi === '') continue;

            try {
                Layanan::create([
                    'judul'     => $judul,
                    'deskripsi' => $deskripsi,
                    'ikon'      => trim($row['C'] ?? '') ?: null,
                    'urutan'    => is_numeric($row['D'] ?? '') ? (int)$row['D'] : 0,
                    'aktif'     => strtolower(trim($row['E'] ?? 'ya')) !== 'tidak',
                ]);
                $inserted++;
            } catch (\Exception $e) {
                $errors[] = 'Baris ' . $rowNum . ': ' . $e->getMessage();
            }
        }

        $msg = "Berhasil mengimpor {$inserted} data layanan.";
        if ($errors) $msg .= ' Gagal: ' . implode('; ', array_slice($errors, 0, 3));

        return redirect()->route('admin.layanan.index')->with('sukses', $msg);
    }
}
