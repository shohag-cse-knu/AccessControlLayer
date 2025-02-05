<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReportSummaryResource;
use App\Models\User;
use DB;
use Validator;
use Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        //
    }

    function case(Request $request){
        $GLOBALS['pageTitle'] = config('app.name')." : Case Report";
        $start_date = $end_date = "";
        $records = array();

        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
		        'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
		    ]);

		    if ($validator->fails()) {
	        	return redirect()
	                    ->back()
	                    ->withErrors($validator)
	                    ->withInput();
	    	}

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $records = User::with([
                                'role:id,name',
                                'createdBy:id,name',
                                'updatedBy:id,name',
                                'deletedBy:id,name',
                            ])
                            ->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date])
                            ->get();
        }

        $data = array(
                    'reportRecords' => $records,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
        return view('report.case', $data);
    }

    function summary(Request $request){
        $GLOBALS['pageTitle'] = config('app.name')." : Case Report";
        $start_date = $end_date = "";
        $records = array();

        if($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
		        'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
		    ]);

		    if ($validator->fails()) {
	        	return redirect()
	                    ->back()
	                    ->withErrors($validator)
	                    ->withInput();
	    	}
            $start_date = $request->start_date;
            $end_date = $request->end_date;

            $users = User::with('role')
                         ->whereBetween(DB::raw('DATE(created_at)'), [$start_date, $end_date])
                         ->get(); // Eager load roles and menus for all users

            /*$userMenuAccessCounts = $records->map(function ($user) {
                return [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'menu_count' => $user->role ? $user->role->menus->count() : 0,
                ];
            });*/

            $resource_collection = ReportSummaryResource::collection($users)->toArray($request);
            $records = $resource_collection; //response()->json($collection);
        }

        $data = array(
                    'reportRecords' => $records,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                );
        return view('report.summary', $data);
    }  
}