<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

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

}
