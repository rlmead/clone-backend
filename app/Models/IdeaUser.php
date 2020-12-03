<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdeaUser extends Model
{
    protected $table = 'idea_user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'idea_id', 'user_id', 'user_role'
    ];

    protected $with = [
        'idea'
    ];

    public function idea()
    {
        return $this->belongsTo('App\Models\Idea', 'idea_id');
    }
}
