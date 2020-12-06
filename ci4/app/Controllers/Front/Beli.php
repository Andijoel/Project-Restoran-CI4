<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\OrderDetail_M;
use App\Models\Kategori_M;
use App\Models\Menu_M;
use App\Models\ODetail;


class Beli extends BaseController
{
    public function index($id = null)
    {
        $model = new Kategori_M();
        $model_M = new Menu_M();
        $total = 0;

        if (isset($id)) {
            $this->isi($id);
            return redirect()->to(base_url('/front/Beli'));
        } else {

            foreach (session()->get() as $key => $value) {
                if ($key <> '__ci_last_regenerate' && $key <> '_ci_previous_url' && $key <> 'pelanggan' && $key <> 'email' && $key <> 'idpelanggan' && $key <> 'logIn') {
                    $id = substr($key, 1);
                    $menu[] = $model_M->where('idmenu', $id)->findAll();
                    $jml[] = $value;
                }
            }

            if (!isset($menu)) {
                $menu = [];
                $jml = [];
            }

            $data = [
                'judul' => 'Keranjang Belanja',
                'kategori' => $model->findAll(),
                'menu' => $menu,
                'jml' => $jml,
                'total' => $total,
                'cart'	=>$this->cart(),
            ];
            return view('home/beli', $data);
        }
    }

    public function isi($id)
    {

        if (session()->has('_' . $id)) {
            session()->set('_' . $id, session()->get('_' . $id) + 1);
        } else {
            session()->set('_' . $id, 1);
        }
    }

    public function delete($id = null)
    {
        $idm = '_' . $id;
        session()->remove($idm);
        return redirect()->to(base_url('/front/Beli'));
    }

    public function tambah($id = null)
    {
        session()->set('_' . $id, session()->get('_' . $id) + 1);
        return redirect()->to(base_url('/front/Beli'));
    }

    public function kurang($id = null)
    {
        $idm = '_' . $id;
        session()->set($idm, session()->get($idm) - 1);
        if (session()->get($idm) == 0) {
            session()->remove($idm);
        }
        return redirect()->to(base_url('/front/Beli'));
    }

    public function checkout($total = null)
    {
        $db = \Config\Database::connect();
        if (isset($total)) {
            $idorder = $this->idorder();
            $idpelanggan = session()->get('idpelanggan');
            $tgl = date('Y-m-d');
            $sql = "SELECT * FROM tblorder WHERE idorder=$idorder";
            $result = $db->query($sql);
            $detail = $result->getResult('array');
            $count = count($detail);
            if ($count == 0) {
                $this->insertOrder($idorder, $idpelanggan, $tgl, $total);
                $this->insertDetail($idorder);
            } else {
                $this->insertDetail($idorder);
            }
            $this->kosongkanSession();
            return redirect()->to(base_url('/front/Beli/checkout/'));
        } else {
            $id=$this->idorder()-1;
            $model = new Kategori_M();
            $model_OD = new OrderDetail_M();
            $data = [
                'judul' => 'Terimakasih Telah Berbelanja',
                'kategori' => $model->findAll(),
                'order' => $model_OD->where('idorder', $id)->findAll(),
                'id' => $id,
                'cart'	=>$this->cart(),
            ];
            return view('home/info', $data);
        }
    }

    public function idorder()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT idorder FROM tblorder ORDER BY idorder DESC";
        $result = $db->query($sql);
        $detail = $result->getResult('array');
        $jumlah = count($detail);
        if ($jumlah == 0) {
            $id = 1;
        } else {
            $id = $jumlah + 1;
        }
        return $id;
    }

    public function insertOrder($idorder, $idpelanggan, $tgl, $total)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO tblorder VALUES ($idorder,$idpelanggan,'$tgl',$total,0,0,0)";
        $db->query($sql);
    }

    public function insertDetail($idorder)
    {
        $model = new Menu_M();
        $model_O = new ODetail();
        foreach (session()->get() as $key => $value) {
            if ($key <> '__ci_last_regenerate' && $key <> '_ci_previous_url' && $key <> 'pelanggan' && $key <> 'email' && $key <> 'idpelanggan' && $key <> 'logIn') {
                $id = substr($key, 1);
                $row = $model->where('idmenu', $id)->findAll();
                foreach ($row as $r) {
                    $idmenu = $r['idmenu'];
                    $harga = $r['harga'];
                    $data = [
                        'idorder' => $idorder,
                        'idmenu' => $idmenu,
                        'jumlah' => $value,
                        'hargajual' => $harga,
                        'cart'	=>$this->cart(),
                    ];
                    $model_O->insert($data);
                }
            }
        }
    }

    public function kosongkanSession()
    {
        foreach (session()->get() as $key => $value) {
            if ($key <> '__ci_last_regenerate' && $key <> '_ci_previous_url' && $key <> 'pelanggan' && $key <> 'email' && $key <> 'idpelanggan' && $key <> 'logIn') {
                $id = substr($key, 1);
                session()->remove('_' . $id);
            }
        }
    }

    public function cart()
	{
		$model_menu = new Menu_M();
		$cart = 0;
		foreach (session()->get() as $key => $value) {
			if ($key <> '__ci_last_regenerate' && $key <> '_ci_previous_url' && $key <> 'pelanggan' && $key <> 'email' && $key <> 'idpelanggan' && $key <> 'logIn') {
				$id = substr($key, 1);
				$jumlah = $model_menu->where('idmenu', $id)->findAll();
				foreach ($jumlah as $r) {
					$cart++;
				}
			}
        }
        return $cart;
	}

    //--------------------------------------------------------------------

}
