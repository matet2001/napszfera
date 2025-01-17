<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class BlogUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admin_can_access_blog_upload_page()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create(['is_admin' => false]);

        // Admin access
        $this->actingAs($admin)
            ->get('/blog/upload')
            ->assertOk()
            ->assertViewIs('blog.create'); // Assuming the view is named "blog.create".

        // Non-admin access
        $this->actingAs($user)
            ->get('/blog/upload')
            ->assertForbidden();
    }

    /** @test */
    public function blog_post_can_be_stored_by_admin()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post('/blog/upload', [
                'title' => 'Sample Blog',
                'content' => 'This is a test blog.',
            ])
            ->assertRedirect(route('blog.index')) // Assuming a redirect after storing.
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'title' => 'Sample Blog',
            'content' => 'This is a test blog.',
        ]);
    }

    /** @test */
    public function validation_errors_are_thrown_for_invalid_blog_upload_data()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post('/blog/upload', [])
            ->assertSessionHasErrors(['title', 'content']);
    }

    /** @test */
    public function non_admin_cannot_store_blogs()
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->post('/blog/upload', [
                'title' => 'Unauthorized Blog',
                'content' => 'Should not be allowed.',
            ])
            ->assertForbidden();

        $this->assertDatabaseMissing('posts', [
            'title' => 'Unauthorized Blog',
        ]);
    }
}
