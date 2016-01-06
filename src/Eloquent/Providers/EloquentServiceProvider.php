<?php

namespace Eloquent\Providers;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentServiceProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $this['db'] = $this->share(function() use($app) {
            $capsule = new Capsule;
            $capsule->addConnection(
                $app['config']['database']['connections'][
                    $app['config']['database']['connection']
                ]
            );

            return $capsule;
        });

        $this['db']->setAsGlobal();
        $this['db']->bootEloquent();
    }

    public function boot(Application $app) {
    }

}
