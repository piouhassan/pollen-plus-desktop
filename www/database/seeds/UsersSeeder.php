<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $users = [
            0 => [
                'username' => 'Stephane',
                'name' => 'Piou Hassan',
                'email' => 'piouhassan@gmail.com',
                'gender' => 'Masculin',
                'phone' => '92363533',
                'role' => 'admin',
                'work' => 'Developpeur multiplateforme',
                'password' => sha1('10121992')
            ],
            1 => [
                'username' => 'Max',
                'name' => 'Maxime Akpabla',
                'email' => 'mawulice@gmail.com',
                'gender' => 'Masculin',
                'phone' => '+228 98647306',
                'role' => 'user',
                'work' => 'Charger de la communication',
                'password' => sha1('michel')
            ],
            2 => [
                'username' => 'Grafikart',
                'name' => 'Johnatan Boyer',
                'email' => 'grafikart@contact.com',
                'gender' => 'Masculin',
                'phone' => '98647306123',
                'role' => 'user',
                'work' => 'Developpeur PhP',
                'password' => sha1('michel')
            ]
        ];
        foreach ($users as $user) {
            $this->table('users')
                ->insert($user)
                ->save();
        }
        

    }
}
