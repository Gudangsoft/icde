<?php

$modules = [
    'layanan' => 'LayananAdminController',
    'sdm' => 'SdmAdminController',
    'pengalaman' => 'PengalamanAdminController',
    'klien' => 'KlienAdminController',
    'galeri' => 'GaleriAdminController',
    'testimoni' => 'TestimoniAdminController',
    'berita' => 'BeritaAdminController',
    'slider' => 'SliderAdminController',
    'struktur' => 'StrukturOrganisasiAdminController',
];

$baseDir = "d:/LPSSE/ICDE/icde-web/";

foreach ($modules as $module => $ctrl) {
    // 1. Update Controller
    $ctrlFile = $baseDir . "app/Http/Controllers/Admin/" . $ctrl . ".php";
    if (file_exists($ctrlFile)) {
        $c = file_get_contents($ctrlFile);
        if (!str_contains($c, 'bulkDestroy')) {
            // Find Model Name from namespace/use or guess
            preg_match('/use App\\\\Models\\\\([a-zA-Z]+);/', $c, $matches);
            $modelName = $matches[1] ?? ucfirst($module);
            
            // simple bulk destroy logic
            // we use the real query builder so we just retrieve and call destroy to make sure file deletion is triggered if handled via models
            // Or we just get and delete. We will just use Eloquent get() and then call delete() on each to fire observers.
            // If they delete files in the destroy() method, we should ideally invoke the same logic, but we can't reliably parse it,
            // so we will write a generic one. We'll find if it has logo, foto, or gambar in the store method.
            
            $fieldsToUnlink = [];
            if (str_contains($c, "->logo")) $fieldsToUnlink[] = 'logo';
            if (str_contains($c, "->gambar")) $fieldsToUnlink[] = 'gambar';
            if (str_contains($c, "->foto")) $fieldsToUnlink[] = 'foto';
            
            $fileDeletion = "";
            foreach (array_unique($fieldsToUnlink) as $f) {
                $fileDeletion .= "                if (\$item->$f) \\Illuminate\\Support\\Facades\\Storage::disk('public')->delete(\$item->$f);\n";
            }
            
            $methodString = "\n    public function bulkDestroy(\\Illuminate\\Http\\Request \$request)
    {
        \$ids = \$request->input('ids', []);
        if (empty(\$ids)) return back()->with('error', 'Tidak ada data yang dipilih.');

        \$items = \\App\\Models\\$modelName::whereIn('id', \$ids)->get();
        foreach (\$items as \$item) {
$fileDeletion            \$item->delete();
        }
        return back()->with('sukses', count(\$ids) . ' data berhasil dihapus.');
    }\n";
    
            // insert before last closing brace
            $c = preg_replace('/}([\s\r\n]*)$/', $methodString . "}\n", $c);
            file_put_contents($ctrlFile, $c);
            echo "Updated Controller $ctrl \n";
        }
    }

    // 2. Update View
    $viewFile = $baseDir . "resources/views/admin/$module/index.blade.php";
    if (file_exists($viewFile)) {
        $v = file_get_contents($viewFile);
        if (!str_contains($v, 'id="bulkDeleteForm"')) {
            // wrap the main table 
            // <div class="admin-card">
            //     <div class="admin-card-header">
            $v = preg_replace(
                '/(<div class="admin-card">[\s\S]*?<div class="admin-card-header">)/',
                '<form id="bulkDeleteForm" action="{{ route(\'admin.'.$module.'.bulk-destroy\') }}" method="POST">
    @csrf
$1', 
                $v
            );
            
            // replace end of card to close form
            // we will replace the closing div of "admin-card"
            // actually easier is replacing </table></div></div> with </table></div></div></form>
            $v = str_replace('</table>
    </div>
</div>', '</table>
    </div>
</div>
</form>', $v);

            // Add button
            $v = str_replace('<div class="d-flex gap-2 flex-wrap">', 
'<div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn-admin btn-danger" id="btnBulkDelete" style="display:none;background:#dc2626;color:white;border:none;" onclick="confirmBulkDelete()">
                <i class="bi bi-trash-fill me-1"></i>Hapus Terpilih
            </button>', $v);

            // Add table header
            $v = str_replace('<th width="50">#</th>', '<th width="30"><input type="checkbox" id="checkAll" style="cursor:pointer;"></th>
                    <th width="50">#</th>', $v);
                    
            // Add table cell for checkbox. The iteration variable might vary
            // usually <td>{{ $i + 1 }}</td> or <td>{{ $loop->iteration }}</td>
            // We'll use a regex to insert <td><input type="..." ></td> before the loop index
            $v = preg_replace(
                '/(<tr>\s*<td>\{\{\s*(\$i \+ 1|\$loop->iteration)\s*\}\}<\/td>)/i',
                '<tr>
                    <td><input type="checkbox" name="ids[]" class="checkItem" value="{{ $item->id }}" style="cursor:pointer;"></td>
                    <td>{{ $2 }}</td>',
                $v
            );

            // Add Scripts
            $js = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const checkItems = document.querySelectorAll('.checkItem');
    const btnBulkDelete = document.getElementById('btnBulkDelete');

    if(checkAll && checkItems.length > 0) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(item => item.checked = this.checked);
            toggleBulkDeleteBtn();
        });

        checkItems.forEach(item => {
            item.addEventListener('change', toggleBulkDeleteBtn);
        });
    }

    function toggleBulkDeleteBtn() {
        const anyChecked = Array.from(checkItems).some(item => item.checked);
        if(btnBulkDelete) btnBulkDelete.style.display = anyChecked ? 'inline-block' : 'none';
        
        if (checkAll) {
            const allChecked = Array.from(checkItems).every(item => item.checked);
            checkAll.checked = allChecked && checkItems.length > 0;
        }
    }
});

function confirmBulkDelete() {
    if(confirm('Hapus semua data terpilih?')) {
        document.getElementById('bulkDeleteForm').submit();
    }
}
</script>
";
            if (str_contains($v, "@push('scripts')")) {
                $v = str_replace("@push('scripts')", "@push('scripts')\n".$js, $v);
            } else {
                $v .= "\n@push('scripts')\n" . $js . "\n@endpush\n";
            }
            
            file_put_contents($viewFile, $v);
            echo "Updated View $module \n";
        }
    }
}
echo "Done\n";
