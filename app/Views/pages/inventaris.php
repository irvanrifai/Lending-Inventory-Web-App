<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mb-4 my-2">Inventaris Ormawa FKI</h4>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="row row-cols-2 row-cols-md-5 g-4 mx-1 my-1">
                        <?php foreach ($aset as $a_all) : ?>
                            <div class="col">
                                <div class="card border-3" style="width: 9rem;">
                                    <img src="/img/<?= $a_all['gambar']; ?>" class="img-fluid gambar mx-2 mt-2 rounded" style="height:7rem;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="height:4rem;"><?= $a_all['nama_aset']; ?></h5>
                                        <!-- <div class="col">
                                            <label class="card-text">Status : <?= $a_all['status']; ?></label>
                                        </div> -->
                                        <hr>
                                        <div align="right">
                                            <button type="button" class="bi bi-search btn btn-primary tooltip-test" title="Detail Aset" data-bs-toggle="modal" data-bs-target="#detail<?= $a_all['nomor']; ?>">
                                            </button>
                                            <!-- troli/cart langsung ke form peminjaman -->
                                            <!-- <a href="pinjam" class="bi bi-bag-plus btn btn-primary"></a> -->
                                            <!-- tombol pinjam langsung diarahkan ke form peminjaman -->
                                            <a href="pinjam" class="bi bi-arrow-up-right btn btn-warning tooltip-test" title="Pinjam Aset"></a>
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


<!-- modals untuk detailnya aset -->
<?php foreach ($aset as $a_all) : ?>
    <div class="modal fade" id="detail<?= $a_all['nomor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <img src="/img/<?= $a_all['gambar']; ?>" class="img-fluid rounded" style="height:9rem;">
                                <!-- <div class="card-body">
                                </div> -->
                            </div>
                            <div class="col-md-4 ms-4 mb-3">
                                <p>
                                <h5 class="card-title"><?= $a_all['nama_aset']; ?></h5>
                                <!-- <label class="card-text">ID Inventaris : <?= $a_all['id_inventaris']; ?></label> -->
                                <!-- <div class="row">
                                    <label class="card-text">Kepemilikan : </label>
                                </div> -->
                                <div class="row">
                                    <label class="card-text">Milik : <?= $a_all['kepemilikan']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Status : <?= $a_all['status']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Kondisi : <?= $a_all['kondisi']; ?></label>
                                </div>
                                <div class="row">
                                    <label class="card-text">Jumlah : <?= $a_all['jumlah_kapasitas']; ?></label>
                                </div>
                                </p>
                            </div>
                            <hr>
                            <div class="ms-2">
                                <h6>Jadwal Pemakaian</h6>
                            </div>
                            <div class="my-1 table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <!-- <thead> -->
                                        <tr align="center" class="table-secondary">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Agenda</th>
                                            <th scope="col">Dari</th>
                                            <th scope="col">Sampai</th>
                                        </tr>
                                        <!-- </thead> -->
                                        <?php $i = 1; ?>
                                        <tr class="table-light">
                                            <td scope="row"><?= $i++; ?></td>
                                            <td><?= $a_all['nama_peminjam']; ?></td>
                                            <td><?= $a_all['nama_kegiatan']; ?></td>
                                            <td><?= $a_all['wk_peminjamandr']; ?></td>
                                            <td><?= $a_all['wk_peminjamansp']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="card-text mb-2 ms-2">Terakhir diupdate : <small class="text-muted"><?= $a_all['updated_at']; ?></small></p>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>