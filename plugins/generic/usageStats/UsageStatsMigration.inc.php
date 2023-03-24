<?php

/**
 * @file UsageStatsMigration.inc.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2000-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UsageStatsMigration
 * @brief Describe database table structures.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class UsageStatsMigration extends Migration {
        /**
         * Run the migrations.
         * @return void
         */
        public function up() {
		// Usage stats temporary records
		Capsule::schema()->create('usage_stats_temporary_records', function (Blueprint $table) {
			$table->bigInteger('assoc_id');
			$table->bigInteger('assoc_type');
			$table->bigInteger('day');
			$table->bigInteger('entry_time');
			$table->bigInteger('metric')->default(1);
			$table->string('country_id', 2)->nullable();
			$table->string('region', 2)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('load_id', 255);
			$table->smallInteger('file_type')->nullable();
		});
	}
}
