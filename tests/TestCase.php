<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;

class TestCase extends IntegrationTest {

	use DatabaseTransactions;

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

}
