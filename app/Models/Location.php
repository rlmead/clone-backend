<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    protected $table = 'locations';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'postal_code', 'city', 'state', 'country_code', 'meta'
    ];

    public function ideas() {
        return $this->hasMany('App\Models\Idea')->where('status', 'open')->orderBy('ideas.updated_at', 'desc')->select('id', 'name', 'image_url');
    }

}
