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

}
