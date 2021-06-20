<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //MC API
        // config(['package.client_id' => 'u6w1dqq0lzq4pl8812zjksrn']);
        // config(['package.client_secret' => 'WjwRhP0UOr8P9IrjgXtpTqZi']);
        // config(['package.auth_uri' => 'https://mcpththcmp1-ls8tz6vz2ypfzz7q.auth.marketingcloudapis.com/']);
        // config(['package.rest_uri' => 'https://mcpththcmp1-ls8tz6vz2ypfzz7q.rest.marketingcloudapis.com/']);
        // config(['package.soap_uri' => 'https://mcpththcmp1-ls8tz6vz2ypfzz7q.soap.marketingcloudapis.com/']);
        

        //Evergate
        // config(['evergage.account' => 'ekim1482497']);
        // config(['evergage.dataset' => 'engage']);
    }
}
