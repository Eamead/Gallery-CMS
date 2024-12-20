<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/categories');

        $response->assertStatus(200);
    }

    public function test_categories_can_be_created(): void
    {
        $categories = Category::factory()->count(3)->create();

        $this->assertDatabaseCount('categories', 3);
    }

    public function test_categories_have_correct_attributes(): void
    {
        $categories = Category::factory()->count(3)->create();

        foreach ($categories as $category) {
            $this->assertDatabaseHas('categories', [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
            ]);
        }
    }

    public function test_only_admins_can_create_categories()
    {
        // Create a regular user and an admin user
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        $categoryData = [
            'name' => 'New Category',
            'description' => 'Category Description',
        ];

        // Regular user cannot create category
        $this->actingAs($user)
            ->post('/categories', $categoryData)
            ->assertStatus(403); // Forbidden

        // Guest cannot create category
        $this->post('/categories', $categoryData)
            ->assertStatus(403); // Forbidden

        // Admin can create category
        $this->actingAs($admin)
            ->post('/categories', $categoryData)
            ->assertStatus(302) // Redirect after successful creation
            ->assertRedirect('/categories');

        // Category exists in database
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    public function test_only_admins_can_delete_categories()
    {
        // Create a category and users
        $category = Category::factory()->create();
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        // Regular user cannot delete category
        $this->actingAs($user)
            ->delete("/categories/{$category->id}")
            ->assertStatus(403);

        // Guest cannot delete category
        $this->delete("/categories/{$category->id}")
            ->assertStatus(403); // Forbidden

        // Admin can delete category
        $this->actingAs($admin)
            ->delete("/categories/{$category->id}")
            ->assertRedirect('/categories');

        // Category does not exist in database
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

}
