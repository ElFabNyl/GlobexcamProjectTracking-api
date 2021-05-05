<?php

namespace Database\Factories;

use App\Models\Dept;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dept::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount_to_pay' => $this->faker->numberBetween(150000,500000),
            'amount_payed' => $this->faker->numberBetween(150000,500000),
        ];
    }
}
