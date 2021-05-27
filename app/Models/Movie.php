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
    public function decades()
    {
        return $this->hasOne(Decades::class, 'movie_id','id');
    }
    public function selectYear() {
        return $this->countries()->where('is_europe','=', true);
    }
    public function importToDb() {
        $path = resource_path('pending-files/*.csv');
        $g = glob($path);

        foreach (array_slice($g,0,1) as $file){
            $data = array_map('str_getcsv',file(file));
            ParseFile::dispatch($data);

            unlink($file);
        }
    }
}
