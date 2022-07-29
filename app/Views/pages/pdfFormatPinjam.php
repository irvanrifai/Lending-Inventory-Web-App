<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Peminjaman</title>
</head>

<body>
    <table border="0">
        <thead>
            <tr>
                <td align="left">
                    <img src="/img/LOGO-FKI-baru.png" width="200" alt="" style="margin-bottom: -30px;">
                    <h1>SPOKI UMS</h1>
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <h3>FORMULIR AJUAN PEMINJAMAN ASET ORMAWA FKI</h3>
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
                <table class="table" border="1">
                    <thead>
                        <th>
                            <li>
                                Identitas Peminjam
                            </li>
                        </th>
                    </thead>
                    <tr>
                        <th>Nama Peminjam</th>
                        <td id="n_peminjam"><?= $nama_peminjam ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="_email"><?= $email ?></td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td id="n_hp"><?= $no_hp ?></td>
                    </tr>
                    <tr>
                        <th>Asal instansi</th>
                        <td id="a_instansi"><?= $asal_instansi ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td id="_alamat"><?= $alamat ?></td>
                    </tr>
                </table>
                </div>
                <div class="col-md-12 mb-2">
                    <table class="table" border="1">
                        <thead>
                            <th>
                                <li>
                                    Keterangan kegiatan
                                </li>
                            </th>
                        </thead>
                        <tr>
                            <th>Nama kegiatan</th>
                            <td id="n_kegiatan"><?= $nama_kegiatan ?></td>
                        </tr>
                        <tr>
                            <th>Tempat pelaksanaan</th>
                            <td id="t_pelaksanaan"><?= $tempat_pelaksanaan ?></td>
                        </tr>
                        <tr>
                            <th>Waktu pelaksanaan kegiatan</th>
                            <td id="wp_dr"><?= $wk_pelaksanaandr ?></td>
                            <td>sampai</td>
                            <td id="wp_sp"><?= $wk_pelaksanaansp ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 mb-2">
                    <table class="table" border="1">
                        <thead>
                            <th>
                                <li>
                                    Detail aset dipinjam
                                </li>
                            </th>
                        </thead>
                        <tr>
                            <th>Aset yang dipinjam</th>
                            <td id="id_inv">ON PROGRES...</td>
                        </tr>
                        <tr>
                            <th>Waktu peminjaman aset</th>
                            <td id="wpem_dr"><?= $wk_peminjamandr ?></td>
                            <td>sampai</td>
                            <td id="wpem_sp"><?= $wk_peminjamansp ?></td>
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
                <img src="/img/ttd irvan.png" width="8%" alt=""><br>
                SatsetSatset
            </td>
        </tr>
    </table>
</body>

</html>