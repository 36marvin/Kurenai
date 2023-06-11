<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BoardModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoardFactory extends Factory
{
    protected $model = BoardModel::class;

    /**
     *  Configures Factory to return only secret boards. 
     *  Default is that all boards are non-secret. 
     */
    public function secret () {
        return $this->state(function(array $attributes) {
            return ['isSecret' => true];
        });
    }

    /**
     *  Configures Factory to return only frozen boards. 
     *  Default is that all boards are non-frozen. 
     */
    public function frozen () {
        return $this->state(function (array $attributes) {
            return ['isFrozen' => true];
        });
    }

    public function kurenaitest () {
        return $this->state(function (array $attributes) {
            return ['name' => 'kurenaitest', 
                    'uri' => 'kurenaitest'
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
        return [
            // the id column is of type char(36), maybe this should be type-converted???
            'id' => fake()->unique()->randomNumber(5, true),
            // A 1 to 20 chars long alphanumeric string, without any instance of
            // two or more consecutive space chars, that always starts with a 
            // letter or a number.

            // Bug: this regex is capturing strings longer than 20 chars because of something
            // related to space chars counting.
            'name' => fake()->unique()->regexify('/^[A-Za-z0-9]{1}([ ]?[A-Za-z0-9]+){0,19}$/'),
           
            // A 1 to 10 chars long alphanumeric string without any whitespace
            'uri' => fake()->unique()->regexify('/[a-zA-Z0-9]{1,10}/'),

            // a 1 to 500 long string containing any chars, including newlines
            'description' => fake()->unique()->regexify('/.{1,100}/s'),
            'createdAt' => fake()->unixTime(),
            'updatedAt' => fake()->unixTime(),
            'isFrozen' => false,
            'isSecret' => false,
            'postCount' => 0,
        ];
    }
}
