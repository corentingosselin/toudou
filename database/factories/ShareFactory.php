<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Share;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Share::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projects = Project::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        return [
            'project_id' => $this->faker->randomElement($projects),
            'accepted' => false,
            'edit' => true,
            'user_id' => $this->faker->randomElement($users)

        ];
    }
}
