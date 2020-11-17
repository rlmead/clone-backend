<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkouts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    // protected $with = ['book', 'user'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'ref_book_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ref_user_id', 'id');
    }

}
