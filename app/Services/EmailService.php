<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService{
    public function sendEmail($view, $data, $toEmail, $toName, $subject){
        try {
            Mail::send($view, $data, function($message) use ($toEmail, $toName, $subject){
                $message->to($toEmail, $toName);
                $message->subject($subject);
            });
        } catch (\Exception $e) {
            Log::error("Gửi email thất bại đến $toEmail: " . $e->getMessage());
        }
    }
}