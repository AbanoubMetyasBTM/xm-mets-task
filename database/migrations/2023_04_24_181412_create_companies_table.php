<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('company_name', 300);
			$table->string('financial_statue', 20);
			$table->string('market_category', 300);
			$table->integer('round_lot_size');
			$table->string('security_name', 300);
			$table->string('symbol', 10)->unique('symbol');
			$table->string('test_issue', 10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
