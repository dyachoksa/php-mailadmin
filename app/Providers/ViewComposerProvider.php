<?php

namespace App\Providers;

use App\Models\Domain;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['aliases.form'], function($view) {
            $domains = [];

            $query = Domain::select('id', 'fqdn')->orderBy('fqdn', 'asc')->get();
            foreach ($query as $domain) {
                $domains[$domain['id']] = $domain['fqdn'];
            }


            $view->with('domains', $domains);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
