<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminPage extends BaseController
{
	public function index()
	{
		return view('template/admin');
	}

	//--------------------------------------------------------------------

}
