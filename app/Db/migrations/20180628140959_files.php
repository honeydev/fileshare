<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Files extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        $this->down();
        $this->schema->create('files', function (Blueprint $table) {
            $table->string('name')->nullable(false);
            $table->string('uri')->nullable(false);
            $table->string('size')->nullable(false);
            $table->string('mime')->nullable(false);
            $table->integer('likes')->default(0);
            $table->integer('views')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('ownerId')
                ->unsigned()
                ->nullable(false);
            $table->increments('id')->unsigned()->unique();
        });

        $this->schema->table('files', function (Blueprint $table) {
            $table->foreign('ownerId')
            ->references('id')
            ->on('users');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('files');
    }
}
