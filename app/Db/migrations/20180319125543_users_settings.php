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
            $table->boolean('accountStatus')->nullable(false)->default(true);
            $table->integer('accessLvl')->nullable(false)->default(1);
            $table->integer('userId')->unsigned()->unique()->nullable(false);
            $table->timestamps();
            $table->foreign('userId')
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
