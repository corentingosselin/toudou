<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        return [
            'title' => $this->faker->unique()->text($maxNbChars = 24),
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
