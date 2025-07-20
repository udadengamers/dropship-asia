<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Cookie;
use Twilio\Rest\Client;
use Exception;
use App\Mail\VerificationEmailNumber;

class VerificationAccountController extends Controller
{
    public function send_mail(Request $request)
    {
        Mail::send('email.verify_email_number', [
            'token' => $request->remember_token,
            'email' => $request->email
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Number');
        });
    }
    public function send_mail_pc(Request $request)
    {
        try {
            Mail::send('email.password_verify', [
                'link' => route('pcmail.verify', ['dataverify' => $request->cp_by_email]),
                'email' => $request->email
            ], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Change Request');
            });

            return response()->json([
                'message' => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 501);
        }
    }
    public function send_code(Request $request)
    {
        try {
            $number = rand(100000, 999999);

            Cookie::queue('code', $number, 525600);

            if ($request->type == 'phone') {
                $sid    = config('services.twilio.sid');
                $token  = config('services.twilio.token');
                $from   = config('services.twilio.whatsapp_from');
                $to     = '+' . $request->phone;
                $twilio = new Client($sid, $token);

                $message = $twilio->messages
                    ->create(
                        "whatsapp:" . $to,
                        array(
                            "from" => "whatsapp:+14155238886",
                            "body" => "" . $number . ""
                        )
                    );
            } else {
                // Mail::send('email.verify_email_number', [
                //     'number' => $number,
                //     'email' => $request->email
                // ], function($message) use ($request) {
                //     $message->to($request->email);
                //     $message->subject('Email Verification Number');
                // });
                $data = [
                    'number' => $number,
                    'email' => $request->email,
                    'subject' => 'Email Verification Number'
                ];
                Mail::to($request->email)->send(new VerificationEmailNumber($data));
            }

            return response()->json([
                'message' => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 501);
        }
    }
}
