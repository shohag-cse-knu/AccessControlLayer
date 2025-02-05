<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    //use HasFactory;
    
    // Add attributes that can be mass assigned
    protected $fillable = [
        'name', 
        'key', 
        'description', 
        'url', 
        'icon', 
        'parent_id', 
        'active', 
        'link_rights', 
    ];

    // Define the many-to-many relationship with Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu'); //Pivot Table role_menu
    }

    /**
     * Relationship: A menu has many child menus.
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    /**
     * Relationship: A menu belongs to a parent menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy(){
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
