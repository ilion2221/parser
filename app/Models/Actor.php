<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $table ='actors';
    protected $fillable = ['movie_id', 'artist_name'];
    public function casts() {
        return $this->belongsTo(Cast::class, 'name','actor_name');
    }
}
