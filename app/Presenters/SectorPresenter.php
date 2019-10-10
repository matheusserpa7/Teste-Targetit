<?php

namespace App\Presenters;

use App\Transformers\SectorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SectorPresenter.
 *
 * @package namespace App\Presenters;
 */
class SectorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SectorTransformer();
    }
}
