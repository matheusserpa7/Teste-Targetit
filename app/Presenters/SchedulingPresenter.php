<?php

namespace App\Presenters;

use App\Transformers\SchedulingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SchedulingPresenter.
 *
 * @package namespace App\Presenters;
 */
class SchedulingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SchedulingTransformer();
    }
}
