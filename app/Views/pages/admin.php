<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- My data table js and css -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function() {
        $('#tb_inv').DataTable();
    });
</script>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Inventaris BEM FKI</h3>
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
            <button type="button" class="bi bi-plus-square btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah data
            </button>
            <a>
                <table id="tb_inv" class="table table-striped">
                    <thead>
                        <tr align="center">
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">ID Inventaris</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah / Kapasitas</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($inventaris as $in) : ?>
                            <tr>
                                <td scope="row"><?= $i++; ?></td>
                                <th><img src="/img/<?= $in['gambar']; ?>" class="gambar"></th>
                                <td><?= $in['id_inventaris']; ?></td>
                                <td><?= $in['nama_aset']; ?></td>
                                <td><?= $in['jumlah_kapasitas']; ?></td>
                                <td><?= $in['status_kondisi']; ?></td>
                                <td>
                                    <button type="button" class="bi bi-pencil-square btn btn-warning tooltip-test" title="Edit data" data-bs-toggle="modal" data-bs-target="#edit<?= $in['nomor']; ?>">

                                    </button>
                                    <button type="button" class="bi bi-trash btn btn-danger tooltip-test" title="Hapus data" data-bs-toggle="modal" data-bs-target="#hapus<?= $in['nomor']; ?>">

                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </a>
        </div>
    </div>
</div>

<!-- modal untuk tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data aset baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate action="/Pages/save" role="form" method="POST" enctype="multipart/form-data" id="form_tambah" class="needs-validation">
                <?= csrf_field(); ?>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="modal-body">
                    <div class="mb-3 form-group">
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
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                            <label for="id_inventaris" class="form-label"><b>Nomor Inventaris</b></label>
                            <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>" id="id_inventaris" name="id_inventaris" value="<?= old('id_inventaris'); ?>">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label for="nama_aset" class="form-label"><b>Nama Aset</b></label>
                            <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_aset')) ? 'is-invalid' : ''; ?>" id="nama_aset" name="nama_aset" value="<?= old('nama_aset'); ?>">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('nama_aset'); ?>
                            </div>
                        </div>
                        <div class="mb-3 col-md-5 form-group">
                            <label for="jumlah_kapasitas" class="form-label"><b>Jumlah</b></label>
                            <input type="number" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" value="<?= old('jumlah_kapasitas'); ?>">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                            </div>
                        </div>
                        <div class="mb-3 col-md-7 form-group">
                            <label for="status_kondisi" class="form-label"><b>Kondisi</b></label>
                            <select class="form-select <?= (\Config\Services::validation()->hasError('status_kondisi')) ? 'is-invalid' : ''; ?>" id="status_kondisi" name="status_kondisi">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Perbaikan">Perbaikan</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('status_kondisi'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> -->
                    <button type="submit" class="bi bi-plus-square btn btn-primary" id="btn_tambah"> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- form validation check on click submit button -->
<script type="text/javascript">
    // $.ajaxSetup({
    //     headers: {
    //         _CSRF_HEADER: _CSRF_NAME,
    //     }
    // });

    // (function() {
    //     'use strict';
    //     window.addEventListener('load', function() {
    //         // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //         var forms = document.getElementsByClassName('needs-validation');
    //         // Loop over them and prevent submission
    //         var validation = Array.prototype.filter.call(forms, function(form) {
    //             form.addEventListener('submit', function(event) {
    //                 if (form.checkValidity() === false) {
    //                     event.preventDefault();
    //                     event.stopPropagation();
    //                 }
    //                 form.classList.add();
    //             }, false);
    //         });
    //     }, false);
    // })();

    // $("#form_tambah").submit(function(e) {
    //     if (form.checkValidity() === true) {
    //         e.preventDefault();
    //         e.stopPropagation();
    //     }
    //     form.classList.add();
    // }).validate({
    //     rules: {
    //         'nama_aset': 'required'
    //     },
    //     submitHandler: function(form) {
    //         alert("Do some stuff...");
    //         //submit via ajax
    //         return false; //This doesn't prevent the form from submitting.
    //     }
    // });
</script>


<!-- modal untuk edit -->
<?php foreach ($inventaris as $in) : ?>
    <div class="modal fade" id="edit<?php echo $in['nomor']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit data aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/Pages/update/<?= $in['nomor']; ?>" method="POST" role="form" enctype="multipart/form-data" class="needs-validation">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="nomor" value="<?= $in['nomor']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $in['gambar']; ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="mb-2"><b>Pilih Foto Aset</b></label>
                                <div class="col-sm-4">
                                    <img src="/img/<?= $in['gambar']; ?>" class="img-thumbnail img-preview">
                                </div>
                                <div class="mt-2 col-md-10">
                                    <input type="file" class="form-control <?= (\Config\Services::validation()->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" value="<?= old('gambar'); ?>" onchange="preview_img()">
                                    <div class="invalid-feedback">
                                        <?= \Config\Services::validation()->getError('gambar'); ?>
                                    </div>
                                    <div id="emailHelp" class="form-text">Direkomendasikan untuk memasukkan foto.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="id_inventaris" class="form-label"><b>Nomor Inventaris</b></label>
                                <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>" id="id_inventaris" name="id_inventaris" value="<?= (old('id_inventaris')) ? old('id_inventaris') : $in['id_inventaris']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nama_aset" class="form-label"><b>Nama Aset</b></label>
                                <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_aset')) ? 'is-invalid' : ''; ?>" id="nama_aset" name="nama_aset" value="<?= (old('nama_aset')) ? old('nama_aset') : $in['nama_aset']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('nama_aset'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-5">
                                <label for="jumlah_kapasitas" class="form-label"><b>Jumlah</b></label>
                                <input type="number" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" value="<?= (old('jumlah_kapasitas')) ? old('jumlah_kapasitas') : $in['jumlah_kapasitas']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-7">
                                <label for="status_kondisi" class="form-label"><b>Kondisi</b></label>
                                <select class="form-select <?= (\Config\Services::validation()->hasError('status_kondisi')) ? 'is-invalid' : ''; ?>" id="status_kondisi" name="status_kondisi">
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Perbaikan">Perbaikan</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('status_kondisi'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> -->
                        <button type="submit" name="update" class="bi bi-pencil-square btn btn-warning"> Simpan</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<!-- modal untuk hapus -->
<?php foreach ($inventaris as $in) : ?>
    <div class="modal fade" id="hapus<?= $in['nomor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/Pages/delete/<?= $in['nomor']; ?>" method="post" role="form" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="nomor" value="<?php echo $in['nomor']; ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $in['gambar']; ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <div class="col-sm-4">
                                        <img src="/img/<?= $in['gambar']; ?>" class="img-thumbnail img-preview">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="id_inventaris" class="form-label">Nomor Inventaris : <?= $in['id_inventaris']; ?></label>
                            </div>
                            <div class="mb-3">
                                <label for="nama_aset" class="form-label">Nama Aset : <?= $in['nama_aset']; ?></label>
                            </div>
                            <div id="emailHelp" class="form-text">Apakah anda yakin akan menghapus data aset?</div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="bi bi-close btn btn-secondary" data-bs-dismiss="modal">Batal</button> -->
                            <button type="submit" name="update" class="bi bi-trash btn btn-danger"> Hapus</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>