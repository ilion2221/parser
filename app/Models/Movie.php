<?php

namespace App\Models;

use App\Jobs\ParseFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $guarded = [];
    protected $fillable = ['imdp_title_id', 'title'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'App\Models\MovieGenre', 'movie_id', 'genre_id');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'App\Models\MovieCountry', 'movie_id', 'country_id');
    }

    public function actors()
    {
        return $this->hasMany(Actor::class, 'movie_id','id');
    }
    public function directors()
    {
        return $this->hasMany(Director::class, 'movie_id','id');
    }
    public function writers()
    {
        return $this->hasMany(Writer::class, 'movie_id','id');
    }
    public function decades()
    {
        return $this->hasOne(Decades::class, 'movie_id','id');
    }
    public function selectYear() {
        return $this->countries()->where('is_europe','=', true);
    }

}
