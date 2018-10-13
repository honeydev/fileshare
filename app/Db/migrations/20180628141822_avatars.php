<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class Avatars extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        if ($this->schema->hasTable('files')) {
            return null;
        }

        $this->schema->create('avatars', function (Blueprint $table) {
            $table->string('ownerId');
            $table->integer('parentId')->unsigned()->primary();
        });

        $this->schema->table('avatars', function (Blueprint $table) {
            $table->foreign('parentId')
                ->references('id')
                ->on('files')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('avatars');
    }
}
