<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use App\Models\Menu;
use App\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        
        Gate::define('has_menu_access', function($user){
            $url = request()->route()->uri;
            /*
            $menus = Menu::where('url', $url)
                         ->whereHas('roles', function ($query) {
                             $query->where('role_id1', Auth::user()->role_id);
                         })
                         ->get();
            */
            //Alternatively             
            $menus = Role::find(Auth::user()->role_id)
                         ->menus()
                         ->active()
                         ->where('url', $url)
                         ->get();

            return ($menus->count() > 0) ? true : false;
        });

        //getMenu for menus
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $menus = Role::find(Auth::user()->role_id)
                            ->menus()
                            ->active()
                            ->where('link_rights', 0)
                            ->orderBy('order')
                            ->orderBy('id')
                            ->get();
                
                
                $refs = array();
                $list = array();
                if($menus->count() > 0){
                    foreach ($menus as $uf){
                        $thisref = &$refs[ $uf->id ];
                        $thisref['menu_item_id'] = $uf->id;
                        $thisref['menu_parent_id'] = $uf->parent_id;
                        $thisref['menu_item_name'] = $uf->name;
                        $thisref['url'] = $uf->url;
                        $thisref['icon'] = $uf->icon;
                        if ($uf ->parent_id == 0)
                            $list[ $uf ->id ] = &$thisref;
                        else
                            $refs[ $uf->parent_id ]['children'][ $uf->id ] = &$thisref;
                    }
                } 
                $view->with('menu', $list);
            }
        });

        //getCurrentMenuOperationRights
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $url = request()->route()->uri;
                /*$result = DB::table("menus as menu")
					->join("menus as menu1", "menu.id", "=", "menu1.parent_id")
					->join("role_menu as role", "menu1.id", "=", "role.menu_id")
					->selectRaw("menu1.key as menu_key, menu1.url")
					->whereRaw("role.role_id = '".Auth::user()->role_id."' AND menu.url = '".$url."'")
					->orderBy("menu1.id")
					->get();*/
                $result = Menu::where('url', $url)
                                ->first()
                                ->children()
                                ->selectRaw('`key` as menu_key, url')
                                ->whereHas('roles', function ($query) {
                                    $query->where('role_id', Auth::user()->role_id);
                                })
                                ->get();
                
                $actions = value_to_index($result, "menu_key");
                $view->with('actions', $actions);
            }
        });
    }
}
