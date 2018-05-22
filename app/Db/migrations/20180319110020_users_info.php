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
            $table->string('avatarUri')->nullable(true);
            $table->integer('userId')->unsigned()->unique()->nullable(false);
            $table->timestamps();
        });

        $this->schema->table('users_info', function (Blueprint $table) {
            $table->foreign('userId')
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
