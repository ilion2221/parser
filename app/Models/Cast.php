<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $table = 'casts';

    protected $fillable = ['imdb_name_id, name, height, bio, data_of_birth, place_of_birth , children'];

    public function actors() {

        return $this->belongsToMany(Actor::class, 'actor_name','name');

    }
    public function writers() {

        return $this->belongsToMany(Writer::class, 'writer_name','name');

    }
    public function directors() {

        return $this->hasMany(Writer::class, 'director_name','name');

    }

}
