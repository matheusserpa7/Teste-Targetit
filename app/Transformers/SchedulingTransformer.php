<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Scheduling;

/**
 * Class SchedulingTransformer.
 *
 * @package namespace App\Transformers;
 */
class SchedulingTransformer extends TransformerAbstract
{
    /**
     * Transform the Scheduling entity.
     *
     * @param \App\Entities\Scheduling $model
     *
     * @return array
     */
    public function transform(Scheduling $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
