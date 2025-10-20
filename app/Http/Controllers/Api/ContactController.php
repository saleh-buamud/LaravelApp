<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Queue the mail so requests are fast and resilient
        Mail::to(config('mail.from.address'))
            ->queue(new ContactMessage($data));

        return response()->json(['message' => 'Message queued for delivery'], 202);
    }
}
