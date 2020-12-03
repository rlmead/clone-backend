<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    
    protected $table = 'ideas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name', 'status', 'image_url', 'ref_location_id', 'description'
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    // public function creators() {
    //     return $this->hasMany('App\Models\IdeaUser')->where('user_role', 'creator');
    // }

    // public function collaborators() {
    //     return $this->hasMany('App\Models\IdeaUser')->where('user_role', 'collaborator');
    // }

    // public function requests() {
    //     return $this->hasMany('App\Models\IdeaUser')->where('user_role', 'request');
    // }

    // public function noncreators() {
    //     return $this->hasMany('App\Models\IdeaUser')->where('user_role', '!=', 'creator');
    // }

}
