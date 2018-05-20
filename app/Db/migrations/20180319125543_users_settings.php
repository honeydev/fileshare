<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class UsersSettings extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('users_settings')) {
            return null;
        }

        $this->schema->create('users_settings', function (Blueprint $table) {
            $table->boolean('account_status')->nullable(false)->default(true);
            $table->integer('access_lvl')->nullable(false)->default(1);
            $table->integer('user_id')->unsigned()->unique()->nullable(false);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users_settings');
    }
}
