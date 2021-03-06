<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'parent_id', 'idea_id', 'user_id', 'text'
    ];

    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
