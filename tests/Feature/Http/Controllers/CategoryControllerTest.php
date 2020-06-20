<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store() {
        $response = $this->actingAs($user)
            ->post(route('category.store'), [
                'name' => $this->faker->words(1, true)
            ]);

        $response->assertStatus(200);
        $response->assertRedirect('category.index');
    }
}
