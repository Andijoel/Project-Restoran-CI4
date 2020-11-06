<?php namespace App\Controllers;

class Menu extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function select(){
		echo "<h1>untuk menampilkan data</h1>";
	}

	public function update($id=null,$nama=null){
		echo "<h1>untuk update data dengan id : $id   $nama</h1>";
	}

	//--------------------------------------------------------------------

}
