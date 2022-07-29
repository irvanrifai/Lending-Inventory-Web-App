<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="h1">Mencoba Formulir Input BEM</div>
            <?php if (session()->getFlashData('Pesan')) : ?>
                <div class="alert alert-success d-flex align-items-center bi bi-check-lg" role="alert">
                    <div>
                        <?= session()->getFlashdata('Pesan'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('Gagal')) : ?>
                <div class="alert alert-danger d-flex align-items-center bi bi-x-lg" role="alert">
                    <div>
                        <?= session()->getFlashdata('Gagal'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form class="px-4 py-3" novalidate action="/Nyoba/save" role="form" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="id_inventaris" class="form-label">
                            <h6>ID Inventaris</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>" id="id_inventaris" name="id_inventaris" placeholder="ID Inventaris">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_aset" class="form-label">
                            <h6>Nama</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_aset')) ? 'is-invalid' : ''; ?>" id="nama_aset" name="nama_aset" placeholder="Nama">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('nama_aset'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            <h6>Status</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status" placeholder="Status" maxlength="15">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('status'); ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label for="kondisi" class="form-label">
                            <h6>kondisi</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="kondisi" name="kondisi" placeholder="kondisi">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('kondisi'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah_kapasitas" class="form-label">
                            <h6>Jumlah kapasitas</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" placeholder="Jumlah kapasitas">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2"><b>Pilih Foto Aset</b></label>
                        <div class="col-sm-4">
                            <img src="/img/SD-default-image.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="mt-2 col-md-10">
                            <input class="form-control <?= (\Config\Services::validation()->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" value="<?= old('gambar'); ?>" onchange="preview_img()">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('gambar'); ?>
                            </div>
                            <div id="emailHelp" class="form-text">Direkomendasikan untuk memasukkan foto.</div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="bi bi-check-lg btn btn-primary"> Konfirmasi</button>
                    </div>
                </div>
            </form>


            <div class="h1">Mencoba Formulir Input DPM</div>
            <?php if (session()->getFlashData('Pesan')) : ?>
                <div class="alert alert-success d-flex align-items-center bi bi-check-lg" role="alert">
                    <div>
                        <?= session()->getFlashdata('Pesan'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('Gagal')) : ?>
                <div class="alert alert-danger d-flex align-items-center bi bi-x-lg" role="alert">
                    <div>
                        <?= session()->getFlashdata('Gagal'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form class="px-4 py-3" novalidate action="/Nyoba/save" role="form" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="id_inventaris" class="form-label">
                            <h6>ID Inventaris</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>" id="id_inventaris" name="id_inventaris" placeholder="ID Inventaris">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_aset" class="form-label">
                            <h6>Nama</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_aset')) ? 'is-invalid' : ''; ?>" id="nama_aset" name="nama_aset" placeholder="Nama">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('nama_aset'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label">
                            <h6>Status</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status" placeholder="Status" maxlength="15">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('status'); ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label for="kondisi" class="form-label">
                            <h6>kondisi</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="kondisi" name="kondisi" placeholder="kondisi">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('kondisi'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="jumlah_kapasitas" class="form-label">
                            <h6>Jumlah kapasitas</h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" placeholder="Jumlah kapasitas">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="mb-2"><b>Pilih Foto Aset</b></label>
                        <div class="col-sm-4">
                            <img src="/img/SD-default-image.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="mt-2 col-md-10">
                            <input class="form-control <?= (\Config\Services::validation()->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" value="<?= old('gambar'); ?>" onchange="preview_img()">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('gambar'); ?>
                            </div>
                            <div id="emailHelp" class="form-text">Direkomendasikan untuk memasukkan foto.</div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="bi bi-check-lg btn btn-primary"> Konfirmasi</button>
                    </div>
                </div>
            </form>


            <br>
            <hr>
            <br>

            <div class="h1">Menampilkan Hasil Input beserta tindakannya</div>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="row row-cols-2 row-cols-md-5 g-4">
                        <?php foreach ($nyoba as $ny) : ?>
                            <div class="col">
                                <label class="card-text">Nomor : <?= $ny['nomor']; ?></label>
                                <div class="card border-3" style="width: 11rem;">
                                    <img src="/img/<?= $ny['gambar']; ?>" class="img-fluid gambar mx-2 mt-2 rounded" style="height:7rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $ny['nama_aset']; ?></h5>
                                        <div class="col">
                                            <label class="card-text">Status : <?= $ny['status']; ?></label>
                                            <label class="card-text">Status : <?= $ny['id_inventaris']; ?></label>
                                            <label class="card-text">Status : <?= $ny['kondisi']; ?></label>
                                            <label class="card-text">Status : <?= $ny['jumlah_kapasitas']; ?></label>
                                        </div>
                                        <hr>
                                        <div align="right">
                                            Aksi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>