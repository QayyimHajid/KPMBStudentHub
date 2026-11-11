<?php

namespace Tests\Unit;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Session\TokenMismatchException;
use Mockery;
use Tests\TestCase;

class PreventRequestForgeryTest extends TestCase
{
    public function test_post_without_csrf_token_is_rejected(): void
    {
        $app = Mockery::mock(Application::class);

        $app->shouldReceive('runningInConsole')
            ->andReturn(false);

        $app->shouldReceive('runningUnitTests')
            ->andReturn(false);

        $encrypter = app(Encrypter::class);

        $middleware = new PreventRequestForgery(
            $app,
            $encrypter
        );

        $request = Request::create(
            '/signup',
            'POST',
            [
                'student_id' => 'CSRFTEST999',
                'name' => 'CSRF Test',
                'email' => 'csrf-test@example.com',
                'password' => 'TestPassword123',
                'password_confirmation' => 'TestPassword123',
            ]
        );

        // Simulate a normal web session with a CSRF token.
        $session = new Store(
            'test_session',
            app('session')->driver()->getHandler()
        );

        $session->start();
        $request->setLaravelSession($session);

        // Do not send a CSRF token or a trusted same-origin header.
        $request->headers->remove('Sec-Fetch-Site');
        $request->headers->remove('X-CSRF-TOKEN');
        $request->headers->remove('X-XSRF-TOKEN');

        $this->expectException(TokenMismatchException::class);

        $middleware->handle(
            $request,
            fn ($request) => response('Request was accepted')
        );
    }
}
