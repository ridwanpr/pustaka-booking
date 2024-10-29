<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('kategori/update') . '/' . $kategori['id']; ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_kategori">Kategori</label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" placeholder="Kategori">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <a href="<?= base_url('kategori'); ?>" class="btn btn-secondary float-right mr-1">Batal</a></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>