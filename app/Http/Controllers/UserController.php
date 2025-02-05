<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserData;
use App\Models\Menu;
use App\Models\Role;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;

use Auth;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
	{
		//$this->middleware('auth');
		//$this->middleware('can:has_menu_access');
	}

    function index()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : User Listing";
        $users = User::with(['role', 'createdBy', 'updatedBy', 'deletedBy'])
                     ->paginate(10);
        //$rr = UserResource::collection($users)->response()->getData(true);
        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Add New User";

        $data = array(
            'roles' => Role::where('id', '!=', 1)->get() // Except Super Admin
        );

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // The validated data will be automatically available
        $validatedData = $request->validated();

        $user = new User();
        $user->name = ucwords(strtolower($validatedData['name']));
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']); // Hash the password
        $user->role_id = $validatedData['role_id'];
        $user->mobile = $validatedData['mobile'];
        $user->username = $validatedData['username'];
        $user->designation = $request->designation;
        $user->created_at = now();
        $user->created_by = Auth::id(); // Auth::user()->id simplified
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Add New User";

        $data = array(
            'roles' => Role::where('id', '!=', 1)->get(), // Except Super Admin
            'userInfo' => $user
        );

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // The validated data will be automatically available
        $validatedData = $request->validated();
            
        $userInfo = array(
            'name' => ucwords(strtolower($validatedData['name'])),
            'username' => $validatedData['username'], 
            'email' => $validatedData['email'], 
            'role_id' => $validatedData['role_id'],
            'mobile' => $validatedData['mobile'],
            'designation' => $request->designation, 
            'updated_at' => now(),
            'updated_by' => Auth::id()
        );

        if ($request->filled('password')) 
            $userInfo['password'] = bcrypt($validatedData['password']);

        //dd($userInfo);
        $bool = $user->update($userInfo);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}