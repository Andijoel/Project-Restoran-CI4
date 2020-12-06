<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
// use App\Models\Kategori_M;

class order extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM vorder";

        $result = $db->query($sql);

        $row = $result->getResult('array');

        $total = count($row);
        $tampil = 3;

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $mulai = ($tampil * $page) - $tampil;
            $sql = "SELECT * FROM vorder ORDER BY status ASC LIMIT $mulai,$tampil";
        } else {
            $sql = "SELECT * FROM vorder ORDER BY status ASC LIMIT 0,$tampil";
        }

        $result = $db->query($sql);

        $row = $result->getResult('array');
        $data = [
            'judul' => 'Data Order',
            'order' => $row,
            'pager' => $pager,
            'tampil' => $tampil,
            'total' => $total,
        ];

        echo view('order/select', $data);
    }

    public function find($id = null)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM vorder WHERE idorder=$id";

        $result = $db->query($sql);

        $row = $result->getResult('array');

        echo "<hr>";

        $sql = "SELECT * FROM vorderdetail WHERE idorder=$id";
        $result = $db->query($sql);
        $detail = $result->getResult('array');

        $data = [
            'judul' => 'PEMBAYARAN PELANGGAN',
            'order' => $row,
            'detail' => $detail
        ];

        echo view('order/update', $data);
    }

    public function update()
    {
        if (isset($_POST['bayar'])) {

            $idorder = $_POST['idorder'];
            $total = $_POST['total'];
            $bayar = $_POST['bayar'];


            if ($bayar < $total) {
                session()->setFlashdata('info', 'Pembayaran Kurang !');
                $this->find($idorder);
            } else {
                $kembali = $bayar - $total;
                $sql = "UPDATE tblorder SET bayar=$bayar, kembali=$kembali, status=1 WHERE idorder=$idorder";
                $db = \Config\Database::connect();
                $db->query($sql);
                return redirect()->to(base_url("/admin/order"));
            }
        }
    }

    //--------------------------------------------------------------------

}
