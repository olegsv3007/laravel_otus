<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;

    public function definition(): array
    {
        $discount = $this->faker->boolean(95) ? 0 : $this->faker->randomNumber(2);
        $image = $this->faker->image(public_path('/img/' . Apartment::FOLDER_PHOTOS), 300, 200, null, false);

        return [
            'active' => $this->faker->boolean(95),
            'number_of_people' => $this->faker->numberBetween(1, 4),
            'title' => $this->faker->text(60),
            'description' => $this->faker->realText(400),
            'price' => $this->faker->randomFloat(2, 1, 10000),
            'discount' => $discount,
            'main_image' => $image,
        ];
    }
}
