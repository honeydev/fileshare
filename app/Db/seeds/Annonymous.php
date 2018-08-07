<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Phinx\Seed\AbstractSeed;
use Illuminate\Database\Capsule\Manager as Capsule;

class Annonymous extends AbstractSeed
{
    /**
     * @var \Illuminate\Database\Schema\MySqlBuilder
     */
    protected $schema;

    protected function init()
    {
        $this->schema = (new Capsule)->schema();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}