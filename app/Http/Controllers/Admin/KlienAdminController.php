<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Klien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KlienAdminController extends Controller
{
    public function index()
    {
        $klien = Klien::orderBy('urutan')->get();
        return view('admin.klien.index', compact('klien'));
    }

    public function create()
    {
        return view('admin.klien.form', ['klien' => new Klien(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:150',
            'website' => 'nullable|url|max:255',
            'urutan'  => 'nullable|integer',
            'logo'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'website', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('klien', 'public');
        }

        Klien::create($data);

        return redirect()->route('admin.klien.index')->with('sukses', 'Klien berhasil ditambahkan.');
    }

    public function edit(Klien $klien)
    {
        return view('admin.klien.form', ['klien' => $klien, 'action' => 'edit']);
    }

    public function update(Request $request, Klien $klien)
    {
        $request->validate([
            'nama'    => 'required|string|max:150',
            'website' => 'nullable|url|max:255',
            'urutan'  => 'nullable|integer',
            'logo'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'website', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('logo')) {
            if ($klien->logo) Storage::disk('public')->delete($klien->logo);
            $data['logo'] = $request->file('logo')->store('klien', 'public');
        }

        $klien->update($data);

        return redirect()->route('admin.klien.index')->with('sukses', 'Klien berhasil diperbarui.');
    }

    public function destroy(Klien $klien)
    {
        if ($klien->logo) Storage::disk('public')->delete($klien->logo);
        $klien->delete();
        return redirect()->route('admin.klien.index')->with('sukses', 'Klien berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Tidak ada data yang dipilih.');
        }

        $items = Klien::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->logo) Storage::disk('public')->delete($item->logo);
            $item->delete();
        }

        return back()->with('sukses', count($ids) . ' klien berhasil dihapus.');
    }

    public function updateLogo(Request $request, Klien $klien)
    {
        $request->validate(['logo' => 'required|image|max:2048']);
        if ($klien->logo) Storage::disk('public')->delete($klien->logo);
        $path = $request->file('logo')->store('klien', 'public');
        $klien->update(['logo' => $path]);
        return response()->json(['url' => asset('storage/' . $path)]);
    }

    // ── EXPORT ──────────────────────────────────────────────
    public function export()
    {
        $klien = Klien::orderBy('urutan')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Klien');

        // Header
        $headers = ['ID', 'Nama Klien', 'Website', 'Urutan', 'Aktif'];
        foreach ($headers as $col => $header) {
            $cell = chr(65 + $col) . '1';
            $sheet->setCellValue($cell, $header);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType('solid')
                ->getStartColor()->setRGB('1B6CA8');
            $sheet->getStyle($cell)->getFont()->getColor()->setRGB('FFFFFF');
        }

        // Data
        foreach ($klien as $row => $item) {
            $r = $row + 2;
            $sheet->setCellValue('A' . $r, $item->id);
            $sheet->setCellValue('B' . $r, $item->nama);
            $sheet->setCellValue('C' . $r, $item->website ?? '');
            $sheet->setCellValue('D' . $r, $item->urutan);
            $sheet->setCellValue('E' . $r, $item->aktif ? 'Ya' : 'Tidak');
        }

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'klien_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    // ── TEMPLATE IMPORT ──────────────────────────────────────
    public function importTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Klien');

        $headers = ['Nama Klien *', 'Website', 'Urutan', 'Aktif (Ya/Tidak)'];
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
        $sheet->setCellValue('A2', 'Contoh Klien');
        $sheet->setCellValue('B2', 'https://contoh.com');
        $sheet->setCellValue('C2', '1');
        $sheet->setCellValue('D2', 'Ya');

        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="template_import_klien.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    // ── IMPORT ──────────────────────────────────────────────
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $file = $request->file('file_excel');
        $spreadsheet = IOFactory::load($file->getPathname());
        $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $inserted = 0;
        $errors   = [];

        foreach ($rows as $rowNum => $row) {
            if ($rowNum === 1) continue; // skip header
            $nama = trim($row['A'] ?? '');
            if ($nama === '') continue;

            try {
                Klien::create([
                    'nama'    => $nama,
                    'website' => trim($row['B'] ?? '') ?: null,
                    'urutan'  => is_numeric($row['C'] ?? '') ? (int)$row['C'] : 0,
                    'aktif'   => strtolower(trim($row['D'] ?? 'ya')) !== 'tidak',
                ]);
                $inserted++;
            } catch (\Exception $e) {
                $errors[] = 'Baris ' . $rowNum . ': ' . $e->getMessage();
            }
        }

        $msg = "Berhasil mengimpor {$inserted} data klien.";
        if ($errors) $msg .= ' Gagal: ' . implode('; ', array_slice($errors, 0, 3));

        return redirect()->route('admin.klien.index')->with('sukses', $msg);
    }
}

