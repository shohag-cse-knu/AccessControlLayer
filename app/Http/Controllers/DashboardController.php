<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Menu;
use App\Http\Middleware;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function __construct()
	{
		//$this->middleware('auth');
		//$this->middleware('can:has_menu_access');
	}

    function index()
	{
		$GLOBALS['pageTitle'] = config('app.name')." : Dashboard";
		$data = array();
		return view('dashboard', $data);
	}
}
