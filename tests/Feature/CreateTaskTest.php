<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    function test_a_user_can_create_a_task()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user,'api');

        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Prueba',
            'description' => 'Desc'
        ];

        $this->post('api/tasks', $data)
            ->assertStatus(201)
            ->assertJson(['message' => 'Tarea creada']);

        $this->assertDatabaseHas('tasks',$data);
    }

    function test_a_valid_task_is_being_created()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api');

        $data = [
            'name' => '',
            'description' => 'asdf'
        ];

        $this->post('api/tasks',$data)
            ->assertStatus(302);

        $this->assertDatabaseMissing('tasks', $data);
    }
}
