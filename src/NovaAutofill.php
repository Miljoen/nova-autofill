<?php

namespace Miljoen\NovaAutofill;

use Illuminate\Support\Collection;
use Laravel\Nova\Fields\Field;

class NovaAutofill extends Field
{
    /**
     * @var string
     */
    public $component = 'nova-autofill';

    public function options(string $filterKey, Collection $options, Collection $objects): NovaAutofill {
        return $this->withMeta([
            'filterKey' => $filterKey,
            'options'   => $options,
            'objects'   => $objects,
        ]);
    }
}
