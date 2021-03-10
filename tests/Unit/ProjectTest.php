<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_new_project_can_register()
    {
        $user = User::factory()->passwordKnown()->create();
        $this->be($user);
        $response = $this->post('/projects', [
            'title' => 'Test',
            'user_id' => 0
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

   

}
