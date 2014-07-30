<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharactersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');

			$table->string('name');
			$table->integer('level');
			$table->string('class');
			$table->string('paragon_path');
			$table->string('epic_destiny');
			$table->string('total_xp');
			$table->string('race');
			$table->string('size');
			$table->string('age');
			$table->string('gender');
			$table->string('height');
			$table->string('weight');
			$table->string('alignment');
			$table->string('deity');
			$table->string('affiliations');

			$table->text('initiative');
			$table->text('ability_scores');
			$table->text('defenses');
			$table->text('movement');
			$table->text('senses');
			$table->text('attack_workspace');
			$table->text('damage_workspace');
			$table->text('basic_attacks');

			$table->text('hit_points');
			$table->text('action_points');
			$table->text('skills');

			$table->text('race_features');
			$table->text('class_features');
			$table->text('languages');
			$table->text('feats');

			$table->text('powers_at_will');
			$table->text('powers_encounter');
			$table->text('powers_daily');
			$table->text('powers_utility');

			$table->text('magic_items');
			$table->text('daily_item_powers');

			$table->text('other_equipment');
			$table->text('rituals');
			$table->text('wealth');

			$table->text('personality');
			$table->text('appearance');
			$table->text('background');
			$table->text('allies');
			$table->text('notes');

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
		Schema::drop('characters');
	}

}
