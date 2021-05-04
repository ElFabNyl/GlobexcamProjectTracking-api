<?php

namespace Database\Factories;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class DomainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Domain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_host' => Arr::random(['stevy.com','yvan.net','joe.cm','nyl.fr']),
            'name_customer' => $this->faker->name,
            'price' => Arr::random(['15000','20000','25000','30000','40000','50000']),
            'service' => Arr::random(['RENEW','REGISTER','SMS']),
            'method_payment' => Arr::random(['ORANGE MONEY','MTN MONEY','CASH']),
        ];
    }
}
