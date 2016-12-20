<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayercreateinfoActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('world')->create('playercreateinfo_action', function(Blueprint $table)
		{
			$table->boolean('race')->default(0);
			$table->boolean('class')->default(0);
			$table->smallInteger('button')->unsigned()->default(0);
			$table->integer('action')->unsigned()->default(0);
			$table->smallInteger('type')->unsigned()->default(0);
			$table->primary(['race','class','button']);
			$table->index(['race','class'], 'playercreateinfo_race_class_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('world')->drop('playercreateinfo_action');
	}

}