<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Role;

class ApiRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::select('id','name','description')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = json_decode($request->data, true);
        $table_name = $request->table_name;
        $affectedUuids = []; // Array to store affected UUIDs

        // Remove empty keys from each object
        $data = array_map(function ($item) {
        // Replace empty string values with null
        array_walk($item, function (&$value) {
            if ($value === '') {
                $value = null;
            }
        });
            
            // Remove 'id' key if it exists
            unset($item['id']);
            return $item;
           // return array_filter($item, function ($value) {
              //  return $value !== null; // Keep only non-empty values
           // });
        }, $data);

        try {
            foreach ($data as $row) {
                $query = DB::table($table_name)
                    ->where('uuid', $row['uuid'])
                    ->first();

                if ($query) {
                    //$row['present_upazilla_combined_code'] = $row['present_division'].$row['present_district'].$row['present_upazilla'];
                    //$row['permanent_upazilla_combined_code'] = $row['permanent_division'].$row['permanent_district'].$row['permanent_upazilla'];
                    $row['updated_at'] = now();
                    $row['updated_by'] = Auth::id();
                    $affectedRows = DB::table($table_name)
                                      ->where('uuid', $row['uuid'])
                                      ->update($row);

                    if ($affectedRows > 0) {
                        $affectedUuids[] = $row['uuid']; // Store the UUID if update affected rows
                    }
                } else {
                    //$row['present_upazilla_combined_code'] = $row['present_division'].$row['present_district'].$row['present_upazilla'];
                    //$row['permanent_upazilla_combined_code'] = $row['permanent_division'].$row['permanent_district'].$row['permanent_upazilla'];
                    $row['created_at'] = now();
                    $inserted = DB::table($table_name)->insert($row);

                    if ($inserted) {
                        $affectedUuids[] = $row['uuid']; // Store the UUID for successful insert
                    }
                }
            }

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Data processed successfully.',
                'affected_uuids' => $affectedUuids,
            ], 200); // HTTP status 200 for success

        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing the data.',
                'error' => $e->getMessage(),
            ], 500); // HTTP status 500 for server error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json([
            'role'=>$role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
