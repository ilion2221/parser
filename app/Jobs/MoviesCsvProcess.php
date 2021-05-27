<?php

namespace App\Jobs;

use App\Models\Actor;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Parsers;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MoviesCsvProcess implements ShouldQueue
{
    use  Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $timeout = 0;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // Chunking file
        $chunks = array_chunk($this->data, 1000);
        $time = Carbon::now()->format('H:i:s/d-m-Y');
        $table_name = 'movies';
        $parse_count = 0;
        $header = [];
        $save_items = 0;
        foreach ($chunks  as $key=>$chunk){
            $parse_count = $parse_count + count($chunk);
            $chunk = array_map('str_getcsv',$chunk);

            if($key == 0){
                $header = $chunk[0];
                unset($chunk[0]);
            }

            foreach ($chunk as $k => $item) {
                //Record for db
                $record = array_combine($header, $item);

                $genres = array();
                $isTop = false;
                $isUsa = false;
                $isEurope = true;
                $genres_rep = str_replace(' ', '', $record['genre']);
                $genres = explode(",", $genres_rep);
                $countries_rep = str_replace(' ', '', $record['country']);
                $countries = explode(",", $countries_rep);
                $decade = substr($record['year'], 0, -1);
                $actors_rep = $record['actors'];
                $actors_array = explode(",", $actors_rep);
                $actors = array_map('trim', $actors_array);
                $decade .= '0';

                if ($record['avg_vote'] >= 8) {
                    $this->$isTop = true;
                }
                //Add movies
                Movie::updateOrInsert([
                    'imdp_title_id' => $record['imdb_title_id'],
                    'title' => $record['title'],
                    'duration' => $record['duration'],
                    'description' => $record['description'],
                    'avg_vote' => $record['avg_vote'],
                    'votes' => $record['votes'],
                    'year' => $record['year'],
                    'decade' => $decade,
                    'reviews_from_users' => $record['reviews_from_users'],
                    'reviews_from_critics' => $record['reviews_from_critics'],
                    'is_top' => $isTop,
                ]);
                $last_id = DB::getPdo()->lastInsertId();


                if ($last_id) {
                    $save_items++;
                    $movier = Movie::find($last_id);
                    //Add counties
                    if ($countries) {
                        if ($record['country'] == 'USA') {
                            $isUsa = true;
                            $isEurope = false;
                        } else {
                            $isUsa = false;
                            $isEurope = true;
                        }
                        foreach ($countries as $country) {
                            $country_object = Country::updateOrCreate([
                                'name' => $country,
                                'is_usa' => $isUsa,
                                'is_europe' => $isEurope,
                            ]);
                            $mov = $movier->countries()->attach($country_object->id);
                        }
                    }
                    //Add actors
                    foreach ($actors as $actor) {
                        Actor::updateOrCreate([
                            'movie_id' => $last_id,
                            'artist_name' => $actor,
                        ]);
                    }
                    //Add genres
                    if ($genres) {
                        foreach ($genres as $genre) {
                            $genre_object = Genre::updateOrCreate([
                                'name' => $genre,
                            ]);
                            $mov = $movier->genres()->attach($genre_object->id);
                        }
                    }
                }

            }

        }
        Parsers::create([
            'start_date' =>  $time,
            'file_items' => $parse_count,
            'save_items' => $save_items,

            'table_name' => $table_name,
        ]);

        }

}
