<?php 

namespace App\Models;
use CodeIgniter\Model;

class Menu_M extends Model
{
    protected $table = 'tblmenu';

    protected $primaryKey = 'idmenu';

    protected $allowedFields = ['idkategori','menu','gambar','harga'];

    protected $validationRules =[
        'menu'=> 'alpha_numeric_space|min_length[3]|is_unique[tblmenu.menu]',
        'harga'=> 'numeric'
    ];

    protected $validationMessages =[
        'menu'        =>[
            'alpha_numeric_space'=>'Tidak boleh menggunakan simbol',
            'min_length'=>'Minimal 3 huruf',
            'is_unique'=>'Ada data yang sama'
        ],

        'harga'        =>[
            'numeric'=>'Harus Angka',
        ]
    ];
}



?>