<?php

namespace Miljoen\NovaAutofill;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\Field;

class Autofill extends Field
{
    /**
     * @var string
     */
    public $component = 'nova-autofill';

    public function options(string $filterKey, Collection $models): Autofill {
        return $this->withMeta([
            'filterKey' => $filterKey,
            'options'   => $this->getSelectTags($filterKey, $models),
            'objects'   => $models,
        ]);
    }

    protected function getSelectTags(string $filterKey, Collection $models): Collection
    {
        return $models->map(function (Model $model) use ($filterKey) {
            return $model->getAttribute($filterKey);
        });
    }
}
