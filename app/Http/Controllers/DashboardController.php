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
use Illuminate\Support\Facades\Redis;
use App\Jobs\SendEmailJob;

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

		//Redis::set('key', 'Hello from Laravel');
		//$value = Redis::get('key');
		//echo $value;

		// Dispatch the job to the queue
        SendEmailJob::dispatch("syfur.srs@gmail.com");
		
		return view('dashboard', $data);
	}
}
