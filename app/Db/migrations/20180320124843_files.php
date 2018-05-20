<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Files extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('files')) {
            return null;
        }

        $this->schema->create('files', function (Blueprint $table) {
            $table->string('name')->nullable(false);
            $table->string('uri')->nullable(false);
            $table->string('size')->nullable(false);
            $table->string('mime')->nullable(false);
            $table->timestamp('added_on');
            $table->integer('owner_id')->unsigned()->unique()->nullable(false);
        });

        $this->schema->table('files', function (Blueprint $table) {
            $table->foreign('owner_id')
            ->references('id')
            ->on('users');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('files');
    }
}
