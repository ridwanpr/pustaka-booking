<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('buku/update') . '/' . $buku['id']; ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="judul_buku" name="judul_buku" value="<?= $buku['judul_buku'] ?>" placeholder="Masukkan Judul Buku">
                        </div>
                        <div class="form-group">
                            <select name="id_kategori" class="form-control form-control-user">
                                <option value="">Pilih Kategori</option>
                                <?php
                                foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id']; ?>" <?= $buku['id_kategori'] == $k['id'] ? 'selected' : ''; ?>><?= $k['nama_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="pengarang" name="pengarang" value="<?= $buku['pengarang'] ?>" placeholder="Masukkan nama pengarang">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="penerbit" name="penerbit" value="<?= $buku['penerbit'] ?>" placeholder="Masukkan nama penerbit">
                        </div>
                        <div class="form-group">
                            <select name="tahun" class="form-control form-control-user">
                                <option value="">Pilih Tahun</option>
                                <?php
                                for ($i = date('Y'); $i > 1949; $i--) { ?>
                                    <option value="<?= $i; ?>" <?= $buku['tahun_terbit'] == $i ? 'selected' : ''; ?>><?= $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="isbn" name="isbn" value="<?= $buku['isbn'] ?>" placeholder="Masukkan ISBN">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" id="stok" name="stok" value="<?= $buku['stok'] ?>" placeholder="Masukkan nominal stok">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control form-control-user" id="image" name="image">
                            <input type="hidden" name="old_pict" value="<?= $buku['image']; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        <a href="<?= base_url('buku'); ?>" class="btn btn-secondary float-right mr-1">Batal</a></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>