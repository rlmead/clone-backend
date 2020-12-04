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

    public function locations()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

}
