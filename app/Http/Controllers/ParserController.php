<?php

namespace App\Http\Controllers;


use App\Jobs\MoviesCsvProcess;
use App\Models\Actor;
use App\Models\Parsers;
use Carbon\Carbon;
use Dotenv\Parser\Parser;
use Illuminate\Support\Facades\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;

class ParserController extends Controller

{

    public function index()
    {
            $items = Parsers::get();

        return view('vendor.home')->with(['data'=> $items]);
    }
    public function upload(){
        if (request()->has('mycsv')) {
            $data = file(request()->mycsv);
             MoviesCsvProcess::dispatch($data)->delay(Carbon::now()->addSeconds(2));
            return redirect('/');
        }


    }

    public function create(){
        return view('vendor.import');
    }



}
