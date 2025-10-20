<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\ContactMessage;

class ContactApiTest extends TestCase
{
    public function test_contact_api_queues_mail()
    {
        Mail::fake();

        $payload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'Hello',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/contact', $payload);

        $response->assertStatus(202)
            ->assertJson(['message' => 'Message queued for delivery']);

        Mail::assertQueued(ContactMessage::class, function ($mail) use ($payload) {
            return $mail->data['email'] === $payload['email'];
        });
    }
}
