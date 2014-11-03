<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_id');
			$table->integer('user_id');
			$table->enum('action', ['upvote', 'downvote', 'report', 're-enable', 'disable', 'auto-disable', 'add', 'delete']);
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
		Schema::drop('comment_actions');
	}

}
