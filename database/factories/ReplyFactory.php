<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->unique()->uuid(),
            'title' => Str::random(10),
            'body' => Str::random(10),
            'inBoardPseudoId' =>  fake()->unique()->numberBetween(1, 9999999999),
            'threadId' => fake()->unique()->uuid(),
            'userId' => 0,
            'createdAt' => date('Y-m-d H:i:s',fake()->unixTime()),
            'isHighlighted' => fake()->boolean(),
        ];
    }

    public function kurenaitest() {
        return $this->state(function (array $attributes) {
            return ['threadId' => '420',
                    'userId' => '69'
            ];
        });
    }
}
