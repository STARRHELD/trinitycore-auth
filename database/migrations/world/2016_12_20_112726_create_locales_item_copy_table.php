<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalesItemCopyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('world')->create('locales_item_copy', function(Blueprint $table)
		{
			$table->integer('entry')->unsigned()->default(0)->primary();
			$table->string('name_loc1', 100)->default('');
			$table->string('name_loc2', 100)->default('');
			$table->string('name_loc3', 100)->default('');
			$table->string('name_loc4', 100)->default('');
			$table->string('name_loc5', 100)->default('');
			$table->string('name_loc6', 100)->default('');
			$table->string('name_loc7', 100)->default('');
			$table->string('name_loc8', 100)->default('');
			$table->string('description_loc1')->nullable();
			$table->string('description_loc2')->nullable();
			$table->string('description_loc3')->nullable();
			$table->string('description_loc4')->nullable();
			$table->string('description_loc5')->nullable();
			$table->string('description_loc6')->nullable();
			$table->string('description_loc7')->nullable();
			$table->string('description_loc8')->nullable();
			$table->smallInteger('VerifiedBuild')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('world')->drop('locales_item_copy');
	}

}
