<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    /**
     * Set up the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Prevent real notifications, events, emails, and jobs from being triggered during tests
        Notification::fake();
        Event::fake();
        Mail::fake();
        Queue::fake();
    }
    
    /**
     * Helper method to login a user for testing.
     *
     * @param  \App\Models\User|null  $user
     * @return $this
     */
    protected function loginAs($user = null)
    {
        $user = $user ?? \App\Models\User::factory()->create();
        $this->actingAs($user);
        
        return $this;
    }
    
    /**
     * Create a JSON request with proper headers.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function jsonRequest($method, $uri, array $data = [])
    {
        return $this->json($method, $uri, $data, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }
    
    /**
     * Helper to assert successful API responses.
     *
     * @param  \Illuminate\Testing\TestResponse  $response
     * @param  int  $status
     * @return \Illuminate\Testing\TestResponse
     */
    protected function assertSuccessfulResponse($response, $status = 200)
    {
        $response->assertStatus($status);
        return $response;
    }
}