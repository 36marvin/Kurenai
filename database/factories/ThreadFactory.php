<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Http\Models\ThreadModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ThreadFactory extends Factory
{
    protected $model = ThreadModel::class;


    protected function sendToToDesignatedTestingBoard() {
        return $this->state(function (array $attributes) {
            return ['board_uri' => 'kurenaitest'];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake->uuid(),
            'user_id' => 0,
            'board_uri' => fake()->regexify('/[a-zA-Z0-9]{1,10}/'), // Todo: DRY.
            'fuel_count' => 0,
            'bump_count' => 0,
            'title' => fake()->regexify('/^[A-Za-z0-9]{1}([ ]?[A-Za-z0-9]+){0,19}$/'),
            'body' => fake()-regexify('/^[A-Za-z0-9]{1}([ ]?[A-Za-z0-9]+){0,19}$/'),
            'created_at' => fake()->dateTime(),
            'last_pinned_updated' => fake()->unixTime(),
            'last_valid_bump_at' => fake()->unixTime(),
            'last_edited_at' => fake()->unixTime(),
            'is_locked' => fake()->boolean(),
            'is_infinite' => fake()->boolean(),
            'is_pinned' => fake()->boolean(),
            'is_censored' => fake()->boolean()
        ];
    }

    public function censored () {

    }

    public function pinned () {
        
    }
}
