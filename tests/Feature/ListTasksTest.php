<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_a_user_can_see_a_task()
    {
        $this->withoutExceptionHandling();
        $task = factory(Task::class)->create([
            'name' => 'Primera tarea',
            'description' => 'Mi primera tarea'
        ]);

        $this->get(route('tasks.show',$task->id))
            ->assertStatus(200)
            ->assertJsonFragment(
                [
                    'name' => 'Primera tarea',
                    'description' => 'Mi primera tarea'
                ]
            );

    }
}
