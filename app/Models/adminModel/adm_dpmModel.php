<?php

namespace App\Models\adminModel;

use CodeIgniter\Model;

class adm_dpmModel extends Model
{
    protected $table = 'tb_dpm';
    protected $primaryKey = 'nomor';
    protected $useTimestamps = true;
    protected $deletedField = true;

    protected $allowedFields = ['gambar', 'id_inventaris', 'nama_aset', 'jumlah_kapasitas', 'status', 'kondisi'];

    public function getadm_dpm($nomor = false)
    {
        if ($nomor == false) {
            $this->orderBy('nomor', 'DESC');
            return $this->findAll();
        }
        $this->orderBy('nomor', 'DESC');
        return $this->where(['nomor' => $nomor]);
    }
}
