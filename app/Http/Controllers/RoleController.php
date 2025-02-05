<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Menu;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleMenuInfoResource;

use DB;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Show Roles";
        $roles = Role::with(['createdBy', 'updatedBy', 'deletedBy'])->paginate(10);
        //$rr = RoleResource::collection($role)->response()->getData(true);
        return view('role.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Add New Role";
        $data = array();
        return view('role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validatedData = $request->validated();

        $role = new Role();
        $role->name = $validatedData['name'];
        $role->description = $validatedData['description'];
        $role->active = $validatedData['active'];
        $role->created_at = now(); // Laravel's helper function for the current timestamp
        $role->created_by = Auth::id();
        $role->save();
        
        $menus = $validatedData['chk']; // Assume $request->chk contains the menu IDs to attach
        $role->menus()->attach($menus);

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Edit Role";
        
        //Menu info of this role
        $roleMenuInfo = $role->menus()
                             ->pluck('menus.id')
                             ->all();
        //Alternatively we can use the below code
        /*
        $userMenuRolePerm = $role->menus->map(function ($menu) {
            return [
                'menu_id' => $menu->id,
                'menu_name' => $menu->name,
            ];
        });
        */
        $data = array(
            'roleInfo' => $role,
            'roleMenuInfo' => $roleMenuInfo
        );

        return view('role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validatedData = $request->validated();
        //$chk = $request->chk;
        $roleInfo = array(
                        'name'          => $validatedData['name'],
                        'description'   => $validatedData['description'],
                        'active'        => $validatedData['active'],
                        'updated_at'   => now(),
                        'updated_by'     => Auth::User()->id
                    );

        $role->update($roleInfo);
            
        $role->menus()->detach(); //DB::table("role_menu")->where('role_id', $role->id)->delete();
        $menus = $validatedData['chk']; // Assume $chk contains the menu IDs to attach
        $role->menus()->attach($menus);
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
