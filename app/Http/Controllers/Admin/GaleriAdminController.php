<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Pengalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriAdminController extends Controller
{
    public function index(Request $request)
    {
        $albumFilter = $request->get('album');

        $query = Galeri::orderBy('album')->orderBy('urutan');

        if ($albumFilter) {
            $query->where('album', $albumFilter);
        }

        $galeri = $query->get();

        // Get all unique album names for the filter tabs
        $albums = Galeri::whereNotNull('album')->where('album', '!=', '')
            ->select('album')
            ->distinct()
            ->orderBy('album')
            ->pluck('album');

        // Get projects that have gallery images (for import feature)
        $proyekDenganGaleri = Pengalaman::whereNotNull('galeri_proyek')
            ->where('galeri_proyek', '!=', '[]')
            ->where('galeri_proyek', '!=', 'null')
            ->orderBy('tahun', 'desc')
            ->get();

        return view('admin.galeri.index', compact('galeri', 'albums', 'albumFilter', 'proyekDenganGaleri'));
    }

    public function create()
    {
        $albums = Galeri::whereNotNull('album')->where('album', '!=', '')
            ->select('album')->distinct()->orderBy('album')->pluck('album');
        return view('admin.galeri.form', ['galeri' => new Galeri(), 'action' => 'create', 'albums' => $albums]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'album'     => 'nullable|string|max:255',
            'album_baru'=> 'nullable|string|max:255',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'required|image|max:4096',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'kategori', 'urutan']);
        $data['aktif']  = $request->boolean('aktif', true);
        $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        $data['album']  = $request->filled('album_baru') ? $request->input('album_baru') : $request->input('album');

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $albums = Galeri::whereNotNull('album')->where('album', '!=', '')
            ->select('album')->distinct()->orderBy('album')->pluck('album');
        return view('admin.galeri.form', ['galeri' => $galeri, 'action' => 'edit', 'albums' => $albums]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'album'     => 'nullable|string|max:255',
            'album_baru'=> 'nullable|string|max:255',
            'urutan'    => 'nullable|integer',
            'gambar'    => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'kategori', 'urutan']);
        $data['aktif'] = $request->boolean('aktif', true);
        $data['album'] = $request->filled('album_baru') ? $request->input('album_baru') : $request->input('album');

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($galeri->gambar);
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('sukses', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Import galeri dari proyek (pengalaman) yang punya galeri_proyek
     */
    public function importFromProyek(Request $request)
    {
        $request->validate([
            'pengalaman_ids'   => 'required|array|min:1',
            'pengalaman_ids.*' => 'exists:pengalaman,id',
        ]);

        $imported = 0;

        foreach ($request->input('pengalaman_ids') as $pengalamanId) {
            $pengalaman = Pengalaman::find($pengalamanId);

            if (!$pengalaman || !$pengalaman->galeri_proyek || count($pengalaman->galeri_proyek) === 0) {
                continue;
            }

            $albumName = $pengalaman->nama_proyek;

            foreach ($pengalaman->galeri_proyek as $idx => $foto) {
                // Check if already imported (avoid duplicates)
                $exists = Galeri::where('pengalaman_id', $pengalaman->id)
                    ->where('gambar', $foto)
                    ->exists();

                if ($exists) continue;

                Galeri::create([
                    'judul'          => $pengalaman->nama_proyek . ' - Foto ' . ($idx + 1),
                    'deskripsi'      => $pengalaman->pemberi_kerja . ' (' . $pengalaman->tahun . ')',
                    'gambar'         => $foto,
                    'kategori'       => 'Proyek',
                    'album'          => $albumName,
                    'pengalaman_id'  => $pengalaman->id,
                    'urutan'         => $idx + 1,
                    'aktif'          => true,
                ]);

                $imported++;
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('sukses', "Berhasil mengimpor {$imported} foto dari proyek ke galeri.");
    }

        public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Galeri::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->foto);
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
