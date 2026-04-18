<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'    => 'required|string|max:100',
            'site_email'   => 'nullable|email|max:100',
            'site_phone'   => 'nullable|string|max:30',
            'site_logo'    => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,ico,jpg|max:512',
            'maintenance_mode' => 'nullable|in:0,1',
            'maintenance_title' => 'nullable|string|max:120',
            'maintenance_message' => 'nullable|string|max:500',
        ]);

        $textFields = [
            'site_name', 'site_tagline', 'site_description', 'site_keywords',
            'site_email', 'site_email2', 'site_phone', 'site_phone2',
            'site_whatsapp', 'site_address', 'site_maps_embed', 'site_working_hours',
            'social_facebook', 'social_instagram', 'social_linkedin',
            'social_youtube', 'social_twitter',
            'footer_copyright', 'footer_text',
            'meta_author', 'google_analytics',
            'maintenance_title', 'maintenance_message',
        ];

        foreach ($textFields as $field) {
            $value = $request->input($field, '');

            // Auto-extract src URL if admin pastes the full <iframe> embed code
            if ($field === 'site_maps_embed' && $value) {
                if (preg_match('/src=["\']([^"\']+)["\']/', $value, $m)) {
                    $value = $m[1];
                } elseif (preg_match('/^(https?:\/\/[^"\'>\s]+)/', $value, $m)) {
                    $value = $m[1];
                }
            }

            Setting::set($field, $value);
        }

        Setting::set('maintenance_mode', $request->input('maintenance_mode', '0'));

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        // Handle favicon upload
        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path);
        }

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan website berhasil disimpan.');
    }

    public function updateTitle(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'value' => 'required|string|max:255',
        ]);
        
        Setting::set($request->key, $request->value);
        return back()->with('sukses', 'Judul halaman berhasil diperbarui.');
    }
}
