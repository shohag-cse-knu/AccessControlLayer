<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\HasFactory;
use DB;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    //use HasFactory;
    protected $fillable = [
        'name', 
        'description', 
    ];
    // Define the relationship with User
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Define the many-to-many relationship with Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu');
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
}