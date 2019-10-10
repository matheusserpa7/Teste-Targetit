<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Sector;

/**
 * Class SectorTransformer.
 *
 * @package namespace App\Transformers;
 */
class SectorTransformer extends TransformerAbstract
{
    /**
     * Transform the Sector entity.
     *
     * @param \App\Entities\Sector $model
     *
     * @return array
     */
    public function transform(Sector $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
