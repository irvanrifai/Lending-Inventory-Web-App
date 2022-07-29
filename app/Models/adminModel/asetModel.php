<?php

namespace App\Models\adminModel;

use CodeIgniter\Model;

class asetModel extends Model
{
    protected $table = 'tb_aset';
    protected $primaryKey = 'nomor';
    protected $useTimestamps = true;
    protected $deletedField = true;

    protected $allowedFields = ['gambar', 'id_inventaris', 'kepemilikan', 'nama_aset', 'jumlah_kapasitas', 'status', 'kondisi', 'cb_nb'];

    public function getaset($nomor = false)
    {
        if ($nomor == false) {
            $this->orderBy('nomor', 'DESC');
            return $this->findAll();
        }
        $this->orderBy('nomor', 'DESC');
        return $this->where(['nomor' => $nomor]);
    }

    public function aset_pinjam()
    {
        $builder = $this->db->table('tb_aset');
        return $builder->join('peminjaman', 'peminjaman.id_inventaris = tb_aset.id_inventaris', 'left')->groupBy('tb_aset.id_inventaris')->orderBy('id_peminjam', 'DESC');
    }

    public function aset_only()
    {
        $builder = $this->db->table('tb_aset');
        return $builder->join('peminjaman', 'peminjaman.id_inventaris = tb_aset.id_inventaris', 'right')->groupBy('tb_aset.id_inventaris');
    }


    public function filter_laporan($dari = null, $sampai = null)
    {
        // condition for filter by date
        if ($dari == null && $sampai == null) {
            return $this->orderBy('created_at', 'DESC');
        } elseif ($dari == null && $sampai != null) {
            return $this->where('created_at <=', $sampai)->orderBy('created_at', 'ASC');
        } elseif ($dari != null && $sampai == null) {
            return $this->where('created_at >=', $dari)->orderBy('created_at', 'ASC');
        } elseif ($dari != null && $sampai != null) {
            return $this->where('created_at >=', $dari)->where('created_at <=', $sampai)->orderBy('created_at', 'ASC');
        }
    }

    public function hitung($table)
    {
        return $this->countAll($table);
    }

    public function tambah($table, $field)
    {
        $this->selectSum($field);
        return $this->get($table)->row_array()[$field];
    }
}
