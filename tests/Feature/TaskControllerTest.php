<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task(): void
    {
        $user = User::factory()->create();
        $folder = Folder::factory()->create(['user_id' => $user]);
        $taskData = [
            'title' => 'Test Task',
            'description' => 'Description For Test Task',
            'status' => 'todo',
            'folder_id' => $folder->id,
        ];
        $response = $this->actingAs($user)->postJson('/api/tasks', $taskData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Description For Test Task',
            'status' => 'todo',
            'folder_id' => $folder->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_fetch_tasks(): void
    {
        $user = User::factory()->create();
        Task::factory()->count(3)->create(['user_id' => $user]);
        $response = $this->actingAs($user)->getJson('api/tasks');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_user_can_update_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user]);
        $updatedData = [
            'title' => 'Updated Task',
            'status' => $task->status,
            'folder_id' => $task->folder_id
        ];
        $response = $this->actingAs($user)->putJson("/api/tasks/{$task->id}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
        ]);
    }

    public function test_user_can_delete_task(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user]);
        $response = $this->actingAs($user)->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_task_creation_requires_validation(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/tasks', [
            'description' => 'Test Description',
        ]);
        $response->assertStatus(422);
    }

    public function test_user_cant_update_others_task(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user2->id]);
        $updatedData = [
            'title' => 'Updated Task',
            'status' => $task->status,
            'folder_id' => $task->folder_id
        ];
        $response = $this->actingAs($user1)->putJson("/api/tasks/{$task->id}", $updatedData);
        $response->assertStatus(403);
    }
}
