<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class UsersInfo extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('users_info')) {
            return null;
        }

        $this->schema->create('users_info', function (Blueprint $table) {
            $table->string('name')->nullable(true);
            $table->string('avatar_uri')->nullable(true);
            $table->integer('user_id')->unsigned()->unique()->nullable(false);
        });

        $this->schema->table('users_info', function (Blueprint $table) {
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users_info');
    }
}
