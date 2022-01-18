<?php

namespace App\Http\Controllers;

use App\Mail\LindorMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title'=>'Mail from Lindor Stake House',
            'body'=>'This is for testing mail using gamil.com',
            ];

        Mail::to("lk37541@ubt-uni.net")->send(new LindorMail($details));
        return "Email Sent";

    }
}
