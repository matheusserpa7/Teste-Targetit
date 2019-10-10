<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SchedulingRepository;
use App\Entities\Scheduling;
use App\Validators\SchedulingValidator;

/**
 * Class SchedulingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SchedulingRepositoryEloquent extends BaseRepository implements SchedulingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Scheduling::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SchedulingValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
