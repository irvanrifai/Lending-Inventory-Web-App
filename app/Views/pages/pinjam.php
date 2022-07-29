<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mb-4">Ajuan Peminjaman Sarana Prasarana Ormawa FKI</h4>
            <?php

            use PhpParser\Node\Stmt\Echo_;

            if (session()->getFlashData('Pesan')) : ?>
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

            <!-- Formulir peminjaman (core) -->
            <form class="px-4 py-3" novalidate action="/peminjaman/save" role="form" method="POST" id="form_peminjaman" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_form">
                <?= csrf_field(); ?>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="nama_peminjam" class="form-label">
                            <h6>Nama<span style="color:red;">*</span></h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_peminjam')) ? 'is-invalid' : ''; ?>" id="nama_peminjam" name="nama_peminjam" placeholder="Nama Peminjam" value="<?= old('nama_peminjam'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('nama_peminjam'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">
                            <h6>Email<span style="color:red;">*</span></h6>
                        </label>
                        <input type="email" class="form-control <?= (\Config\Services::validation()->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Google Mail" value="<?= old('email'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('email'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="no_hp" class="form-label">
                            <h6>Nomor Telepon<span style="color:red;">*</span></h6>
                        </label>
                        <input type="number" class="form-control <?= (\Config\Services::validation()->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" placeholder="Nomor HP / WA" maxlength="15" value="<?= old('no_hp'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('no_hp'); ?>
                        </div>
                    </div>

                    <!-- Script untuk asal instansi -->
                    <script>
                        function toggleField(hideObj, showObj) {
                            hideObj.disabled = true;
                            hideObj.style.display = 'none';
                            showObj.disabled = false;
                            showObj.style.display = 'inline';
                            showObj.focus();
                        }
                    </script>
                    <div class="col-md-3">
                        <label for="asal_instansi" class="form-label">
                            <h6>Asal Instansi<span style="color:red;">*</span></h6>
                        </label>
                        <select id="asal_instansi" name="asal_instansi" class="form-select <?= (\Config\Services::validation()->hasError('asal_instansi')) ? 'is-invalid' : ''; ?>">
                            <option value="" selected disabled>Pilih Instansi</option>
                            <?php $option = array('Ormawa FKI', 'Internal FKI', 'Eksternal FKI');
                            foreach ($option as $asal_instansi) {
                                $selected = @$_POST['asal_instansi'] == $asal_instansi ? ' selected="selected"' : '';
                                echo '<option value="' . $asal_instansi . '"' . $selected . '>' . $asal_instansi . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('asal_instansi'); ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label for="alamat" class="form-label">
                            <h6>Alamat<span style="color:red;">*</span></h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Alamat" value="<?= old('alamat'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_kegiatan" class="form-label">
                            <h6>Nama Kegiatan<span style="color:red;">*</span></h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('nama_kegiatan')) ? 'is-invalid' : ''; ?>" id="nama_kegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan" value="<?= old('nama_kegiatan'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('nama_kegiatan'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tempat_pelaksanaan" class="form-label">
                            <h6>Tempat Pelaksanaan Kegiatan<span style="color:red;">*</span></h6>
                        </label>
                        <input type="text" class="form-control <?= (\Config\Services::validation()->hasError('tempat_pelaksanaan')) ? 'is-invalid' : ''; ?>" id="tempat_pelaksanaan" name="tempat_pelaksanaan" placeholder="Tempat Pelaksanaan Kegiatan" value="<?= old('tempat_pelaksanaan'); ?>">
                        <div class="invalid-feedback">
                            <?= \Config\Services::validation()->getError('tempat_pelaksanaan'); ?>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="exampleDropdownFormEmail1" class="form-label"><b>Waktu Pelaksanaan Kegiatan : </b></label>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="wk_pelaksanaandr" class="form-label">
                                    <h6>Dari<span style="color:red;">*</span></h6>
                                </label>
                                <input type="datetime" id="picker_dr" class="form-control <?= (\Config\Services::validation()->hasError('wk_pelaksanaandr')) ? 'is-invalid' : ''; ?>" id="wk_pelaksanaandr" name="wk_pelaksanaandr" value="<?= old('wk_pelaksanaandr'); ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_pelaksanaandr'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_pelaksanaansp" class="form-label">
                                    <h6>Sampai<span style="color:red;">*</span></h6>
                                </label>
                                <input type="datetime" id="picker_sp" class="form-control inline <?= (\Config\Services::validation()->hasError('wk_pelaksanaansp')) ? 'is-invalid' : ''; ?>" id="wk_pelaksanaansp" name="wk_pelaksanaansp" value="<?= old('wk_pelaksanaansp'); ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_pelaksanaansp'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-12 mt-5">
                        <a href="inventaris" class="bi bi-pencil btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftar_aset"> Pilih Daftar Aset Inventaris</a>
                    </div>
                    <input type="hidden" name="aset_h" id="aset_h" value="Projector(BEM FKI UMS), Sketsel(FINIC UMS)">
                    <input type="hidden" name="inventaris" id="inventaris" value="Projector(BEM FKI UMS), Sketsel(FINIC UMS)"> -->
                    <!-- <div class="col-md-12">
                        <a class="bi bi-cart-check btn btn-warning" data-bs-toggle="modal" data-bs-target="#keranjang_fix" id="cek_keranjang_fix"> Cek Keranjang</a>
                    </div> -->

                    <!-- wajib aset dipinjam -->
                    <div class="col-md-12 mt-4">
                        <label for="exampleDropdownFormEmail1" class="form-label"><b>Peminjaman Aset : </b></label>
                        <div class="row">
                            <div class="col-md-4 me-4">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Aset<span style="color:red;">*</span></h7>
                                </label>
                                <select name="id_inventaris" id="id_inventaris" class="form-select <?= (\Config\Services::validation()->hasError('id_inventaris')) ? 'is-invalid' : ''; ?>">
                                    <option value="" selected disabled>Pilih Aset</option>
                                    <?php foreach ($aset as $s) : ?>
                                        <option id="id__inventaris1" value="<?= $s['id_inventaris']; ?>"><?= $s['nama_aset']; ?> (<?= $s['kepemilikan']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('id_inventaris'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Waktu Pinjam Dari<span style="color:red;">*</span></h7>
                                </label>
                                <input type="datetime" id="picker_dri" class="form-control <?= (\Config\Services::validation()->hasError('wk_peminjamandr')) ? 'is-invalid' : ''; ?>" id="wk_peminjamandr" name="wk_peminjamandr" value="<?= (old('wk_peminjamandr')) ? old('wk_peminjamandr') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamandr'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamansp" class="form-label">
                                    <h7>Sampai<span style="color:red;">*</span></h7>
                                </label>
                                <input type="datetime" id="picker_spi" class="form-control inline <?= (\Config\Services::validation()->hasError('wk_peminjamansp')) ? 'is-invalid' : ''; ?>" id="wk_peminjamansp" name="wk_peminjamansp" value="<?= (old('wk_peminjamansp')) ? old('wk_peminjamansp') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamansp'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- optional 1 -->
                    <div class="col-md-12">
                        <div class="row">
                            <small class="text-muted mb-2">Opsional 2</small>
                            <div class="col-md-4 me-4">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Aset</h7>
                                </label>
                                <select name="id_inventaris2" id="id_inventaris2" class="form-select <?= (\Config\Services::validation()->hasError('id_inventaris2')) ? 'is-invalid' : ''; ?>">
                                    <option value="" selected disabled>Pilih Aset</option>
                                    <?php foreach ($aset as $s) : ?>
                                        <option id="id__inventaris2" value="<?= $s['id_inventaris']; ?>"><?= $s['nama_aset']; ?> (<?= $s['kepemilikan']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('id_inventaris2'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Waktu Pinjam Dari</h7>
                                </label>
                                <input type="datetime" id="picker_dri2" class="form-control <?= (\Config\Services::validation()->hasError('wk_peminjamandr2')) ? 'is-invalid' : ''; ?>" id="wk_peminjamandr2" name="wk_peminjamandr2" value="<?= (old('wk_peminjamandr2')) ? old('wk_peminjamandr2') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamandr2'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Sampai</h7>
                                </label>
                                <input type="datetime" id="picker_spi2" class="form-control inline <?= (\Config\Services::validation()->hasError('wk_peminjamansp2')) ? 'is-invalid' : ''; ?>" id="wk_peminjamansp2" name="wk_peminjamansp2" value="<?= (old('wk_peminjamansp2')) ? old('wk_peminjamansp2') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamansp2'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- optional 2 -->
                    <div class="col-md-12">
                        <div class="row">
                            <small class="text-muted mb-2">Opsional 3</small>
                            <div class="col-md-4 me-4">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Aset</h7>
                                </label>
                                <select name="id_inventaris3" id="id_inventaris3" class="form-select <?= (\Config\Services::validation()->hasError('id_inventaris3')) ? 'is-invalid' : ''; ?>">
                                    <option value="" selected disabled>Pilih Aset</option>
                                    <?php foreach ($aset as $s) : ?>
                                        <option id="id__inventaris3" value="<?= $s['id_inventaris']; ?>"><?= $s['nama_aset']; ?> (<?= $s['kepemilikan']; ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('id_inventaris3'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Waktu Pinjam Dari</h7>
                                </label>
                                <input type="datetime" id="picker_dri3" class="form-control <?= (\Config\Services::validation()->hasError('wk_peminjamandr3')) ? 'is-invalid' : ''; ?>" id="wk_peminjamandr3" name="wk_peminjamandr3" value="<?= (old('wk_peminjamandr3')) ? old('wk_peminjamandr3') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamandr3'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="wk_peminjamandr" class="form-label">
                                    <h7>Sampai</h7>
                                </label>
                                <input type="datetime" id="picker_spi3" class="form-control inline <?= (\Config\Services::validation()->hasError('wk_peminjamansp3')) ? 'is-invalid' : ''; ?>" id="wk_peminjamansp3" name="wk_peminjamansp3" value="<?= (old('wk_peminjamansp3')) ? old('wk_peminjamansp3') : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= \Config\Services::validation()->getError('wk_peminjamansp3'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" mt-4 col-md-12">
                        <p align="justify">
                        <ul>
                            <li>Seluruh proses peminjaman sarana dan prasarana serta aset organisasi mahasiswa fakultas komunikasi dan informatika dilakukan melalui sistem ini, adapun dalam proses peminjaman membutuhkan informasi detail dapat menghubungi email atau nomor telepon admin tertera.</li>
                            <li>Jika dalam proses meminjam terdapat kendala atau aset rusak harap menghubungi admin atau ormawa terkait.</li>
                            <li>Harap periksa kembali ajuan peminjaman yang anda ajukan dengan klik tombol pratinjau.</li>
                        </ul>
                        </p>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input centang" id="centang">
                            <label class="form-check-label" for="dropdownCheck">
                                Saya telah membaca dan menyetujui regulasi diatas<span style="color:red;">*</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <a class="bi bi-eye btn btn-primary disabled" data-bs-target="#pratinjau" data-bs-toggle="modal" id="pratinjauBtn"> Pratinjau</a>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- script for enable/disable pratinjau -->
<script>
    $("input[type=checkbox]").on("change", function(e) {
        var pratinjau = $('input[id=centang]:checked');
        if (pratinjau.length == 0) {
            $("a[id=pratinjauBtn]").addClass("disabled");
        } else {
            $("a[id=pratinjauBtn]").removeClass("disabled");
        }
    });
</script>

<!-- modal untuk pratinjau ajuan bentuk surat peminjaman sebelum dikirim -->
<div class="modal fade" id="pratinjau" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Pratinjau Ajuan Peminjaman Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="pdf_form">
                <div class="col-md-12 mb-2">
                    <table border="0" class="table-responsive">
                        <thead>
                            <tr>
                                <td align="left">
                                    <img src="/img/LOGO-FKI-baru.png" width="150" alt="">
                                    <h3>SPOKI UMS</h3>
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <h5>FORMULIR AJUAN PEMINJAMAN ASET ORMAWA FKI</h5>
                                </td>
                            </tr>
                        </thead>
                        <tr>
                            <td colspan="3">
                                Bersama pesan dan formulir terlampir ini merupakan keterangan serta kelengkapan informasi ajuan peminjaman aset organisasi mahasiswa fakultas komunikasi dan infromatika universitas muhammadiyah surakarta. <br>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="col-md-12 mb-2">
                                    <table class="table">
                                        <thead>
                                            <th>
                                                <li>
                                                    Identitas Peminjam
                                                </li>
                                            </th>
                                        </thead>
                                        <tr>
                                            <th>Nama Peminjam</th>
                                            <td id="n_peminjam"></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td id="_email"></td>
                                        </tr>
                                        <tr>
                                            <th>No Telepon</th>
                                            <td id="n_hp"></td>
                                        </tr>
                                        <tr>
                                            <th>Asal instansi</th>
                                            <td id="a_instansi"></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td id="_alamat"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <table class="table">
                                        <thead>
                                            <th>
                                                <li>
                                                    Keterangan kegiatan
                                                </li>
                                            </th>
                                        </thead>
                                        <tr>
                                            <th>Nama kegiatan</th>
                                            <td id="n_kegiatan"></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat pelaksanaan</th>
                                            <td id="t_pelaksanaan"></td>
                                        </tr>
                                        <tr>
                                            <th>Waktu pelaksanaan kegiatan</th>
                                            <td id="wp_dr"></td>
                                            <td>sampai</td>
                                            <td id="wp_sp"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <table class="table">
                                        <thead>
                                            <th>
                                                <li>
                                                    Detail aset dipinjam
                                                </li>
                                            </th>
                                        </thead>
                                        <tr>
                                            <th>Aset yang dipinjam</th>
                                            <th>Waktu peminjaman aset</th>
                                        <tr>
                                            <td id="id_inv1"></td>
                                            <td id="wpem_dr"></td>
                                            <td>sampai</td>
                                            <td id="wpem_sp"></td>
                                        </tr>
                                        <tr>
                                            <td id="id_inv2"></td>
                                            <td id="wpem_dr2"></td>
                                            <td>sampai</td>
                                            <td id="wpem_sp2"></td>
                                        </tr>
                                        <tr>
                                            <td id="id_inv3"></td>
                                            <td id="wpem_dr3"></td>
                                            <td>sampai</td>
                                            <td id="wpem_sp3"></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br>
                                Demikian merupakan informasi mengenai peminjaman aset organisasi mahasiswa fakultas komunikasi dan informatika universitas muhammadiyah surakarta. Mohon dapat digunakan dengan baik.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><br>
                                Dibawah merupakan nomor telepon atau whatapps pengelola yang dapat dihubungi : <br>
                                08123456789 (Sat) <br>
                                08987654321 (Set)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right"><br> Pengelola SPOKI<br>
                                <img class="ms-2 img-fluid" src="/img/ttd irvan.png" width="12%" alt=""><br>
                                SatsetSatset
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a class="bi bi-printer btn btn-success no-print" href="javascript:printDiv('pdf_form');"> Cetak</a> -->
                <button type="submit" class="bi bi-send btn btn-primary" id="submit" data-bs-toggle="modal"> Kirim</button>
            </div>
        </div>
    </div>
    </form>
</div>

<!-- script pratinjau after send -->
<script>
    $('#pratinjauBtn').click(function() {
        $('#n_peminjam').text($('#nama_peminjam').val());
        $('#n_pem').text($('#nama_peminjam').val());
        $('#n_pemin').text($('#nama_peminjam').val());
        $('#_email').text($('#email').val());
        $('#n_hp').text($('#no_hp').val());
        $('#a_instansi').text($('#asal_instansi').val());
        $('#_alamat').text($('#alamat').val());
        $('#n_kegiatan').text($('#nama_kegiatan').val());
        $('#t_pelaksanaan').text($('#tempat_pelaksanaan').val());
        $('#id_inv1').text($('#id_inventaris').val());
        $('#id_inv2').text($('#id_inventaris2').val());
        $('#id_inv3').text($('#id_inventaris3').val());
        $('#wp_dr').text($('#picker_dr').val());
        $('#wp_sp').text($('#picker_sp').val());
        $('#wpem_dr').text($('#picker_dri').val());
        $('#wpem_dr2').text($('#picker_dri2').val());
        $('#wpem_dr3').text($('#picker_dri3').val());
        $('#wpem_sp').text($('#picker_spi').val());
        $('#wpem_sp2').text($('#picker_spi2').val());
        $('#wpem_sp3').text($('#picker_spi3').val());
    });

    $('#submit').click(function() {
        $('#form_peminjaman').submit();
    });
</script>

<!-- Jangan lupa fitur surat/invoice peminjaman dikirim ke email admin:) -->


<!-- Modal untuk daftar aset inventaris yang akan dipilih -->
<?php foreach ($aset as $a_all) : ?>
    <form novalidate action="/peminjaman/index" method="post" role="form" enctype="multipart/form-data" class="needs-validation">
        <div class="modal fade" id="daftar_aset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daftar Inventaris Ormawa FKI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="daftar_aset">
                        <div class="card-group">
                            <div class="row row-cols-2 row-cols-md-4 g-3">
                                <?php foreach ($aset as $a_all) : ?>
                                    <div class="col">
                                        <div class="card border-3" style="width: 11rem;">
                                            <img src="/img/<?= $a_all['gambar']; ?>" class="img-fluid rounded gambar mx-2 mt-2" style="height:7rem;">
                                            <div class="card-body">
                                                <h4 class="card-title" id="nama_aset"><?= $a_all['nama_aset']; ?></h4>
                                                <h6 class="card-text"><?= $a_all['kepemilikan']; ?></h6>
                                                <p class="card-text">Jumlah : <?= $a_all['jumlah_kapasitas']; ?></p>
                                                <hr>
                                                <div align="right" class="card-img-overlay">
                                                    <!-- troli/cart langsung ke form peminjaman -->
                                                    <!-- <a href="pinjam" class="bi bi-bag-plus btn btn-primary"></a> -->
                                                    <!-- tombol pinjam langsung diarahkan ke form peminjaman -->
                                                    <!-- <input type="checkbox" class="form-check-input-lg bi bi-cart-plus btn btn-warning tooltip-test" value="<?= $a_all['id_inventaris']; ?>" title="Masukkan ke keranjang" name="addTo[]" id="addTo"></input> -->
                                                    <!-- <label class="bi bi-cart-plus btn btn-warning">Pilih</label> -->
                                                    <!-- <a type="button" class="bi bi-cart-plus btn btn-warning tooltip-test" value="<?= $a_all['id_inventaris']; ?>" title="Masukkan ke keranjang" name="addTo[]" id="addTo"></a> -->
                                                    <input type="checkbox" class="form-check-input tooltip-test btn btn-outline-secondary btn-lg mb-4" value="<?= $a_all['id_inventaris']; ?>" title="Pilih" name="addTo[]" id="addTo" autocomplete="off"><br>
                                                    <a type="button" class="bi bi-fullscreen tooltip-test mt-4" title="Detail Aset" data-bs-toggle="modal" data-bs-target="#detail<?= $a_all['nomor']; ?>"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="bi bi-eye btn btn-warning disabled" id="cek_keranjang" name="cek_keranjang" data-bs-toggle="modal" data-bs-target="#keranjang"> Lihat keranjang</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
<?php endforeach; ?>


<!-- modal untuk cek/lihat keranjang -->
<div class="modal fade" id="keranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keranjang Peminjaman Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Haloo, ini keranjang pinjam aset anda, <span id="n_pemin"></span>
                <div class="row mt-2">
                    <div class="col">
                        <table class="table">
                            <tr>
                                <th>Nama Aset</th>
                                <th>Kepemilikan</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <th id="n_aset_f"></th>
                                <th id="kepemilikan_f"></th>
                                <th id="jumlah_f"></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="bi bi-arrow-left-square btn btn-secondary tooltip-test" title="Kembali ke daftar" data-bs-toggle="modal" href="#daftar_aset"> Kembali</a>
                <a class="bi bi-check-lg btn btn-primary disabled" data-bs-target="#pratinjau" data-bs-toggle="modal" id="selesai_cart"> Selesai</a>
            </div>
        </div>
    </div>
</div>

<!-- modal untuk keranjang fix -->
<div class="modal fade" id="keranjang_fix" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keranjang Peminjaman Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Haloo, ini keranjang pinjam aset anda, <span id="n_pem"></span>
                <div class="row mt-2">
                    <div class="col">
                        <table class="table">
                            <tr>
                                <th>Nama Aset</th>
                                <th>Kepemilikan</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <th id="n_aset_f"></th>
                                <th id="kepemilikan_f"></th>
                                <th id="jumlah_f"></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="bi bi-arrow-counterclockwise btn btn-danger tooltip-test" title="Reset isi keranjang" data-bs-toggle="modal" href=""> Reset</a>
                <a class="bi bi-check-lg btn btn-primary disabled" data-bs-target="#pratinjau" data-bs-toggle="modal" id="selesai_cart"> Oke</a>
            </div>
        </div>
    </div>
</div>

<!-- modals untuk detail -->
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
                                <img src="/img/<?= $a_all['gambar']; ?>" class="img-fluid rounded" alt="...">
                                <!-- <div class="card-body">
                                </div> -->
                            </div>
                            <div class="col-md-4 ms-4 mb-3">
                                <p>
                                <h5 class="card-title"><?= $a_all['nama_aset']; ?></h5>
                                <!-- <label class="card-text">ID Inventaris : <?= $a_all['id_inventaris']; ?></label> -->
                                <div class="row">
                                    <label class="card-text">Kepemilikan : <?= $a_all['kepemilikan']; ?></label>
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
                            <div class="my-1">
                                <table class="table table-bordered">
                                    <tbody>
                                        <!-- <thead> -->
                                        <tr align="center" class="table-secondary">
                                            <th scope="col">No</th>
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Waktu</th>
                                        </tr>
                                        <!-- </thead> -->
                                        <tr class="table-light">
                                            <td scope="row">1</td>
                                            <td>Mark Zukerberg</td>
                                            <td>12-4-2022</td>
                                            <td>12.30-18.00</td>
                                        </tr>
                                        <tr>
                                            <td scope="row">2</td>
                                            <td>Jacob Bezos</td>
                                            <td>13-2-2022</td>
                                            <td>13.00-21.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="card-text mb-2 ms-2">Terakhir diupdate : <small class="text-muted"><?= $a_all['updated_at']; ?></small></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a role="button" class="bi bi-arrow-left-square btn btn-secondary tooltip-test" title="Kembali ke daftar" data-bs-toggle="modal" href="#daftar_aset"> Kembali</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- My data table js and css -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

<!-- script untuk (atc/row selected) to value variable -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select').on('change', function() {
            $('option').prop('disabled', false); //reset all the disabled options on every change event
            $('select').each(function() { //loop through all the select elements
                var val = this.value;
                $('select').not(this).find('option').filter(function() { //filter option elements having value as selected option
                    return this.value === val;
                }).prop('disabled', true); //disable those option elements
            });
        }).change(); //trihgger change handler initially!
    });
</script>

<!-- Condition for datetime pelaksanaan dan peminjaman -->
<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="/javascript/jquery.datetimepicker.full.min.js"></script>
<script>
    // picker from wk_pelaksanaan
    jQuery.datetimepicker.setLocale('id')
    $('#picker_dr').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday'
    })
    $('#picker_sp').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#picker_dr').val() ? $('#picker_dr').val() : false
            })
        }
    })

    // picker from wk_peminjaman wajib
    $('#picker_dri').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday'
    })
    $('#picker_spi').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#picker_dri').val() ? $('#picker_dri').val() : false
            })
        }
    })

    // picker from wk_peminjaman 2
    $('#picker_dri2').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday'
    })
    $('#picker_spi2').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#picker_dri2').val() ? $('#picker_dri2').val() : false
            })
        }
    })

    // picker from wk_peminjaman 3
    $('#picker_dri3').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday'
    })
    $('#picker_spi3').datetimepicker({
        timepicker: true,
        datepicker: true,
        step: 15,
        format: 'Y-m-d H:i',
        minDateTime: 'dateToday',
        onShow: function(ct) {
            this.setOptions({
                minDateTime: $('#picker_dri3').val() ? $('#picker_dri3').val() : false
            })
        }
    })
</script>

<!-- script buat print halaman tertentu -->
<!-- <textarea id="printing-css" style="display:none;">.no-print{display: none}</textarea>
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
</script> -->

<?= $this->endSection(); ?>