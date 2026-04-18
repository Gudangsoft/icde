<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StrukturOrganisasi;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        StrukturOrganisasi::truncate();

        // Level 1 – Dewan Komisaris
        $komisaris = StrukturOrganisasi::create([
            'nama' => 'Dewan Komisaris', 'jabatan' => 'Dewan Komisaris',
            'parent_id' => null, 'urutan' => 1, 'aktif' => true,
        ]);

        // Level 2 – Direktur Utama
        $dirut = StrukturOrganisasi::create([
            'nama' => 'H. Gunarto', 'jabatan' => 'Direktur Utama', 'gelar' => 'Drs., MM.',
            'parent_id' => $komisaris->id, 'urutan' => 1, 'aktif' => true,
        ]);

        // Level 3 – Sekretaris
        StrukturOrganisasi::create([
            'nama' => 'Wulan Aji P.', 'jabatan' => 'Sekretaris', 'gelar' => 'ST.',
            'parent_id' => $dirut->id, 'urutan' => 1, 'aktif' => true,
        ]);

        // Level 3 – Direktur 1
        $dir1 = StrukturOrganisasi::create([
            'nama' => 'Rahmad P.', 'jabatan' => 'Direktur', 'gelar' => 'Drs., M.Si.',
            'parent_id' => $dirut->id, 'urutan' => 2, 'aktif' => true,
        ]);

        // Level 3 – Direktur 2
        $dir2 = StrukturOrganisasi::create([
            'nama' => 'Setyohadi P.', 'jabatan' => 'Direktur', 'gelar' => 'Drs., M.Si.',
            'parent_id' => $dirut->id, 'urutan' => 3, 'aktif' => true,
        ]);

        // Level 3 – Direktur 3
        $dir3 = StrukturOrganisasi::create([
            'nama' => 'Prapto Istiyanto', 'jabatan' => 'Direktur', 'gelar' => 'Drs.',
            'parent_id' => $dirut->id, 'urutan' => 4, 'aktif' => true,
        ]);

        // Level 4 – Tenaga Ahli (per direktur)
        $tenagaAhli2 = null;
        foreach ([$dir1->id, $dir2->id, $dir3->id] as $idx => $parentId) {
            $ta = StrukturOrganisasi::create([
                'nama' => 'Tenaga Ahli', 'jabatan' => 'Tenaga Ahli',
                'parent_id' => $parentId, 'urutan' => 1, 'aktif' => true,
            ]);
            if ($idx === 1) $tenagaAhli2 = $ta; // middle direktur
        }

        // Level 5 – Staf (child of middle Tenaga Ahli / Setyohadi)
        StrukturOrganisasi::create([
            'nama' => 'Staf', 'jabatan' => 'Staf',
            'parent_id' => $tenagaAhli2->id, 'urutan' => 1, 'aktif' => true,
        ]);
    }
}
