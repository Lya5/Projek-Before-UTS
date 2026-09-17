<select name="idrole" id="idrole" required>
    <option value="">-- Pilih Role --</option>
    <?php if (isset($daftar_role) && is_array($daftar_role)): ?>
        <?php foreach ($daftar_role as $role): ?>
            <?php 
                
                if (is_object($role) && method_exists($role, 'get_data')) {
                    $data = $role->get_data();
                    $idrole = $data['idrole'];
                    $nama = $data['nama_role'];
                } else {
                    $idrole = $role['idrole'] ?? $role['id'] ?? '';
                    $nama = $role['nama_role'] ?? $role['role'] ?? '';
                }
            ?>
            <option value="<?= htmlspecialchars($idrole) ?>"><?= htmlspecialchars($nama) ?></option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>