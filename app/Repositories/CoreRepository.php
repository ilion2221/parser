<?php
namespace App\Repositories;
/**
 *Репозиторій для роботи з сутністями
 *
 * @package App\Repositories
 *
 * Може давати набори даних
 * Не може створювати/міняти сутності.
 */
abstract class CoreRepository
{
    protected $model;


    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();


    protected function startConditions()
    {

        return clone $this->model;
    }


}
