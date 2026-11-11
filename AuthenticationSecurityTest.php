<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationSecurityTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(
        string $role = 'student',
        string $status = 'active'
    ): User {
        static $counter = 0;
        $counter++;

        return User::create([
            'username' => 'AUTH-TEST-' . $counter,
            'name' => 'Authentication Test User',
            'email' => 'auth-test-' . $counter . '@example.com',
            'password' => 'CorrectPassword@123',
            'role' => $role,
            'status' => $status,
        ]);
    }

    public function test_active_upp_can_login_with_correct_credentials(): void
    {
        $user = $this->createUser('upp', 'active');

        $response = $this->post(route('login.submit'), [
            'identifier' => $user->username,
            'password' => 'CorrectPassword@123',
            'selected_role' => 'upp',
        ]);

        $response->assertRedirect(route('upp.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_upp_cannot_login(): void
    {
        $user = $this->createUser('upp', 'inactive');

        $response = $this->post(route('login.submit'), [
            'identifier' => $user->username,
            'password' => 'CorrectPassword@123',
            'selected_role' => 'upp',
        ]);

        $response->assertSessionHasErrors('identifier');

        $this->assertGuest();
    }

    public function test_user_cannot_login_using_the_wrong_role(): void
    {
        $user = $this->createUser('upp', 'active');

        $response = $this->post(route('login.submit'), [
            'identifier' => $user->username,
            'password' => 'CorrectPassword@123',
            'selected_role' => 'student',
        ]);

        $response->assertSessionHasErrors('identifier');

        $this->assertGuest();
    }

    public function test_deactivated_user_cannot_continue_using_existing_session(): void
    {
        $user = $this->createUser('upp', 'active');

        $this->actingAs($user);

        $user->update(['status' => 'inactive']);

        $response = $this->get(route('upp.dashboard'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_logout_ends_authenticated_session(): void
    {
        $user = $this->createUser('upp', 'active');

        $response = $this->actingAs($user)
            ->post(route('logout'));

        $response->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
