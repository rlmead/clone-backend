<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'image_url', 'ref_location_id', 'pronouns', 'bio'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function ideas()
    {
        return $this->belongsToMany('App\Models\Idea');
    }

    public function creations()
    {
        return $this->hasMany('App\Models\IdeaUser')->where('user_role', 'creator')->join('ideas', 'ideas.id', '=', 'idea_user.idea_id')->orderBy('ideas.status', 'desc')->orderBy('ideas.updated_at', 'desc');
    }

    public function collaborations()
    {
        return $this->hasMany('App\Models\IdeaUser')->where('user_role', 'collaborator')->join('ideas', 'ideas.id', '=', 'idea_user.idea_id')->orderBy('ideas.status', 'desc')->orderBy('ideas.updated_at', 'desc');
    }

    public function findForPassport($username)
    {
        return $user = (new User)->where('email', $username)->orWhere('username', $username)->first();
    }
}
