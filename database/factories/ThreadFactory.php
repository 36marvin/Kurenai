<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ThreadModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ThreadFactory extends Factory
{
    protected $model = ThreadModel::class;


    public function sendToDesignatedTestingBoard() {
        return $this->state(function (array $attributes) {
            return ['boardUri' => 'kurenaitest',
                    'userId' => '69'
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Todo: prevent this from creating threads with duplicate
        // unique attributes (ids, pseudoid, uri, etc.)

        return [
            'id' => fake()->unique()->uuid(),
            'userId' => 0,
            'boardUri' => fake()->unique()->regexify('/[a-zA-Z0-9]{1,10}/'), // Todo: DRY.
            // 'fuelCount' => 0,
            'bumpCount' => 0,
            'inBoardPseudoId' => fake()->unique()->numberBetween(1, 9999999999),
            'title' => fake()->regexify('/^[A-Za-z0-9]{1}([ ]?[A-Za-z0-9]+){0,19}$/'),
            'body' => fake()->regexify('/^[A-Za-z0-9]{1}([ ]?[A-Za-z0-9]+){0,19}$/'),
            'createdAt' => date('Y-m-d H:i:s',fake()->unixTime()),
            'lastPinnedUpdated' => date('Y-m-d H:i:s',fake()->unixTime()),
            'lastValidBumpAt' => date('Y-m-d H:i:s',fake()->unixTime()),
            'updatedAt' => date('Y-m-d H:i:s',fake()->unixTime()),
            'isLocked' => fake()->boolean(),
            'isInfinite' => fake()->boolean(),
            'isPinned' => fake()->boolean(),
            'isCensored' => fake()->boolean()
        ];
    }

    public function censored () {

    }

    public function pinned () {
        
    }
}
