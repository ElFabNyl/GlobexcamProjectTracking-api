<?php

namespace Database\Factories;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phase' => $this->faker->text(),
            'amount_payed' => $this->faker->numberBetween(150000,500000),
            'method_payment' => Arr::random(['ORANGE MONEY','MTN MONEY','CASH']),
        ];
    }
}
