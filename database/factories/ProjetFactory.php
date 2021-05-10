<?php

namespace Database\Factories;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Projet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'client_name' => $this->faker->name,
            'general_price' => $this->faker->numberBetween(150000,500000),
            'amount_payed' => $this->faker->numberBetween(150000,500000),
            'starting_date' => now(),
            'ending_date' => now(),
            'status' => Arr::random(['EN COUR','TERMINER', 'STOPPER']),
            'category' => Arr::random(['SITE WEB','GRAPHIC DESIGN','VIDEO']),
        ];
    }
}
