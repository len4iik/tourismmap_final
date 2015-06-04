<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('capital');
            $table->string('flag');
			$table->string('languages');
			$table->decimal('area', 8, 2)->unsigned();
			$table->integer('population')->unsigned();
			$table->string('currency');
			$table->string('timezone');
			$table->string('code');
			$table->text('description');
			$table->text('guide');
			$table->text('facts');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}



}
