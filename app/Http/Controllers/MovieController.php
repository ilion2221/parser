<?php

namespace App\Http\Controllers;

use App\Models\Decades;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {


        $data_usa = Movie::whereHas('countries', function ($query) {
            $query->where('is_usa', '=', true);
        })->with('actors')->with('genres')->orderBy('avg_vote', 'desc')->where('avg_vote', '>=', 8)->orderBy('decade', 'asc')->get()
            ->groupBy('decade')
            ->sortKeysDesc()
            ->map(function ($deal) {
                return $deal->take(5);
            });

        $data_eu = Movie::whereHas('countries', function ($query) {
            $query->where('is_europe', '=', true);
        })->with('actors')->with('genres')->orderBy('avg_vote', 'desc')->where('avg_vote', '>=', 8)->orderBy('decade', 'ASC')->get()
            ->groupBy('decade')
            ->sortKeysDesc()
            ->map(function ($deal) {
                return $deal->take(5);
            });


        return view('vendor.rating')->with(['data_usa' => $data_usa, 'data_eu' => $data_eu]);

    }
}
