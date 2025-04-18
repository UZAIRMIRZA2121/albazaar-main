<?php

namespace App\Services;

use Exception;
use App\Mail\TestEmailSender;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService
{

    public function getData(object $request): array
    {
        return [
            "status" => $request->get('status', 0),
            "name" => $request['name'],
            "host" => $request['host'],
            "driver" => $request['driver'],
            "port" => $request['port'],
            "username" => $request['username'],
            "email_id" => $request['email'],
            "encryption" => $request['encryption'],
            "password" => $request['password']
        ];
    }

    public function getMailData(object|array $mailData): array
    {
        return [
            "status" => 0,
            "name" => $mailData['name'],
            "host" => $mailData['host'],
            "driver" => $mailData['driver'],
            "port" => $mailData['port'],
            "username" => $mailData['username'],
            "email_id" => $mailData['email_id'],
            "encryption" => $mailData['encryption'],
            "password" => $mailData['password']
        ];
    }


    public function sendMail(object $request): array
    {
        $status = 0;
        $message = 'success';
    
        try {
            $emailServicesSmtp = getWebConfig(name: 'mail_config');
            if ($emailServicesSmtp['status'] == 0) {
                $emailServicesSmtp = getWebConfig(name: 'mail_config_sendgrid');
            }
    
            if ($emailServicesSmtp['status'] == 1) {
                $fromEmail = $emailServicesSmtp['email'] ?? config('mail.from.address');
                $fromName = $emailServicesSmtp['name'] ?? config('mail.from.name');
    
                if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid from email: $fromEmail");
                }
    
                Mail::to($request->email)->send(new TestEmailSender());
    
                $status = 1;
            }
        } catch (Exception $exception) {
            $status = 2;
            $message = $exception->getMessage();
    
            Log::error('Mail Sending Failed', [
                'error' => $message,
                'trace' => $exception->getTraceAsString(),
                'request_email' => $request->email ?? 'N/A'
            ]);
        }
    
        return [
            'status' => $status,
            'message' => $message
        ];
    }

}
