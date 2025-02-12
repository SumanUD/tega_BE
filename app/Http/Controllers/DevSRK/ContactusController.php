<?php

namespace App\Http\Controllers\DevSRK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function SaveData(Request $req)
    {
        $userdata1 = $req->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required|numeric',
        ]);

        $userdata2 = userdata::create($userdata1);

        // $mail_data = [
        //     'fromEmail'=>'raman.testemail@gmail.com',
        //     'admin'=>'raman.testemail@gmail.com',
        //     'recipient'=>$req->email,
        //     'fromName'=>'TEGA INDUSTRIES',
        //     'body'=>$req->message,
        // ];

        // Mail::send('layouts.MailToUser',$mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['recipient'])
        //             ->from($mail_data['fromEmail'],$mail_data['fromName'])
        //             ->subject('Test Mail');
        // });

        // Mail::send('layouts.MailToAdmin',$mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['admin'])
        //             ->from($mail_data['fromEmail'],$mail_data['fromName'])
        //             ->subject('Test Mail');
        // });
        return ("Data Saved");
    }
}
