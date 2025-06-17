<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' =>null,
            'review' =>fake()->paragraph,
            'rating' => fake()->numberBetween(1,5),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fake()->dateTimeBetween('-1 year','now')
        ];
    }

    //state methods, se on averafe kto reviews mujn mu kan fgjithe 3, e qe me
    //pas reviews me 4 ose 5 stars, we use state methods dmth me ba override
    //vleren e ni kolone me ni vlere tjeter
    public function good(){
        return $this->state(function (array $attributes){
            return[
                'rating' => fake()->numberBetween(4,5)
            ];
        });
    }

    public function average(){
        return $this->state(function (array $attributes){
            return[
                'rating' => fake()->numberBetween(2,5)
            ];
        });
    }

    public function bad(){
        return $this->state(function (array $attributes){
            return[
                'rating' => fake()->numberBetween(1,3)
            ];
        });
    }
}
