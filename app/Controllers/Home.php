<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$data['title'] = 'Home';

		echo view('Home', $data);
	}

	//--------------------------------------------------------------------

}
