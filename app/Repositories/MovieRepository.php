<?php


namespace App\Repositories;

use App\Models\Movie as Model;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

}
