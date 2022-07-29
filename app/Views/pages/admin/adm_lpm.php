<?= $this->extend('/layout/template'); ?>

<?= $this->section('content'); ?>

<!-- My data table js and css -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

<div class="container">
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item"><a class="nav-link active tooltip-test" data-bs-toggle="tab" href="#dashboard" title="Ajuan Peminjaman"><b>Dashboard</b></a></li>
        <li class="nav-item"><a class="nav-link tooltip-test" data-bs-toggle="tab" href="#ajuan" title="Ajuan Peminjaman"><b>Ajuan</b></a></li>
        <li class="nav-item"><a class="nav-link tooltip-test" data-bs-toggle="tab" href="#inventaris" title="Inventaris"><b>Inventaris</b></a></li>
    </ul>
    <div class="tab-content">
        <!-- Menampilkan dashboard -->
        <div class="tab-pane fade show active" id="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <h3>Dashboard</h3>

                    <!-- ds total ajuan peminjaman aset -->
                    <div class="col-xl-4 col-md-6 mb-4 mt-3">
                        <div class="card border-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total ajuan peminjaman aset</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_ajuan; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file fa-2x text-gray-300" style="color:darkblue; opacity:60%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- total aset ormawa terkait -->
                    <div class="col-xl-4 col-md-6 mb-4 mt-3">
                        <div class="card border-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total inventaris lpm koneksi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_inv; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tools fa-2x text-gray-300" style="color:red; opacity:60%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- aset paling sering dipinjam milik ormawa -->
                    <div class="col-xl-4 col-md-6 mb-4 mt-3">
                        <div class="card border-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">aset paling sering dipinjam</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Projector</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-search fa-2x" style="color:green; opacity:60%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Menampilkan semua data ajuan peminjaman aset ormawa -->
        <div class="tab-pane fade" id="ajuan">
            <script>
                $(document).ready(function() {
                    $('#tb_ajuan').DataTable();
                });
            </script>
            <div class="row">
                <div class="col">
                    <h3>Daftar ajuan peminjaman aset ke LPM KONEKSI</h3>
                    <?php if (session()->getFlashData('message_s')) : ?>
                        <div class="alert alert-success d-flex align-items-center bi bi-check-lg" role="alert">
                            <div>
                                <?= session()->getFlashdata('message_s'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('message_f')) : ?>
                        <div class="alert alert-danger d-flex align-items-center bi bi-x-lg" role="alert">
                            <div>
                                <?= session()->getFlashdata('message_f'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button type="button" class="bi bi-filter btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#rentang_p">
                        Filter
                    </button>
                    <a align="right" class="bi bi-printer btn btn-primary no-print" data-bs-toggle="modal" data-bs-target="#laporan_p"> Cetak</a>
                    <div class="table-responsive">
                        <table id="tb_ajuan" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Peminjam</th>
                                    <th scope="col">Asal Instansi</th>
                                    <th scope="col">Nomor HP</th>
                                    <th scope="col">Aset Dipinjam</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($laporan_p as $p) : ?>
                                    <tr>
                                        <td scope="row"><?= $i++; ?></td>
                                        <td><?= $p['nama_peminjam']; ?></td>
                                        <!-- <td><?= $p['asal_instansi'] == 'Ormawa FKI' ? '<div class="btn btn-success">Ormawa FKI</div>' : ($p['st_ts'] == 'Internal FKI' ? '<div class="btn btn-warning">Internal FKI</div>' : '<div class="btn btn-secondary">Eksternal FKI</div>'); ?></td> -->
                                        <td><?= $p['asal_instansi']; ?></td>
                                        <td><?= $p['no_hp']; ?></td>
                                        <td><?= $p['nama_aset']; ?></td>
                                        <td><?= $p['st_ts'] == '1' ? '<div class="btn btn-success bi bi-check-lg tooltip-test" title="Disetujui"></div>' : ($p['st_ts'] == '0' ? '<div class="btn btn-danger  bi bi-x-lg tooltip-test" title="Ditolak"></div>' : '<div class="btn btn-warning  bi bi-clock tooltip-test" title="Perlu tindakan"></div>'); ?></td>
                                        <td>
                                            <button type="button" class="bi bi-fullscreen btn btn-secondary tooltip-test" title="Detail Ajuan" data-bs-toggle="modal" data-bs-target="#detail<?= $p['id_peminjam']; ?>">
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="bi bi-trash btn btn-danger tooltip-test inline" title="Hapus data" data-bs-toggle="modal" data-bs-target="#remove<?= $p['id_peminjam']; ?>">
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <hr class="my-4">
        </div>
        <!-- menampilkan semua inventaris lpm -->
        <div class="tab-pane fade" id="inventaris">
            <script>
                $(document).ready(function() {
                    $('#tb_inv').DataTable();
                });
            </script>
            <div class="row mt-4">
                <div class="col">
                    <h3>Inventaris LPM FKI</h3>
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
                    <div class="table-responsive">
                        <table id="tb_inv" class="table table-striped">
                            <thead>
                                <tr align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">ID Inventaris</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah / Kapasitas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Bisa dipinjam</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($aset as $a_lpm) : ?>
                                    <tr>
                                        <td scope="row"><?= $i++; ?></td>
                                        <th><img src="/img/<?= $a_lpm['gambar']; ?>" class="gambar"></th>
                                        <td><?= $a_lpm['id_inventaris']; ?></td>
                                        <td><?= $a_lpm['nama_aset']; ?></td>
                                        <td><?= $a_lpm['jumlah_kapasitas']; ?></td>
                                        <td><?= $a_lpm['status']; ?></td>
                                        <td><?= $a_lpm['kondisi']; ?></td>
                                        <td><?= ($a_lpm['cb_nb'] == '1') ? 'Bisa' : 'Tidak'; ?></td>
                                        <td>
                                            <button type="button" class="bi bi-pencil-square btn btn-warning tooltip-test" title="Edit data" data-bs-toggle="modal" data-bs-target="#edit<?= $a_lpm['nomor']; ?>">

                                            </button>
                                            <button type="button" class="bi bi-trash btn btn-danger tooltip-test" title="Hapus data" data-bs-toggle="modal" data-bs-target="#hapus<?= $a_lpm['nomor']; ?>">

                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
            <form novalidate action="/admin/adm_lpm/save" role="form" method="POST" enctype="multipart/form-data" id="form_tambah" class="needs-validation">
                <?= csrf_field(); ?>
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="kepemilikan" id="kepemilikan" value="LPM KONEKSI">
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
                        <div class="mb-3 col-md-4 form-group">
                            <label for="jumlah_kapasitas" class="form-label"><b>Jumlah</b></label>
                            <input type="number" min="1" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" value="<?= old('jumlah_kapasitas'); ?>">
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 form-group">
                            <label for="status" class="form-label"><b>Status</b></label>
                            <select class="form-select <?= (\Config\Services::validation()->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Tidak ada">Tidak ada</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('status'); ?>
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 form-group">
                            <label for="kondisi" class="form-label"><b>Kondisi</b></label>
                            <select class="form-select <?= (\Config\Services::validation()->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="kondisi" name="kondisi">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('kondisi'); ?>
                            </div>
                        </div>
                        <div class="mt-2 ms-4 mb-3 col-md-6 form-group form-check form-switch">
                            <label class="form-check-label" for="cb_nb">Aset bisa dipinjam</label>
                            <input class="form-check-input <?= (\Config\Services::validation()->hasError('cb_nb')) ? 'is-invalid' : ''; ?>" type="checkbox" id="cb_nb" name="cb_nb" value="1" checked>
                            <div class="invalid-feedback">
                                <?= \Config\Services::validation()->getError('cb_nb'); ?>
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
<?php foreach ($aset as $a_lpm) : ?>
    <div class="modal fade" id="edit<?php echo $a_lpm['nomor']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit data aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/adm_lpm/update/<?= $a_lpm['nomor']; ?>" method="POST" role="form" enctype="multipart/form-data" class="needs-validation">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="kepemilikan" id="kepemilikan" value="LPM KONEKSI">
                    <input type="hidden" name="nomor" value="<?= $a_lpm['nomor']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $a_lpm['gambar']; ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="mb-2"><b>Pilih Foto Aset</b></label>
                                <div class="col-sm-4">
                                    <img src="/img/<?= $a_lpm['gambar']; ?>" class="img-thumbnail img-preview">
                                </div>
                                <div class="mt-2 col-md-10">
                                    <input type="file" class="form-control <?= (\Config\Services::validation()->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" value="<?= (old('gambar')) ? old('gambar') : $a_lpm['gambar']; ?>" onchange="preview_img()">
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
                                <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>" id="id_inventaris" name="id_inventaris" value="<?= (old('id_inventaris')) ? old('id_inventaris') : $a_lpm['id_inventaris']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nama_aset" class="form-label"><b>Nama Aset</b></label>
                                <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_aset')) ? 'is-invalid' : ''; ?>" id="nama_aset" name="nama_aset" value="<?= (old('nama_aset')) ? old('nama_aset') : $a_lpm['nama_aset']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('nama_aset'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="jumlah_kapasitas" class="form-label"><b>Jumlah</b></label>
                                <input type="number" min="1" class="form-control <?= (\Config\Services::validation()->hasError('jumlah_kapasitas')) ? 'is-invalid' : ''; ?>" id="jumlah_kapasitas" name="jumlah_kapasitas" value="<?= (old('jumlah_kapasitas')) ? old('jumlah_kapasitas') : $a_lpm['jumlah_kapasitas']; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('jumlah_kapasitas'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="status" class="form-label"><b>Status</b></label>
                                <select class="form-select <?= (\Config\Services::validation()->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" name="status">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak ada">Tidak ada</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('status'); ?>
                                </div>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="kondisi" class="form-label"><b>Kondisi</b></label>
                                <select class="form-select <?= (\Config\Services::validation()->hasError('kondisi')) ? 'is-invalid' : ''; ?>" id="kondisi" name="kondisi">
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('kondisi'); ?>
                                </div>
                            </div>
                            <div class="mt-2 ms-4 mb-3 col-md-6 form-group form-check form-switch">
                                <label class="form-check-label" for="cb_nb">Aset bisa dipinjam</label>
                                <input class="form-check-input <?= (\Config\Services::validation()->hasError('cb_nb')) ? 'is-invalid' : ''; ?>" type="checkbox" id="cb_nb" name="cb_nb" value="1" checked>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('cb_nb'); ?>
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
<?php foreach ($aset as $a_lpm) : ?>
    <div class="modal fade" id="hapus<?= $a_lpm['nomor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/adm_lpm/delete/<?= $a_lpm['nomor']; ?>" method="post" role="form" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="nomor" value="<?php echo $a_lpm['nomor']; ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $a_lpm['gambar']; ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <div class="col-sm-4">
                                        <img src="/img/<?= $a_lpm['gambar']; ?>" class="img-thumbnail img-preview">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="id_inventaris" class="form-label">Nomor Inventaris : <?= $a_lpm['id_inventaris']; ?></label>
                            </div>
                            <div class="mb-3">
                                <label for="nama_aset" class="form-label">Nama Aset : <?= $a_lpm['nama_aset']; ?></label>
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

<!-- modal untuk hapus daftar peminjaman aset -->
<?php foreach ($laporan_p as $l) : ?>
    <div class="modal fade" id="remove<?= $l['id_peminjam']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus data peminjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/adm_lpm/remove/<?= $l['id_peminjam']; ?>" method="post" role="form" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="nomor" value="<?php echo $l['id_peminjam']; ?>" <div class="modal-body">
                        <div>
                            <label for="nama_peminjam" class="form-label">Nama peminjam : <?= $l['nama_peminjam']; ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="asal_instansi" class="form-label">Asal instansi : <?= $l['asal_instansi']; ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="created_at" class="form-label">Mengajukan peminjaman pada : <?= $l['created_at']; ?></label>
                        </div>
                        <div id="emailHelp" class="form-text">Apakah anda yakin akan menghapus data peminjam?</div>
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

<!-- modals untuk detail peminjam -->
<?php foreach ($laporan_p as $l) : ?>
    <div class="modal fade" id="detail<?= $l['id_peminjam']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/admin/adm_lpm/update_a/<?= $l['id_peminjam']; ?>" role="form" method="GET" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Ajuan Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-2">
                            <div class="row g-3">
                                <div class="col-md-12 mb-3 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="row">Nama Peminjam</th>
                                                <td><?= $l['nama_peminjam']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Asal instansi</th>
                                                <td><?= $l['asal_instansi']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td><?= $l['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nomor HP/WA</th>
                                                <td><?= $l['no_hp']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Alamat</th>
                                                <td><?= $l['alamat']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama kegiatan</th>
                                                <td><?= $l['nama_kegiatan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tempat pelaksanaan</th>
                                                <td><?= $l['tempat_pelaksanaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Pelaksanaan kegiatan</th>
                                                <td><?= $l['wk_pelaksanaandr']; ?> - <?= $l['wk_pelaksanaansp']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Aset dipinjam</th>
                                                <td><?= $l['nama_aset']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Waktu pinjam</th>
                                                <td><?= $l['wk_peminjamandr']; ?> - <?= $l['wk_peminjamansp']; ?></td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <p class="card-text mb-2 ms-2">Diajukan pada : <small class="text-muted"><?= $l['created_at']; ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="float: left;">
                            <button type="button" name="cek_inv" id="cek_inv" class="bi bi-search btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#detail_a<?= $l['nomor']; ?>"> Cek jadwal</button>
                        </div>
                        <div id="btn_st_ts" style="float: right;">
                            <button type="submit" name="st_ts" value="1" id="setujui" class="bi bi-check-lg btn btn-success ms-4"> Setujui</button>
                            <button type="submit" name="st_ts" value="0" id="tolak" class="bi bi-x-lg btn btn-danger"> Tolak</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- modals untuk detailnya aset -->
    <div class="modal fade" id="detail_a<?= $l['nomor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card mb-2" style="max-width: 600px;">
                        <div class="row g-0">
                            <div class="col-md-5 my-3 ms-3">
                                <img src="/img/<?= $l['gambar']; ?>" class="img-fluid rounded" alt="...">
                                <!-- <div class="card-body">
                                </div> -->
                            </div>
                            <div class="col-md-4 ms-4 mb-3">
                                <p>
                                <h5 class="card-title"><?= $l['nama_aset']; ?></h5>
                                <!-- <label class="card-text">ID Inventaris : <?= $l['id_inventaris']; ?></label> -->
                                <!-- <div class="row">
                                    <label class="card-text">Kepemilikan : </label>
                                </div> -->
                                <div class="row">
                                    <label class="card-text">Milik : <?= $l['kepemilikan']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Status : <?= $l['status']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Kondisi : <?= $l['kondisi']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Jumlah : <?= $l['jumlah_kapasitas']; ?></label>
                                </div>
                                </p>
                            </div>
                            <hr>
                            <div class="ms-2">
                                <h6>Jadwal Pemakaian</h6>
                            </div>
                            <div class="my-1">
                                <table class="table table-bordered">
                                    <tbody>
                                        <!-- <thead> -->
                                        <tr align="center" class="table-secondary">
                                            <th scope="col">No</th>
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Asal</th>
                                            <th scope="col">Dari</th>
                                            <th scope="col">Sampai</th>
                                        </tr>
                                        <!-- </thead> -->
                                        <?php $i = 1; ?>
                                        <tr class="table-light">
                                            <td scope="row"><?= $i++; ?></td>
                                            <td><?= $l['nama_peminjam']; ?></td>
                                            <td><?= $l['asal_instansi']; ?></td>
                                            <td><?= $l['wk_peminjamandr']; ?></td>
                                            <td><?= $l['wk_peminjamansp']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="card-text mb-2 ms-2">Terakhir diupdate : <small class="text-muted"><?= $l['updated_at']; ?></small></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detail<?= $l['id_peminjam']; ?>">Kembali</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal untuk menampilkan rentang/filter laporan ajuan -->
<div class="modal fade" id="rentang_p" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <form method="POST" action="/admin/adm_lpm/index">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Filter Laporan Ajuan Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="exampleDropdownFormEmail1" class="form-label"><b>Masukan rentang waktu : </b></label>
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="dr_filter_p" class="form-label">
                                            <h6>Dari</h6>
                                        </label>
                                        <input type="datee" name="dr_filter_p" id="dr_filter_p" value="<?= old('dr_filter_p'); ?>" class="form-control <?= (\Config\Services::validation()->hasError('dr_filter_p')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= \Config\Services::validation()->getError('dr_filter_p'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sp_filter_p" class="form-label">
                                            <h6>Sampai</h6>
                                        </label>
                                        <input type="datee" name="sp_filter_p" id="sp_filter_p" value="<?= old('sp_filter_p'); ?>" class="form-control inline <?= (\Config\Services::validation()->hasError('sp_filter_p')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= \Config\Services::validation()->getError('sp_filter_p'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="modal-footer">
                        <button class="bi bi-eye btn btn-success" id="tampilkan" type="submit" data-bs-toggle="modal"> Tampilkan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- modal untuk menampilkan rentang/filter inventaris -->
<div class="modal fade" id="rentang_i" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <form method="POST" action="/admin/adm_lpm/index">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Filter Laporan Inventaris</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="exampleDropdownFormEmail1" class="form-label"><b>Masukan rentang waktu : </b></label>
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="dr_filter_i" class="form-label">
                                            <h6>Dari</h6>
                                        </label>
                                        <input type="datee" name="dr_filter_i" id="dr_filter_i" value="<?= old('dr_filter_i'); ?>" class="form-control <?= (\Config\Services::validation()->hasError('dr_filter_i')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= \Config\Services::validation()->getError('dr_filter_i'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sp_filter_i" class="form-label">
                                            <h6>Sampai</h6>
                                        </label>
                                        <input type="datee" name="sp_filter_i" id="sp_filter_i" value="<?= old('sp_filter_i'); ?>" class="form-control inline <?= (\Config\Services::validation()->hasError('sp_filter_i')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= \Config\Services::validation()->getError('sp_filter_i'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="modal-footer">
                        <button class="bi bi-eye btn btn-success" id="tampilkan" type="submit" data-bs-toggle="modal"> Tampilkan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- script untuk batasan filter -->
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css">
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script type="text/javascript" src="/javascript/jquery.datetimepicker.full.min.js"></script>
<script>
    // picker from filter time
    $('#dr_filter_p').datetimepicker({
        datepicker: true,
        format: 'Y-m-d',
    })
    $('#sp_filter_p').datetimepicker({
        datepicker: true,
        format: 'Y-m-d',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#dr_filter_p').val() ? $('#dr_filter_p').val() : false
            })
        }
    })

    $('#dr_filter_i').datetimepicker({
        datepicker: true,
        format: 'Y-m-d',
    })
    $('#sp_filter_i').datetimepicker({
        datepicker: true,
        format: 'Y-m-d',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#dr_filter_i').val() ? $('#dr_filter_i').val() : false
            })
        }
    })
</script>

<!-- modal untuk menampilkan laporan ajuan yang ditentukan (with print feature) -->
<div class="modal fade" id="laporan_p" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Laporan Ajuan Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="print-area" id="laporan_cetak_p">
                <div class="modal-body">
                    <div class="row table-responsive">
                        <div class="col">
                            <h3>Laporan ajuan peminjaman aset ormawa fki</h3>
                            <hr>
                            <span>
                                <h5>Dari tanggal
                                    <span id="dr_p"></span>
                                    <?= $dari_p . " sampai " . $sampai_p ?>
                                    <span id="sp_p"></span>
                                </h5>
                            </span>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Peminjam</th>
                                        <th scope="col">Asal Instansi</th>
                                        <th scope="col">Nama kegiatan</th>
                                        <th scope="col">Inventaris dipinjam</th>
                                        <th scope="col">Tanggal pinjam</th>
                                        <th scope="col">Tanggal kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($laporan_p as $l) : ?>
                                        <tr>
                                            <td scope="row"><?= $i++ ?></td>
                                            <td><?= $l['nama_peminjam']; ?></td>
                                            <td><?= $l['asal_instansi']; ?></td>
                                            <td><?= $l['nama_kegiatan']; ?></td>
                                            <td><?= $l['nama_aset']; ?></td>
                                            <td><?= $l['wk_peminjamandr']; ?></td>
                                            <td><?= $l['wk_peminjamansp']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="bi bi-printer btn btn-success no-print" href="javascript:printDiv('laporan_cetak_p');"> Cetak</a>
                <!-- <button class="bi bi-arrow-left-square btn btn-primary" data-bs-target="#rentang" data-bs-toggle="modal"> Kembali</button> -->
            </div>
        </div>
    </div>
</div>

<!-- modal untuk menampilkan laporan inventaris yang ditentukan (with print feature) -->
<div class="modal fade" id="laporan_i" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Laporan Data Inventaris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="print-area" id="laporan_cetak_i">
                <div class="modal-body">
                    <div class="row table-responsive">
                        <div class="col">
                            <h3>Laporan Data Inventaris Ormawa FKI</h3>
                            <hr>
                            <span>
                                <h5>Dari tanggal
                                    <span id="dr_i"></span>
                                    <?= $dari_i . " sampai " . $sampai_i ?>
                                    <span id="sp_i"></span>
                                </h5>
                            </span>
                            <br>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">ID Inventaris</th>
                                        <th scope="col">Nama Inventaris</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Kondisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($aset as $a_lpm) : ?>
                                        <tr>
                                            <td scope="row"><?= $i++ ?></td>
                                            <th><img src="/img/<?= $a_lpm['gambar']; ?>" class="gambar"></th>
                                            <td><?= $a_lpm['id_inventaris']; ?></td>
                                            <td><?= $a_lpm['nama_aset']; ?></td>
                                            <td><?= $a_lpm['jumlah_kapasitas']; ?></td>
                                            <td><?= $a_lpm['status']; ?></td>
                                            <td><?= $a_lpm['kondisi']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="bi bi-printer btn btn-success no-print" href="javascript:printDiv('laporan_cetak_i');"> Cetak</a>
                <!-- <button class="bi bi-arrow-left-square btn btn-primary" data-bs-target="#rentang" data-bs-toggle="modal"> Kembali</button> -->
            </div>
        </div>
    </div>
</div>

<!-- script buat print halaman tertentu -->
<textarea id="printing-css" style="display:none;">.no-print{display: none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
    function printDiv(elementId) {
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
    $('#tampilkan').click(function() {
        $('#dr_p').text($('#dr_filter_p').val());
        $('#sp_p').text($('#sp_filter_p').val());
        $('#dr_i').text($('#dr_filter_i').val());
        $('#sp_i').text($('#sp_filter_i').val());
    });
</script>

<?= $this->endSection(); ?>