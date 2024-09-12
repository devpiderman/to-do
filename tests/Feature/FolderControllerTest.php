<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FolderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_folder(): void
    {
        $user = User::factory()->create();
        $folderData = [
            'title' => 'Test Folder',
        ];
        $response = $this->actingAs($user)->postJson('/api/folders', $folderData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('folders', [
            'title' => 'Test Folder',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_fetch_folders(): void
    {
        $user = User::factory()->create();
        Folder::factory()->count(3)->create();
        $response = $this->actingAs($user)->getJson('/api/folders');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_user_can_update_folder(): void
    {
        $user = User::factory()->create();
        $folder = Folder::factory()->create(['user_id' => $user]);
        $updatedData = [
            'title' => 'Updated Folder',
        ];
        $response = $this->actingAs($user)->putJson("/api/folders/{$folder->id}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('folders', [
            'title' => 'Updated Folder',
            'user_id' => $user->id
        ]);
    }

    public function test_user_can_delete_folder(): void
    {
        $user = User::factory()->create();
        $folder = Folder::factory()->create(['user_id' => $user]);
        $response = $this->actingAs($user)->deleteJson("/api/folders/{$folder->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('folders', [
            'id' => $folder->id,
        ]);
    }

    public function test_folder_creation_requires_title(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/folders', [
            'title' => ''
        ]);
        $response->assertStatus(422);
    }

    public function test_user_cant_update_others_folders(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $folder = Folder::factory()->create(['user_id' => $user1]);
        $updatedData = [
            'title' => 'Updated Folder'
        ];
        $response = $this->actingAs($user2)->putJson("/api/folders/{$folder->id}", $updatedData);
        $response->assertStatus(403);
    }
}
