<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\OrderDetail_M;
use App\Models\Kategori_M;
use App\Models\Menu_M;
use App\Models\Pelanggan_M;

class Homepage extends BaseController
{
	public function index()
	{
		$pager = \Config\Services::pager();
		$model = new Kategori_M();
		$model_menu = new Menu_M();

		$data = [
			'judul' => 'Menu',
			'kategori' => $model->findAll(),
			'menu' => $model_menu->paginate(3, 'page'),
			'pager' => $model_menu->pager,
			'cart'	=> $this->cart(),
		];

		return view('home/produk', $data);
	}

	public function read($id = null)
	{
		$pager = \Config\Services::pager();
		if (isset($id)) {

			$model_menu = new Menu_M();
			$model = new Kategori_M();
			$jumlah = $model_menu->where('idkategori', $id)->findAll();
			$count = count($jumlah);

			$tampil = 3;
			$mulai = 0;

			if (isset($_GET['page'])) {
				$page = $_GET['page'];
				$mulai = ($tampil * $page) - $tampil;
			}

			$menu = $model_menu->where('idkategori', $id)->findAll($tampil, $mulai);

			$data = [
				'judul' => 'DATA PENCARIAN MENU ',
				'menu' => $menu,
				'kategori' => $model->findAll(),
				'pager' => $pager,
				'tampil' => $tampil,
				'total' => $count,
				'cart'	=> $this->cart(),
				'id'	=> $id,
			];

			return view("home/cari", $data);
		}
	}

	public function create()
	{
		$model = new Kategori_M();
		$data = [
			'judul' => 'Registrasi Pelanggan ',
			'kategori' => $model->findAll(),
		];
		return view("home/daftar", $data);
	}

	public function daftar()
	{
		$request = \Config\Services::request();
		$data = [
			'pelanggan' => $request->getPost('nama'),
			'alamat' => $request->getPost('alamat'),
			'telp' => $request->getPost('telp'),
			'email' => $request->getPost('email'),
			'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
			'konfirmasi' => password_hash($request->getPost('konfirmasi'), PASSWORD_DEFAULT),
			'aktif' => 1
		];

		$model = new Pelanggan_M();
		if ($request->getPost('password') == $request->getPost('konfirmasi')) {
			if ($model->insert($data) === false) {
				$error = $model->errors();
				session()->setFlashdata('info', $error);
				return redirect()->to(base_url("/front/homepage/create"));
			} else {
				return redirect()->to(base_url("/login"));
			}
		} else {
			$error = ['Password' => 'Password Dan Konfirmasi harus sama'];
			session()->setFlashdata('info', $error);
			return redirect()->to(base_url("/front/homepage/create"));
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

	public function histori()
	{
		$model = new Kategori_M();
		$db = \Config\Database::connect();
		$builder = $db->table('vorder');
		$email = session()->get('email');
		$query = $builder->getWhere(['email' => $email]);
		$pager = \Config\Services::pager();
		$detail = $query->getResult('array');
		$count = count($detail);
		$tampil = 3;
		$mulai = 0;

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			$mulai = ($tampil * $page) - $tampil;
		}

		$query = $builder->getWhere(['email' => $email], $tampil, $mulai);
		$vorder = $query->getResult('array');

		$data = [
			'judul' => 'Histori Pembelian',
			'kategori' => $model->findAll(),
			'vorder' => $vorder,
			'pager' => $pager,
			'cart'	=> $this->cart(),
			'tampil' => $tampil,
			'total' => $count,
			'mulai' => $mulai,
		];
		return view("home/histori", $data);
	}

	public function detail($id)
	{
		$pager = \Config\Services::pager();
		$modelOD = new OrderDetail_M();
		$model = new Kategori_M();
		$jumlah = $modelOD->where('idorder', $id)->findAll();
		$count = count($jumlah);

		$tampil = 3;
		$mulai = 0;

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			$mulai = ($tampil * $page) - $tampil;
		}

		$Detail = $modelOD->where('idorder', $id)->findAll($tampil, $mulai);

		$data = [
			'judul' => 'Detail Pembelian ',
			'detail' => $Detail,
			'kategori' => $model->findAll(),
			'pager' => $pager,
			'tampil' => $tampil,
			'total' => $count,
			'cart'	=> $this->cart(),
			'mulai' => $mulai,
		];
		return view("home/detail", $data);
	}

	//--------------------------------------------------------------------

}
