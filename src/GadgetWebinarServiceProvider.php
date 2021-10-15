<?php

namespace Khaqani\GadgetWebinar;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class GadgetWebinarServiceProvider extends ServiceProvider
{
	public function boot()
	{
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'Webinar');
	}

	public function register()
	{
	}
}
