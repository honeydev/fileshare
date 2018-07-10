<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint as Blueprint;

class FileTokens extends \Fileshare\Db\migrations\BaseMigration
{
    public function up()
    {
        $this->down();
        $this->schema->create('file_tokens', function (Blueprint $table) {
            $table->string('token')->nullable(false);
            $table->integer("fileId")->unique();
            $table->timestamp('added_on');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('file_tokens');
    }
}
