<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use App\Models\adminModel\asetModel;
use PHPMailer\PHPMailer\PHPMailer as PHPMailerPHPMailer;
use TCPDF;
use \phpmailer\phpmailer\PHPmailer;
use \phpmailer\phpmailer\Exception;
use \phpmailer\phpmailer\src\SMTP;

class peminjaman extends BaseController
{
    protected $PeminjamanModel;
    protected $asetModel;

    public function __construct()
    {
        $this->PeminjamanModel = new PeminjamanModel();
        $this->asetModel = new asetModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        // $this->email = \Config\Services::email();
        $cb_nb = 1;
        $data = [
            'title' => 'Peminjaman | SPOKI UMS',
            'pinjam' => $this->PeminjamanModel->findAll(),
            's_aset' => $this->asetModel,
            'aset' => $this->asetModel->where('cb_nb', $cb_nb)->orderBy('nomor', 'DESC')->find(),
            'aset_s' => $this->PeminjamanModel->aset_pinjam()
        ];
        // dd($data['aset_s']);
        // dd($this->kirim_email());
        // $this->kirim_email();
        // $emeil = $this->email();
        // dd($this->sendEmail());
        // dd($this->filePdf());
        // dd($emeil);
        return view('pages/pinjam', $data);
    }

    public function save()
    {
        //validasi read the manual book CI 4
        if (!$this->validate([
            'nama_peminjam' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama peminjam tidak boleh kosong.',
                    'max_length' => 'Nama peminjam terlalu panjang (100 Char)'
                ]
            ],
            'email' => [
                'rules' => 'required|max_length[40]|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong..',
                    'max_length' => 'Email melebihi ukuran maksimal (40 Char)',
                    'valid_email' => 'Harap isi dengan email yang valid'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|min_length[8]|max_length[14]|greater_than[0]',
                'errors' => [
                    'required' => 'Nomor Hp tidak boleh kosong.',
                    'min_length' => 'Nomor Hp terlalu pendek (10-14 Char)',
                    'max_length' => 'Nomor Hp terlalu panjang (10-14 Char)',
                    'greater_than' => 'Nomor Hp tidak valid'
                ]
            ],
            'asal_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Asal instansi tidak boleh kosong..'
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[200]',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong..',
                    'max_length' => 'Alamat terlalu panjang (200 Char)'
                ]
            ],
            'nama_kegiatan' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama kegiatan tidak boleh kosong..',
                    'max_length' => 'Nama kegiatan terlalu panjang (100 Char)'
                ]
            ],
            'tempat_pelaksanaan' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Tempat pelaksanaan tidak boleh kosong..',
                    'max_length' => 'Tempat pelaksanaan terlalu panjang (100 Char)'
                ]
            ],
            'wk_pelaksanaandr' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Waktu pelaksanaan tidak boleh kosong',
                    'valid_date' => 'Waktu pelaksanaan tidak valid'
                ]
            ],
            'wk_pelaksanaansp' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Waktu pelaksanaan tidak boleh kosong',
                    'valid_date' => 'Waktu pelaksanaan tidak valid'
                ]
            ],
            'id_inventaris' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Inventaris tidak boleh kosong..'
                ]
            ],
            'wk_peminjamandr' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Waktu peminjaman tidak boleh kosong',
                    'valid_date' => 'Waktu peminjaman tidak valid'
                ]
            ],
            'wk_peminjamansp' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Waktu peminjaman tidak boleh kosong',
                    'valid_date' => 'Waktu peminjaman tidak valid'
                ]
            ]
        ])) {
            session()->setFlashdata('Gagal', ' Formulir ajuan peminjaman gagal diproses.');
            return redirect()->to('/pages/pinjam')->withInput();
        };

        $this->PeminjamanModel->save([
            'nama_peminjam' => $this->request->getVar('nama_peminjam'),
            'email' => $this->request->getVar('email'),
            'no_hp' => $this->request->getVar('no_hp'),
            'asal_instansi' => $this->request->getVar('asal_instansi'),
            'alamat' => $this->request->getVar('alamat'),
            'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
            'tempat_pelaksanaan' => $this->request->getVar('tempat_pelaksanaan'),
            'wk_pelaksanaandr' => $this->request->getVar('wk_pelaksanaandr'),
            'wk_pelaksanaansp' => $this->request->getVar('wk_pelaksanaansp'),
            'id_inventaris' => $this->request->getVar('id_inventaris'),
            'wk_peminjamandr' => $this->request->getVar('wk_peminjamandr'),
            'wk_peminjamansp' => $this->request->getVar('wk_peminjamansp'),
        ]);

        // for optional 1 if inputed
        $inv2 = $this->request->getVar('id_inventaris2');
        $wpdr2 = $this->request->getVar('wk_peminjamandr2');
        $wpsp2 = $this->request->getVar('wk_peminjamansp2');
        if ($inv2 != null && $wpdr2 != null && $wpsp2 != null) {
            $this->PeminjamanModel->save([
                'nama_peminjam' => $this->request->getVar('nama_peminjam'),
                'email' => $this->request->getVar('email'),
                'no_hp' => $this->request->getVar('no_hp'),
                'asal_instansi' => $this->request->getVar('asal_instansi'),
                'alamat' => $this->request->getVar('alamat'),
                'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
                'tempat_pelaksanaan' => $this->request->getVar('tempat_pelaksanaan'),
                'wk_pelaksanaandr' => $this->request->getVar('wk_pelaksanaandr'),
                'wk_pelaksanaansp' => $this->request->getVar('wk_pelaksanaansp'),
                'id_inventaris' => $this->request->getVar('id_inventaris2'),
                'wk_peminjamandr' => $this->request->getVar('wk_peminjamandr2'),
                'wk_peminjamansp' => $this->request->getVar('wk_peminjamansp2'),
            ]);
        }

        // for optional 2 if inputed
        $inv3 = $this->request->getVar('id_inventaris3');
        $wpdr3 = $this->request->getVar('wk_peminjamandr3');
        $wpsp3 = $this->request->getVar('wk_peminjamansp3');
        if ($inv3 != null && $wpdr3 != null && $wpsp3 != null) {
            $this->PeminjamanModel->save([
                'nama_peminjam' => $this->request->getVar('nama_peminjam'),
                'email' => $this->request->getVar('email'),
                'no_hp' => $this->request->getVar('no_hp'),
                'asal_instansi' => $this->request->getVar('asal_instansi'),
                'alamat' => $this->request->getVar('alamat'),
                'nama_kegiatan' => $this->request->getVar('nama_kegiatan'),
                'tempat_pelaksanaan' => $this->request->getVar('tempat_pelaksanaan'),
                'wk_pelaksanaandr' => $this->request->getVar('wk_pelaksanaandr'),
                'wk_pelaksanaansp' => $this->request->getVar('wk_pelaksanaansp'),
                'id_inventaris' => $this->request->getVar('id_inventaris3'),
                'wk_peminjamandr' => $this->request->getVar('wk_peminjamandr3'),
                'wk_peminjamansp' => $this->request->getVar('wk_peminjamansp3'),
            ]);
        }

        $this->sendEmail();
        session()->setFlashdata('Pesan', ' Formulir ajuan peminjaman berhasil diproses.');
        return redirect()->to('/pages/pinjam');
    }

    public function create()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('/pages/pinjam', $data);
    }

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
        // dd($scope_cetak);
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


    // email bawaan CI
    public function sendEmail()
    {
        $email = \Config\Services::email();

        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'smtp.gmail.com';
        $config['SMTPUser'] = 'spokiums@gmail.com';
        $config['SMTPPass'] = 'spokiums2007';
        $config['SMTPPort'] = 578;

        $email->initialize($config);

        $email->setFrom('spokiums@gmail.com', 'SPOKI UMS 2022 Email System');
        $email->setTo('ivan.rivai6921@gmail.com');
        $email->setSubject('Informasi Peminjaman Aset Ormawa FKI');
        $email->setMessage('Halo, berikut kami sampaikan informasi dan file dari ajuan peminjaman yang kamu ajukan');

        if (!$email->send()) {
            echo $email->printDebugger();
            return false;
        } else {
            echo "email sent succesfully";
            return true;
        }

        // $email_to = $this->request->getVar('email');
        // $nama_peminjam = $this->request->getVar('nama_peminjam');

        // // $email->initialize($config);
        // // $this->email->setNewline("\r\n");
        // $this->email->setFrom('spokiums@gmail.com', 'SPOKI UMS 2022 Email System');
        // // $this->email->setTo($email_to, 'spokiums@gmail.com');
        // $this->email->setTo('spokiums@gmail.com');
        // // $this->email->attach();
        // // $this->email->setCC('ivan.rivai6921@gmail.com');
        // // $this->email->setBCC('l200180214@student.ums.ac.id');
        // $this->email->setSubject('Informasi Peminjaman Aset Ormawa FKI');
        // // $this->email->setMessage('Halo' . $nama_peminjam . ', berikut kami sampaikan informasi dan file dari ajuan peminjaman yang kamu ajukan');
        // $this->email->setMessage('Halo, berikut kami sampaikan informasi dan file dari ajuan peminjaman yang kamu ajukan');

        // // $this->email->send();
        // if (!$this->email->send()) {
        //     echo $this->email->printDebugger();
        //     return false;
        // } else {
        //     echo "email sent succesfully";
        //     return true;
        // }
    }

    // php mailer
    public function kirim_email()
    {
        $mail = new PHPMailerPHPMailer;
        // $mail = new Exception;
        // $mail = new SMTP;

        $mail->isSMTP();
        $mail->Host = 'spokiums@gmail.com';
        $mail->SMTPAuth = true;

        $mail->setFrom('spokiums@gmail.com', 'Darth Vader');
        $mail->addAddress('ivan.rivai6921@gmail.com', 'Emperor');
        $mail->Subject = 'Force';
        $mail->Body = 'There is a great disturbance in the Force.';

        if (!$mail->send()) {
            echo $mail->ErrorInfo;
            // return false;
        } else {
            return true;
        }
    }
}
