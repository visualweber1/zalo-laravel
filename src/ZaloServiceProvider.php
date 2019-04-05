<?php

namespace Visualweber\Zalo;

use Illuminate\Support\ServiceProvider;

class ZaloServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/zalo.php';

        $this->publishes([$configPath => config_path('zalo.php')], 'config');
        $this->mergeConfigFrom($configPath, 'zalo');

        if ( class_exists('Laravel\Lumen\Application') ) {
            $this->app->configure('zalo');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('zalo', function ($app) {
            $config = isset($app['config']['services']['zalo']) ? $app['config']['services']['zalo'] : null;
            $options = [];
            if (is_null($config)) {
                $config = $app['config']['zalo'] ?: $app['config']['zalo::config'];
                $options['url_callback'] = $config['url_callback'];
            }

            $client = new ZaloClient($config['app_id'], $config['app_secret'], $config['oa_id'],$config['oa_secret'],$options);

            return $client;
        });

        $this->app->alias('zalo', 'Visualweber\Zalo\ZaloClient');
    }

    public function provides() {
        return ['zalo'];
    }
}
