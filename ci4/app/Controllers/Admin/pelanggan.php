<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Pelanggan_M;

class pelanggan extends BaseController
{
	public function index()
	{
        $pager = \Config\Services::pager();
		$model = new Pelanggan_M();
		

		$data = [
			'judul' => 'DATA PELANGGAN',
			'pelanggan'=>$model->paginate(3,'page'),
			'pager'=>$model->pager
		];

		
		echo view('pelanggan/select',$data);
	}

	public function delete($id=null)
	{
		$model = new Pelanggan_M();
		$model->delete($id);
		return redirect()->to(base_url("/admin/pelanggan"));
	}

	public function update($id=null,$isi=1)
	{
		$model = new Pelanggan_M();
		if ($isi==0) {
			$isi =1;
		} else {
			$isi = 0;
		}

		$data = [
			'aktif'=>$isi
		];
		$model -> update($id,$data);
		return redirect()->to(base_url("/admin/pelanggan"));
	}

	//--------------------------------------------------------------------

}
