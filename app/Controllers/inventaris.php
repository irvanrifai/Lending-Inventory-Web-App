<?php

namespace App\Controllers;

use App\Models\InventarisModel;
use App\Models\adminModel\asetModel;
use App\Models\PeminjamanModel;

class inventaris extends BaseController
{
    protected $asetModel;
    protected $PeminjamanModel;

    public function __construct()
    {
        $this->asetModel = new asetModel();
        $this->PeminjamanModel = new PeminjamanModel();
    }
    public function index()
    {
        $cb_nb = 1;
        // $nama_inv = $this->asetModel->aset_pinjam()->where('cb_nb', $cb_nb)->orderBy('tb_aset.nomor', 'DESC')->distinct()->get()->getResultArray();
        $data = [
            'title' => 'Inventaris | SPOKI UMS',
            'aset' => $this->asetModel->aset_pinjam()->where('cb_nb', $cb_nb)->groupBy('tb_aset.nomor')->orderBy('tb_aset.nomor', 'DESC')->distinct()->get()->getResultArray(),
            'jadwal' => $this->PeminjamanModel->aset_pinjam()->where('cb_nb', $cb_nb)->where('st_ts', $cb_nb)->orderBy('peminjaman.created_at', 'DESC')->get()->getResultArray(),
        ];
        // dd($data['aset']);
        return view('pages/inventaris', $data);
    }

    public function detail($nama_aset)
    {
        $cb_nb = 1;
        $data = [
            'aset' => $this->asetModel->aset_pinjam()->where('cb_nb', $cb_nb)->orderBy('nomor', 'DESC')->distinct()->get()->getResultArray(),
        ];

        if (empty($data['aset'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data aset ' . $nama_aset . ' tidak ditemukan');
        }
        return view('pages/inventaris', $data);
    }
}
