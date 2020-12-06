<?php 

namespace App\Models;
use CodeIgniter\Model;

class ODetail extends Model
{
    protected $table = 'tblorderdetail';

    protected $allowedFields = ['idorder','idmenu','jumlah','hargajual'];

}



?>