<?php

namespace App\Http\Controllers\Mail;

use App\Complainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

/**
 * Created by PhpStorm.
 * User: baraka.machumu
 * Date: 11/3/2018
 * Time: 11:26 AM
 */
class MailController extends Controller
{



    public static function  sendMail($receiver){


        Mail::send('mail.notification', ['name' => $receiver], function ($message) {

            $message->from('barakabryson@gmail.com', 'Laravel');
            $message->to('divantinechuwa@gmail.com')->subject('tulia!');
        });


    }

}