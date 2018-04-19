<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Images extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        // $this->schema->create('images', function (Blueprint $table) {
        //     $table->string('width')->nullable(false);
        //     $table->string('height')->nullable(false);
        //     $table->integer('file_id')->unsigned()->unique()->nullable(false);
        // });

        // $this->schema->table('images', function (Blueprint $table) {
        //     $table->foreign('file_id')
        //         ->references('id')
        //         ->on('files')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });
    }

    public function down()
    {
        $this->schema->dropIfExists('images');
    }
}
