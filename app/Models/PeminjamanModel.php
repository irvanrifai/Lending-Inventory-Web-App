<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';
    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = 'deleted_at';

    protected $allowedFields = ['nama_peminjam', 'email', 'no_hp', 'asal_instansi', 'alamat', 'nama_kegiatan', 'id_inventaris', 'tempat_pelaksanaan', 'wk_pelaksanaandr', 'wk_pelaksanaansp', 'wk_peminjamandr', 'wk_peminjamansp', 'st_ts'];

    public function getPeminjamanModel($id_peminjam = false)
    {
        if ($id_peminjam == false) {
            $this->orderBy('id_peminjam', 'DESC');
            // return $this->where(['created_at >=' => $mulai, 'created_at <=' => $selesai])->find();
            return $this->findAll();
        }
        $this->orderBy('id_peminjam', 'DESC');
        return $this->where(['id_peminjam' => $id_peminjam]);
    }

    public function aset_pinjam()
    {
        $builder = $this->db->table('peminjaman');
        return $builder->join('tb_aset', 'tb_aset.id_inventaris = peminjaman.id_inventaris');
    }

    public function filter_laporan($dari = null, $sampai = null)
    {
        // condition for filter by date
        if ($dari == null && $sampai == null) {
            return $this->aset_pinjam()->orderBy('peminjaman.created_at', 'DESC');
        } elseif ($dari == null && $sampai != null) {
            return $this->aset_pinjam()->where('peminjaman.created_at <=', $sampai)->orderBy('peminjaman.created_at', 'ASC');
        } elseif ($dari != null && $sampai == null) {
            return $this->aset_pinjam()->where('peminjaman.created_at >=', $dari)->orderBy('peminjaman.created_at', 'ASC');
        } elseif ($dari != null && $sampai != null) {
            return $this->aset_pinjam()->where('peminjaman.created_at >=', $dari)->where('peminjaman.created_at <=', $sampai)->orderBy('peminjaman.created_at', 'ASC');
        }
    }

    public function hitung($table)
    {
        return $this->countAll($table);
    }

    public function sering_nama($kepemilikan)
    {
        // query asli
        // SELECT tb_aset.nama_aset, COUNT(tb_aset.nama_aset) as jumlah FROM peminjaman join tb_aset ON peminjaman.id_inventaris=tb_aset.id_inventaris WHERE tb_aset.kepemilikan = 'BEM FKI UMS' GROUP BY tb_aset.nama_aset ORDER BY jumlah DESC");

        return $this->aset_pinjam()->where('tb_aset.kepemilikan', $kepemilikan)->groupBy('tb_aset.nama_aset')->orderBy('tb_aset.nama_aset', 'DESC')->get()->getFirstRow();
    }

    public function sering_jumlah($kepemilikan)
    {
        // query asli
        // SELECT tb_aset.nama_aset, COUNT(tb_aset.nama_aset) as jumlah FROM peminjaman join tb_aset ON peminjaman.id_inventaris=tb_aset.id_inventaris WHERE tb_aset.kepemilikan = 'BEM FKI UMS' GROUP BY tb_aset.nama_aset ORDER BY jumlah DESC

        return $this->aset_pinjam()->selectCount('tb_aset.nama_aset')->where('tb_aset.kepemilikan', $kepemilikan)->groupBy('tb_aset.nama_aset')->orderBy('tb_aset.nama_aset', 'DESC')->get()->getFirstRow();
    }
}
