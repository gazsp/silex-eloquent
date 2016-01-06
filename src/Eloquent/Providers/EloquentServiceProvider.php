<?php

namespace Eloquent\Providers;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentServiceProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $app['db'] = $app->share(function() use($app) {
            $capsule = new Capsule;
            $capsule->addConnection(
                $app['config']['database']['connections'][
                    $app['config']['database']['connection']
                ]
            );

            return $capsule;
        });

        $app['db']->setAsGlobal();
        $app['db']->bootEloquent();
    }

    public function boot(Application $app) { }
}
