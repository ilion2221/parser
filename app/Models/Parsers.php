<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parsers extends Model
{
    use HasFactory;
    protected $table = 'parsers';
    protected $guarded = [];
    protected $fillable = ['start_date','file_items','save_items','time_parse','table_name'];
}
