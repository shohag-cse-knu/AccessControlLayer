<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use DB;
use Validator;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Menu List";
        $object = new Menu();
        $data['userRecords'] = Menu::with(['parent'])
                                    ->orderBy('order')
                                    ->paginate(10);
        return view('menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Add New Menu";

        $menuListDropdown = Menu::active()
                                ->selectRaw('id, name, parent_id as parent')
                                ->orderBy('order', 'asc')
                                ->get();
        
        return view('menu.create', [
            'add_edit' => 'add',
            'menuListDropdown' => json_decode(json_encode($menuListDropdown), true)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $validatedData = $request->validated();
        
        Menu::create([
            'name' => $validatedData['name'], 
            'key' => $validatedData['key'], 
            'description' => $validatedData['description'],
            'url' => $validatedData['url'],
            'icon' => $request->icon, 
            'parent_id' => $validatedData['parent_id'],
            'active' => $validatedData['active'],
            'link_rights' => $validatedData['link_rights'],
            'created_at' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $GLOBALS['pageTitle'] = config('app.name')." : Edit Menu";
        $menuListDropdown = Menu::active()
                                ->selectRaw('id, name, parent_id as parent')
                                ->orderBy('order', 'asc')
                                ->get();
        $data = array(
                    'menuListDropdown' => json_decode(json_encode($menuListDropdown), true),
                    'menuInfo' => $menu
                );
        
        return view('menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validatedData = $request->validated();

        $menuInfo = array(
            'name' => $validatedData['name'], 
            'key' => $validatedData['key'], 
            'description' => $validatedData['description'],
            'url' => $validatedData['url'],
            'icon' => $request->icon, 
            'parent_id' => $validatedData['parent_id'],
            'active' => $validatedData['active'],
            'link_rights' => $validatedData['link_rights'],
            'updated_at' => now(),
            'updated_by' => Auth::id(),
        );

        $menu->update($menuInfo);
        return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
