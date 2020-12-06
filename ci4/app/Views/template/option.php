<div class="form-group">
    <select name="idkategori" onchange="this.form.submit()" id="idkategori" class="form-control">
        <option value="1">Cari....</option>
        <?php foreach ($kategori as $key => $value) : ?>
            <option value="<?= $value['idkategori'] ?>"><?= $value['kategori'] ?></option>
        <?php endforeach ?>
    </select>
</div>