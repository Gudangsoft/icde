<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderAdminController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('urutan')->paginate(12);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.form', ['slider' => new Slider()]);
    }

    public function store(Request $request)
    {
        $hanyaGambar = $request->boolean('hanya_gambar');
        $request->validate([
            'judul'       => $hanyaGambar ? 'nullable|string|max:200' : 'required|string|max:200',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'link_tombol' => 'nullable|string|max:255',
            'urutan'      => 'required|integer|min:1',
        ]);

        $data = $request->only(['judul', 'subjudul', 'deskripsi', 'teks_tombol', 'link_tombol', 'warna_teks', 'urutan']);
        $data['aktif']       = $request->boolean('aktif', true);
        $data['hanya_gambar'] = $hanyaGambar;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sliders', 'public');
        }

        Slider::create($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slide baru berhasil ditambahkan.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $hanyaGambar = $request->boolean('hanya_gambar');
        $request->validate([
            'judul'       => $hanyaGambar ? 'nullable|string|max:200' : 'required|string|max:200',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'link_tombol' => 'nullable|string|max:255',
            'urutan'      => 'required|integer|min:1',
        ]);

        $data = $request->only(['judul', 'subjudul', 'deskripsi', 'teks_tombol', 'link_tombol', 'warna_teks', 'urutan']);
        $data['aktif']       = $request->boolean('aktif', false);
        $data['hanya_gambar'] = $hanyaGambar;

        if ($request->hasFile('gambar')) {
            if ($slider->gambar && Storage::disk('public')->exists($slider->gambar)) {
                Storage::disk('public')->delete($slider->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.slider.index')->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->gambar && Storage::disk('public')->exists($slider->gambar)) {
            Storage::disk('public')->delete($slider->gambar);
        }
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slide berhasil dihapus.');
    }

    public function toggleAktif(Slider $slider)
    {
        $slider->update(['aktif' => !$slider->aktif]);
        return back()->with('success', 'Status slide diperbarui.');
    }

    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        $items = \App\Models\Slider::whereIn('id', $ids)->get();
        foreach ($items as $item) {
            if ($item->gambar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->gambar);
            }
            $item->delete();
        }
        return back()->with('sukses', count($ids) . ' data berhasil dihapus.');
    }
}
