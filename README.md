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
use Miljoen\NovaAutofill\Autofill;

class MyField extends Field
{
    public function fields(Request $request)
    {
        $filterKey = Model::getFilterKey();
        $models    = Model::getModelInstances();
        $options   = Model::getOptionsForModels($models);

        return [
            // The second parameter (id) can be any value that exists as a column on the model.
            Autofill::make('Autofill', 'id')->options($filterKey, $autofillTags, $autofillData);
        ];
    }
}
```

Note: NovaAutoFill works for any model, but you have to implement the model retrievals for `$filterKey`, `$models` and `$options` yourself.
