<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public static function sendMail($receiver)
    {
//        Mail::send('mail.notification', [$receiver], function ($message) use ($receiver) {
//            $message->to($receiver);
//            $message->subject('Testing Mails');
//
//        });

        Mail::send('mail.notification', ['name' => "fatuma"], function ($message) {

            $message->from('fettymkima@gmail.com', 'Laravel');
            $message->to('fettymkima@gmail.com')->subject('test!');
        });

    }
}
