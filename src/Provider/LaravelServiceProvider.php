<?php

namespace Iphuongtt\Heimdal\Provider;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Iphuongtt\Heimdal\Reporters\BugsnagReporter;
use Iphuongtt\Heimdal\Reporters\RollbarReporter;
use Iphuongtt\Heimdal\Reporters\SentryReporter;

class LaravelServiceProvider extends BaseProvider {

    public function register()
    {
        $this->loadConfig();
        $this->registerAssets();
        $this->bindReporters();
    }

    private function registerAssets()
    {
        $this->publishes([
            __DIR__.'/../config/iphuongtt.heimdal.php' => config_path('iphuongtt.heimdal.php')
        ]);
    }

    private function loadConfig()
    {
        if ($this->app['config']->get('iphuongtt.heimdal') === null) {
            $this->app['config']->set('iphuongtt.heimdal', require __DIR__.'/../config/iphuongtt.heimdal.php');
        }
    }

    private function bindReporters()
    {
        $this->app->bind(BugsnagReporter::class, function ($app) {
            return function (array $config) {
                return new BugsnagReporter($config);
            };
        });

        $this->app->bind(SentryReporter::class, function ($app) {
            return function (array $config) {
                return new SentryReporter($config);
            };
        });

        $this->app->bind(RollbarReporter::class, function ($app) {
            return function (array $config) {
                return new RollbarReporter($config);
            };
        });
    }
}
