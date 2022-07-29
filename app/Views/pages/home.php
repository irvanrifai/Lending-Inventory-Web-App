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
        $('#tb_agenda').DataTable();
    });
</script>
<div class="container">
    <div class="row">
        <?php if (session()->getFlashdata('success_login')) : ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <div>
                    <?= session()->getFlashdata('success_login'); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6 fadeIn">
            <a><img align="" src='/img/contoo.jpg' class="img-fluid rounded" width='500' height="300"></a>
        </div>
        <div class="col-md-6 fadeIn mt-2">
            <a>
                <h5>Sistem Informasi Inventaris dan Peminjaman Aset Ormawa FKI UMS</h5>
            </a>
            <p align="justify">
                Spoki ums merupakan sistem yang digunakan untuk memanajemen inventaris dan peminjaman aset, sistem ini bertujuan untuk mempermudah anggota ormawa untuk melakukan inventarisasi aset agar sinkron antara status dan kondisi aset didalam sistem dengan status dan kondisi nyata aset, kemudian untuk manajemen peminjaman digunakan untuk mengatur lalu lintas peminjaman baik antar ormawa fki maupun ormawa fki dengan pihak diluar fakultas, dari segi alur peminjaman hingga prioritas peminjam aset.
            </p>
        </div>
        <div class="row"><br></div>
        <hr>
        <div class="row">
            <div class="col">
                <h5 class="my-3">Agenda Ormawa Fakultas Komunikasi & Informatika</h5>
                <div class="table-responsive">
                    <table class="table" id="tb_agenda">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Agenda</th>
                                <th scope="col">Penyelenggara</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Pukul</th>
                                <th scope="col">Tempat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($home as $h) : ?>
                                <tr>
                                    <td scope="row"><?= $i++; ?></td>
                                    <td><?= $h['agenda']; ?></td>
                                    <td><?= $h['penyelenggara']; ?></td>
                                    <td><?= $h['waktu']; ?></td>
                                    <td><?= $h['jam']; ?></td>
                                    <td><?= $h['tempat']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>