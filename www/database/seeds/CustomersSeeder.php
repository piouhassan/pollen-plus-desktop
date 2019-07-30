<?php


use Phinx\Seed\AbstractSeed;

class CustomersSeeder extends AbstractSeed
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
        $data = [];
        $faker = \Faker\Factory::create('fr_FR');
        for ($i = 0; $i  < 12 ; ++$i){
            $date =  $faker->unixTime('now');
            $data[] = [
                'structure'  =>  'Particulier',
                'name' => $faker->name,
                'email'  => $faker->email,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'address' => $faker->address,
            ];
        }
    
        $this->table('customers')
            ->insert($data)
            ->save();

    }
}
