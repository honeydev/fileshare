<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Users extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('users')) {
            return null;
        }
        
        $this->schema->create('users', function (Blueprint $table) {
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->increments('id')->unsigned()->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}
