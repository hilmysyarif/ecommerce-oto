<?php namespace App\Http\Controllers;

use Auth;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function account()
	{
		$data['name'] = "Account";
		$data['num_store'] = sizeof(\App\Kios::where('id_user',Auth::user()->id)->get());
		$data['num_product'] = sizeof(\App\Product::where('id_user',Auth::user()->id)->get());
		$data['data'] = \App\Kios::where('id_user',Auth::user()->id)->get();
		
		return view('account/home')->with($data);
	}

}
