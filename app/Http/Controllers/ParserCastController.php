<?php

namespace App\Http\Controllers;

use App\Jobs\CastsScvProcess;
use App\Models\Cast;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Csv\Exception;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
class ParserCastController extends Controller
{
   public function upload() {
       if (request()->has('mycsvcasts')) {
           $data = file(request()->mycsvcasts);
           // Chunking file
           $chunks = array_chunk($data, 1000);
           $time = Carbon::now()->format('H:i:s/d-m-Y');
           $table_name = 'casts';
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
                   $record = array_combine($header, $item);
                   Cast::updateOrInsert([
                       'imdb_name_id' => $record['imdb_name_id'],
                       'name' => $record['name'],
                       'height' => $record['height'],
                       'bio' => $record['bio'],
                       'data_of_birth' => $record['date_of_birth'],
                       'place_of_birth' => $record['place_of_birth'],
                       'children' => $record['children'],

                   ]);
                   $last_id = DB::getPdo()->lastInsertId();
                   if ($last_id) {
                       $save_items++;
                   }

               }

           }
           Parsers::create([
               'start_date' =>  $time,
               'file_items' => $parse_count,
               'save_items' => $save_items,
               'table_name' => $table_name,
           ]);

           return redirect('/');
       }



   }
}
