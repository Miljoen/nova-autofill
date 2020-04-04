# nova-autofill
nova-autofill is a Laravel Nova package to automatically fill in Laravel Nova FormFields.

![](https://im4.ezgif.com/tmp/ezgif-4-d2a8e0073df9.gif)

## Installation

```
composer require Miljoen/nova-autofill
```

## Usage

Add to Nova Field

```php
<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Miljoen\NovaAutofill\Autofill;

class MyField extends Field
{
    public function fields(Request $request)
    {
        /** @var string $filterKey */
        $filterKey = Model::getFilterKey();   // Column from which to filter the selected model, e.g. "email"
        
        /** @var Collection */
        $models = Model::getModelInstances(); // Instances of the Nova parent model (These can be mocked)

        return [
            // The second parameter (id) can be any value that exists as a column on the model.
            Autofill::make('Nova Autofill', 'id')->options($filterKey, $models),
        ];
    }
}
```

Note: NovaAutoFill works for any model, but you have to implement the model retrievals for `$filterKey`, `$models` and `$options` yourself.
