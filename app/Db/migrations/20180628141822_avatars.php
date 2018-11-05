<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Avatars extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('avatars')) {
            return null;
        }
        $this->schema->create('avatars', function (Blueprint $table) {
            $table->string('name')->nullable(false);
            $table->string('uri')->nullable(false);
            $table->string('size')->nullable(true);
            $table->string('mime')->nullable(true);
            $table->integer('likes')->default(0);
            $table->integer('views')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('ownerId')
                ->unsigned()
                ->nullable(false);
            $table->increments('id')->unsigned()->unique();
        });

        $this->schema->table('avatars', function (Blueprint $table) {
            $table->foreign('ownerId')
                ->references('id')
                ->on('users');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('avatars');
    }
}
