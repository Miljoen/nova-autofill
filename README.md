# nova-autofill
nova-autofill is a Laravel Nova package that allows for automatic filling of Nova FormFields.

![](https://media.giphy.com/media/KxWdeLiOc5YXmw7KlU/giphy.gif)

## Installation

```
composer require Miljoen/nova-autofill
```

## Example usage for fresh Laravel project.

1. [Create a new Laravel project](https://laravel.com/docs/7.x/installation)
2. [Install Nova](https://nova.laravel.com/docs/)
3. Install the package using 

    `composer require Miljoen/nova-autofill`
    
4. Add `use AutofillTrait;` to the `/app/User.php` Model.
5. Implement the `filterKey()` and `autofillModels()` methods.
    
    For example:
    
    ```
   function filterKey(): string
    {
        return 'email';
    }

    function autofillModels(): \Illuminate\Support\Collection
    {
        return collect([
            new \App\User(['name' => 'cedric', 'email' => 'cedric@cedric.cedric', 'password' => \Illuminate\Support\Facades\Hash::make('cedric')]),
            new \App\User(['name' => 'yoeri', 'email' => 'yoeri@yoeri.yoeri', 'password' => \Illuminate\Support\Facades\Hash::make('yoeri')])
        ]);
    }
   ```
     
6. Add `Autofill::make('Nova Autofill', 'id')->options(
        \App\User::filterKey(),
        \App\User::autofillModels()),`
    
    to the return value of the `fields()` function in `/app/Nova/User.php`
7. Go to the `.../nova/resources/users/new` route in your browser to test the package

The `/app/User.php` model should look like this:
```
<?php

namespace App;

use AutofillTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use AutofillTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function filterKey(): string
    {
        return 'email';
    }

    static function autofillModels(): \Illuminate\Support\Collection
    {
        return collect([
            new \App\User(['name' => 'cedric', 'email' => 'cedric@cedric.cedric', 'password' => \Illuminate\Support\Facades\Hash::make('cedric')]),
            new \App\User(['name' => 'yoeri', 'email' => 'yoeri@yoeri.yoeri', 'password' => \Illuminate\Support\Facades\Hash::make('yoeri')])
        ]);
    }
}

```

The `/app/nova/User.php` fields() function should look like this:

```
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Autofill::make('Nova Autofill', 'id')->options(
                \App\User::filterKey(),
                \App\User::autofillModels()
            ),

            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
        ];
    }
```
