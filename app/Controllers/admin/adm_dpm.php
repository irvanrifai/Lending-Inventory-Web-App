<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\adminModel\asetModel;
use App\Models\PeminjamanModel;
use TCPDF;

class adm_dpm extends BaseController
{
    protected $asetModel;
    protected $PeminjamanModel;

    public function __construct()
    {
        $this->asetModel = new asetModel();
        $this->PeminjamanModel = new PeminjamanModel();
        $this->email = \Config\Services::email();
        helper('form');
    }

    public function index()
    {
        $dari_p = $this->request->getVar('dr_filter_p');
        $sampai_p = $this->request->getVar('sp_filter_p');
        $dari_i = $this->request->getVar('dr_filter_i');
        $sampai_i = $this->request->getVar('sp_filter_i');

        $kepemilikan = ['DPM FKI UMS'];

        $data = [
            'title' => 'Admin | SPOKI UMS',

            'dari_i' => $dari_i,
            'sampai_i' => $sampai_i,
            'aset' => $this->asetModel->filter_laporan($dari_i, $sampai_i)->where('kepemilikan', $kepemilikan)->orderBy('nomor', 'DESC')->distinct()->get()->getResultArray(),

            'dari_p' => $dari_p,
            'sampai_p' => $sampai_p,
            'laporan_p' => $this->PeminjamanModel->filter_laporan($dari_p, $sampai_p)->where('tb_aset.kepemilikan', $kepemilikan)->get()->getResultArray(),

            'total_ajuan' => $this->PeminjamanModel->hitung('peminjaman'),
            'total_inv' => $this->asetModel->where('kepemilikan', $kepemilikan)->countAllResults(),
            'most_b_n' => $this->PeminjamanModel->sering_nama($kepemilikan),
        ];

        return view('pages/admin/adm_dpm', $data);
    }

    public function save()
    {
        //validasi read the manual book CI 4
        if (!$this->validate([
            'gambar' => [
                'rules' => 'max_size[gambar,5120]|is_image[gambar]|mime_in[gambar,image/jpg,image/JPG,image/jpeg,image/JPEG,image/png,image/PNG]',
                'errors' => [
                    'max_size' => 'Gambar yang anda masukkan melebihi ukuran(5 Mb).',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar berekstensi (.jpg/.jpeg/.png)'
                ]
            ],
            'kepemilikan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kepemilikan harus diisi']
            ],
            'cb_nb' => [
                'rules' => 'max_length[15]',
                'errors' => ['max_length' => 'Input tidak valid']
            ],
            'id_inventaris' => [
                'rules' => 'required|max_length[25]|is_unique[inventaris.id_inventaris]',
                'errors' => [
                    'required' => 'ID Inventaris tidak boleh kosong.',
                    'max_length' => 'ID Inventaris terlalu panjang (25 Char)',
                    'is_unique' => 'ID Inventaris sudah ada'
                ]
            ],
            'nama_aset' => [
                'rules' => 'required|max_length[40]',
                'errors' => [
                    'required' => 'Nama aset tidak boleh kosong.',
                    'max_length' => 'Nama aset terlalu panjang (40 Char)'
                ]
            ],
            'jumlah_kapasitas' => [
                'rules' => 'required|max_length[5]|greater_than[0]',
                'errors' => [
                    'required' => 'Jumlah / Kapasitas aset tidak boleh kosong..',
                    'max_length' => 'Jumlah / Kapasitas melebihi ukuran maksimal (5 digit)',
                    'greater_than' => 'Jumlah / Kapasitas tidak boleh kurang dari 1'
                ]
            ],
            'status' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Status tidak boleh kosong.',
                    'max_length' => 'Karakter Status terlalu panjang (15 Char)'
                ]
            ],
            'kondisi' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Kondisi tidak boleh kosong.',
                    'max_length' => 'Karakter Kondisi terlalu panjang (15 Char)'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/pages/admin')->withInput()->with('validation', $validation);
            session()->setFlashdata('Gagal', ' Data aset baru gagal ditambahkan.');
            return redirect()->to('/pages/admin/adm_dpm')->withInput();
        }

        // ambil gambar
        $file_gambar = $this->request->getFile('gambar');

        // kondisi gambar ada atau tidak
        if ($file_gambar->getError() == 4) {
            $nama_gambar = 'SD-default-image.png';
        } else {
            // generate nama gambar
            $nama_gambar = $file_gambar->getRandomName();
            // pindahkan gambar ke folder img
            $file_gambar->move('img', $nama_gambar);
        }

        $this->asetModel->save([
            'gambar' => $nama_gambar,
            'id_inventaris' => $this->request->getVar('id_inventaris'),
            'kepemilikan' => $this->request->getVar('kepemilikan'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'jumlah_kapasitas' => $this->request->getVar('jumlah_kapasitas'),
            'status' => $this->request->getVar('status'),
            'kondisi' => $this->request->getVar('kondisi'),
            'cb_nb' => $this->request->getVar('cb_nb'),
        ]);

        session()->setFlashdata('Pesan', ' Data aset baru berhasil ditambahkan.');
        return redirect()->to('/pages/admin/adm_dpm');
    }

    public function create()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('/pages/admin/adm_dpm', $data);
    }

    public function edit($nomor)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'aset' => $this->asetModel->getaset($nomor),
            'title' => 'Admin Ormawa | SPOKI UMS'
        ];
        return view('pages/admin/adm_dpm', $data);
    }

    public function update($nomor)
    {
        // cek ID inventaris
        // $inventaris_lama = $this->adm_dpmModel->getadm_dpm($this->request->getVar('nomor'));
        // if ($inventaris_lama['id_inventaris'] == $this->request->getVar('id_inventaris')) {
        $rule_id_inventaris = 'required|max_length[25]';
        // } else {
        // $rule_id_inventaris = 'required|max_length[25]|is_unique[inventaris.id_inventaris]';
        // }

        if (!$this->validate([
            'gambar' => [
                'rules' => 'max_size[gambar,5120]|is_image[gambar]|mime_in[gambar,image/jpg,image/JPG,image/jpeg,image/JPEG,image/png,image/PNG]',
                'errors' => [
                    'max_size' => 'Gambar yang anda masukkan melebihi ukuran.',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'File harus berupa gambar berekstensi (.jpg/.jpeg/.png)'
                ]
            ],
            'kepemilikan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kepemilikan harus diisi']
            ],
            'cb_nb' => [
                'rules' => 'max_length[10]',
                'errors' => ['max_length' => 'Hanya dapat diisi dengan panjang 10']
            ],
            'id_inventaris' => [
                'rules' => $rule_id_inventaris,
                'errors' => [
                    'required' => 'ID harus diisi harus diisi.',
                    'is_unique' => 'ID inventaris sudah ada',
                    'max_length' => 'ID Inventaris terlalu panjang'
                ]
            ],
            'nama_aset' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'nama aset harus diisi.',
                    'max_length' => 'nama aset terlalu panjang'
                ]
            ],
            'jumlah_kapasitas' => [
                'rules' => 'required|max_length[20]|greater_than[0]',
                'errors' => [
                    'required' => 'jumlah harus diisi.',
                    'max_length' => 'jumlah melebihi batas maksimum',
                    'greater_than' => 'Jumlah / Kapasitas tidak boleh kurang dari 1'
                ]
            ],
            'status' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'status harus diisi.',
                    'max_length' => 'status melebihi batas maksimum'
                ]
            ],
            'kondisi' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'kondisi harus diisi.',
                    'max_length' => 'kondisi melebihi batas maksimum'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/pages/admin')->withInput()->with('validation', $validation);
            session()->setFlashdata('Gagal', ' Data aset gagal diedit.');
            return redirect()->to('/pages/admin/adm_dpm/' . $this->request->getVar('nomor'))->withInput();
        }


        $file_gambar = $this->request->getFile('gambar');
        $in = $this->asetModel->find($nomor);

        // cek gambar baru atau lama
        if ($file_gambar->getError() == 4) {
            $nama_gambar = $this->request->getVar('gambar_lama');
        } else {
            // generate nama
            $nama_gambar = $file_gambar->getRandomName();
            // pindahkan/upload gambar baru
            $file_gambar->move('img', $nama_gambar);
            // cek jika gambar bukan default=hapus. kalau default jangan hapus
            if ($in['gambar'] != 'SD-default-image.png') {
                unlink('img/' . $this->request->getVar('gambar_lama'));
            }
        }

        $this->asetModel->save([
            'nomor' => $nomor,
            'gambar' => $nama_gambar,
            'id_inventaris' => $this->request->getVar('id_inventaris'),
            'kepemilikan' => $this->request->getVar('kepemilikan'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'jumlah_kapasitas' => $this->request->getVar('jumlah_kapasitas'),
            'status' => $this->request->getVar('status'),
            'kondisi' => $this->request->getVar('kondisi'),
            'cb_nb' => $this->request->getVar('cb_nb'),
        ]);

        session()->setFlashdata('Pesan', ' Data aset berhasil diedit.');
        return redirect()->to('/pages/admin/adm_dpm');
    }

    public function delete($nomor)
    {
        // cari gambar berdasarkan nomor
        $aset = $this->asetModel->find($nomor);

        // cek jika gambar default atau tidak
        if ($aset['gambar'] != 'SD-default-image.png') {
            // hapus file fisik gambar
            unlink('img/' . $aset['gambar']);
        }

        $this->asetModel->delete($nomor);
        session()->setFlashdata('Pesan', ' Data aset berhasil dihapus.');
        return redirect()->to('/pages/admin/adm_dpm');
    }

    // hapus buat peminjaman
    public function remove($id_peminjam)
    {
        $this->PeminjamanModel->delete($id_peminjam);
        session()->setFlashdata('message_s', ' Data ajuan peminjaman berhasil dihapus.');
        return redirect()->to('/pages/admin/aset');

        // session()->setTempdata('Gagal', ' Data aset gagal dihapus.');
        // return redirect()->to('/pages/admin');
    }

    // email dan file pdf
    public function filePdf()
    {
        $scope_cetak = $this->request->getBody('pdf_form');
        // $nama_peminjam = $this->request->getVar('nama_peminjam');
        // $email = $this->request->getVar('email');
        // $no_hp = $this->request->getVar('no_hp');
        // $asal_instansi = $this->request->getVar('asal_instansi');
        // $alamat = $this->request->getVar('alamat');
        // $nama_kegiatan = $this->request->getVar('nama_kegiatan');
        // $tempat_pelaksanaan = $this->request->getVar('tempat_pelaksanaan');
        // $wk_pelaksanaandr = $this->request->getVar('wk_pelaksanaandr');
        // $wk_pelaksanaansp = $this->request->getVar('wk_pelaksanaansp');
        // $wk_peminjamandr = $this->request->getVar('wk_peminjamandr');
        // $wk_peminjamansp = $this->request->getVar('wk_peminjamansp');
        // $id_inventaris = $this->request->getVar('id_inventaris')
        dd($scope_cetak);
        $html = view('pages/pinjam', [
            'scope_cetak' => $scope_cetak,
            // 'nama_peminjam' => $nama_peminjam,
            // 'email' => $email,
            // 'no_hp' => $no_hp,
            // 'asal_instansi' => $asal_instansi,
            // 'alamat' => $alamat,
            // 'nama_kegiatan' => $nama_kegiatan,
            // 'tempat_pelaksanaan' => $tempat_pelaksanaan,
            // 'wk_pelaksanaandr' => $wk_pelaksanaandr,
            // 'wk_pelaksanaansp' => $wk_pelaksanaansp,
            // 'wk_peminjamandr' => $wk_peminjamandr,
            // 'wk_peminjamansp' => $wk_peminjamansp,
        ]);
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SPOKI UMS 2022');
        // $pdf->SetTitle('Informasi Peminjaman Aset Ormawa FKI');
        // $pdf->SetSubject('');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('lampiran formulir.pdf', 'I');
    }

    public function sendEmail()
    {
        $email_to = $this->request->getVar('email');
        $nama_peminjam = $this->request->getVar('nama_peminjam');

        $this->email->setFrom('spokiums@gmail.com', 'SPOKI UMS 2022 Email System');
        $this->email->setTo($email_to, 'spokiums@gmail.com');
        // $this->email->attach();
        $this->email->setSubject('Informasi Peminjaman Aset Ormawa FKI');
        $this->email->setMessage('Halo' . $nama_peminjam . ', berikut kami sampaikan informasi dan file dari ajuan peminjaman yang kamu ajukan');

        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }

    // edit buat konfirmasi ajuan
    public function edit_a($id_peminjam)
    {
        $data = [
            'aset' => $this->PeminjamanModel->getPeminjamanModel($id_peminjam),
            'title' => 'Admin Ormawa | SPOKI UMS'
        ];
        return view('/pages/admin/adm_dpm', $data);
    }
    public function update_a($id_peminjam)
    {
        if (!$this->validate([
            'st_ts' => [
                'rules' => 'integer',
                'errors' => ['integer' => 'Proses keputusan konfirmasi gagal']
            ]
        ])) {
            return redirect()->to('/pages/admin/adm_dpm/');
        }

        $this->PeminjamanModel->save([
            'id_peminjam' => $id_peminjam,
            'st_ts' => $this->request->getVar('st_ts'),
        ]);
        return redirect()->to('/pages/admin/adm_dpm');
    }
}
