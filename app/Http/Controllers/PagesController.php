<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    

	public function index()
	{
		return view("home");
	}



	public function shifts() {
		return view("shifts");
	}

	public function test()
	{
		return view("test");
	}

}
