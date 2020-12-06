<?php 

namespace App\Models;

use App\Controllers\Admin\pelanggan;
use CodeIgniter\Model;

class Pelanggan_M extends Model
{
    protected $table = 'tblpelanggan';

    protected $primaryKey = 'idpelanggan';

    protected $allowedFields = ['aktif','pelanggan','alamat','telp','email','password'];

    protected $validationRules =[
        'email'=> 'valid_email|is_unique[tblpelanggan.email]',
        'telp'=> 'numeric|min_length[9]',
    ];

    protected $validationMessages =[
        'email'        =>[
        'valid_email'=>'Email Salah !',
        'is_unique'=>'Ada email yang sama'
    ],

    'telp'        =>[
        'numeric'=>'Harus Angka',
        'min_length'=>'Minimal 9 Angka',
    ]
    ];


}



?>