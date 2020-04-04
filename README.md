# nova-autofill
nova-autofill is a Laravel Nova package that allows for automatic filling of Nova FormFields.

![](https://media.giphy.com/media/KxWdeLiOc5YXmw7KlU/giphy.gif)

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
        $models = Model::getModelInstances(); // Instances of the parent model to autofill (These can be mocked)

        return [
            // The second parameter (id) can be any value that exists as a column on the model.
            Autofill::make('Nova Autofill', 'id')->options($filterKey, $models),
        ];
    }
}
```

Note: NovaAutoFill works for any Laravel model, but you have to implement the model retrievals for `$filterKey` and `$models` yourself.
