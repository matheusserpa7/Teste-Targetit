<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class SectorValidator.
 *
 * @package namespace App\Validators;
 */
class SectorValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
          'sector_name'   => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
