<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Dept;
use App\Models\Domain;
use App\Models\Projet;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create factory to generate data fake data for user in database
        User::factory(20)->create()->each(

            function (User $user) {

                // Seed table Domain with the user_id are created
                Domain::factory(5)->create(['user_id' => $user->id]);

                // Seed table Projet with user
                Projet::factory(3)
                    ->create(['assign_to' => $user->name,'user_id' => $user->id, 'client_email' => $user->email ]);

                Comment::factory(10)->create([
                   // here are foreign keys

                    'user_id' => $user->id,
                    'projet_id' => 1
                ]);

                Dept::factory(10)->create(['user_id'=> $user->id, 'projet_id' => 1 ])->each(

                    function (Receipt $dept) {

                        Dept::factory(5)->create([
                            // here are foreign keys
                            'dept_id' => $dept->id,
                        ]);
                    }
                );

            }
        );


    }
}
