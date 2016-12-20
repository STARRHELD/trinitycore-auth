<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePvpstatsBattlegroundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('characters')->create('pvpstats_battlegrounds', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->boolean('winner_faction');
			$table->boolean('bracket_id');
			$table->boolean('type');
			$table->dateTime('date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('characters')->drop('pvpstats_battlegrounds');
	}

}
