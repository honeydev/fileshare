<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Users extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token');
            $table->increments('id')->unsigned()->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}
