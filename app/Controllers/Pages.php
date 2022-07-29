<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HomeModel;
use App\Models\InventarisModel;

class Pages extends BaseController
{
    protected $HomeModel;
    protected $InventarisModel;
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
        $this->InventarisModel = new InventarisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home | SPOKI UMS',
            'home' => $this->HomeModel->getHomeModel(),
            'inventaris' => $this->InventarisModel->getInventaris()
        ];

        return view('pages/home', $data);
    }

    // public function inventaris()
    // {
    //     // $inventaris = $this->InventarisModel->findAll();

    //     $data = [
    //         'title' => 'Inventaris | SPOKI UMS',
    //         'inventaris' => $this->InventarisModel->getInventaris()
    //     ];
    //     return view('pages/inventaris', $data);
    //     // echo view('pages/pinjam', $data);
    // }

    // public function detail($nama_aset)
    // {
    //     $data = [
    //         'inventaris' => $this->InventarisModel->getInventaris($nama_aset)
    //     ];

    //     if (empty($data['inventaris'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Data aset ' . $nama_aset . ' tidak ditemukan');
    //     }
    //     return view('pages/inventaris', $data);
    // }

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
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required' => 'Jumlah / Kapasitas aset tidak boleh kosong..',
                    'max_length' => 'Jumlah / Kapasitas melebihi ukuran maksimal (5 digit)'
                ]
            ],
            'status_kondisi' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Status dan Kondisi tidak boleh kosong.',
                    'max_length' => 'Karakter Status dan Kondisi terlalu panjang (15 Char)'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/pages/admin')->withInput()->with('validation', $validation);
            session()->setFlashdata('Gagal', ' Data aset baru gagal ditambahkan.');
            return redirect()->to('/pages/admin')->withInput();
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


        $this->InventarisModel->save([
            'gambar' => $nama_gambar,
            'id_inventaris' => $this->request->getVar('id_inventaris'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'jumlah_kapasitas' => $this->request->getVar('jumlah_kapasitas'),
            'status_kondisi' => $this->request->getVar('status_kondisi')
        ]);

        session()->setFlashdata('Pesan', ' Data aset baru berhasil ditambahkan.');
        return redirect()->to('/pages/admin');
    }

    public function create()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('/pages/admin', $data);
    }

    public function edit($nomor)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'inventaris' => $this->InventarisModel->getInventaris($nomor),
            'title' => 'Admin Ormawa | SPOKI UMS'
        ];
        return view('/pages/admin', $data);
    }

    public function update($nomor)
    {
        // cek ID inventaris
        $inventaris_lama = $this->InventarisModel->getInventaris($this->request->getVar('nomor'));
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
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'jumlah harus diisi.',
                    'max_length' => 'jumlah melebihi batas maksimum'
                ]
            ],
            'status_kondisi' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'status kondisi harus diisi.',
                    'max_length' => 'status kondisi melebihi batas maksimum'
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/pages/admin')->withInput()->with('validation', $validation);
            session()->setFlashdata('Gagal', ' Data aset gagal diedit.');
            return redirect()->to('/pages/admin/' . $this->request->getVar('nomor'))->withInput();
        }


        $file_gambar = $this->request->getFile('gambar');
        $in = $this->InventarisModel->find($nomor);

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

        $this->InventarisModel->save([
            'nomor' => $nomor,
            'gambar' => $nama_gambar,
            'id_inventaris' => $this->request->getVar('id_inventaris'),
            'nama_aset' => $this->request->getVar('nama_aset'),
            'jumlah_kapasitas' => $this->request->getVar('jumlah_kapasitas'),
            'status_kondisi' => $this->request->getVar('status_kondisi')
        ]);

        session()->setFlashdata('Pesan', ' Data aset berhasil diedit.');
        return redirect()->to('/pages/admin');
    }


    public function delete($nomor)
    {
        // cari gambar berdasarkan nomor
        $inventaris = $this->InventarisModel->find($nomor);

        // cek jika gambar default atau tidak
        if ($inventaris['gambar'] != 'SD-default-image.png') {
            // hapus file fisik gambar
            unlink('img/' . $inventaris['gambar']);
        }

        $this->InventarisModel->delete($nomor);
        session()->setFlashdata('Pesan', ' Data aset berhasil dihapus.');
        return redirect()->to('/pages/admin');

        // session()->setTempdata('Gagal', ' Data aset gagal dihapus.');
        // return redirect()->to('/pages/admin');
    }
}
