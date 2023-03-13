<?php

namespace Tests\Feature;

use App\Models\Todo;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * @return void
     */
    public function testIndexMethod()
    {
        // Seed the database with some dummy todo items
        factory(Todo::class, 10)->create();

        // Call the index method on the TodoController
        $response = $this->get('/todos');

        // Assert that the response has a 200 HTTP status code
        $response->assertStatus(200);

        // Assert that the response contains a list of todo items
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'title',
                    'completed'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testCreateMethod()
    {
        // Create a new todo item using the request data
        $todo = factory(Todo::class)->make();

        // Call the create method on the TodoController
        $response = $this->post('/todos', $todo->toArray());

        // Assert that the response has a 201 HTTP status code
        $response->assertStatus(201);

        // Assert that the response contains the newly-created todo item
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'completed'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testPostMethod()
    {
        // Create a new todo item using the request data
        $todo = factory(Todo::class)->make();

        // Call the create method on the TodoController
        $response = $this->post('/todos', $todo->toArray());

        // Assert that the response has a 201 HTTP status code
        $response->assertStatus(201);

        // Assert that the response contains the newly-created todo item
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'completed'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function testDeleteMethod()
    {
        // Create a new todo item
        $todo = factory(Todo::class)->create();

        // Call the delete method on the TodoController
        $response = $this->delete("/todos/{$todo->id}");

        // Assert that the response has a 200 HTTP status code
        $response->assertStatus(200);

        // Assert that the todo item was deleted
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id
        ]);
    }

    /**
     * @return void
     */
    public function testUpdateMethod()
    {
        // Create a new todo item
        $todo = factory(Todo::class)->create();

        // Update the todo item using the request data
        $updatedTodo = factory(Todo::class)->make();

        // Call the update method on the TodoController
        $response = $this->put('/todos/' . $todo->id, $updatedTodo->toArray());

        // Assert that the response has a 200 HTTP status code
        $response->assertStatus(200);

        // Assert that the response contains the updated todo item
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'completed'
            ]
        ]);
    }


}