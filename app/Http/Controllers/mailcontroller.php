<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class mailcontroller extends Controller
{
    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;
    private $sysemail;
    private $fromSystem;
    public function __construct()
    {
        $this->client_id = env('GOOGLE_API_CLIENT_ID');
        $this->client_secret = env('GOOGLE_API_CLIENT_SECRET');
        $this->token = env('SYSTEM_EMAIL_TOKEN');
        $this->sysemail = env('SYSTEM_EMAIL');
        $this->fromSystem = env('SYSTEM_NAME');
        $this->provider = new Google([
            'clientId' => $this->client_id,
            'clientSecret' => $this->client_secret,
        ]);
    }

    public function testemail(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth([
                    'provider' => $this->provider,
                    'clientId' => $this->client_id,
                    'clientSecret' => $this->client_secret,
                    'refreshToken' => $this->token,
                    'userName' => $this->sysemail,
                ])
            );
            $mail->setFrom($this->sysemail, $this->fromSystem);
            $mail->addAddress('reenjie17@gmail.com', 'reenjayCaimor');
            $mail->Subject = 'testingtestinglms';
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body = 'HEllo Pogi
           ';
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody = 'This is a plain text message body';
            if ($mail->send()) {
                echo 'send Successfully!';
            } else {
                echo 'not send';
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function sendOTP(Request $request){

        $email = $request->email;
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth([
                    'provider' => $this->provider,
                    'clientId' => $this->client_id,
                    'clientSecret' => $this->client_secret,
                    'refreshToken' => $this->token,
                    'userName' => $this->sysemail,
                ])
            );
            $mail->setFrom($this->sysemail, $this->fromSystem);
            $mail->addAddress($email,'lms_user');
            $mail->Subject = 'Reset Code';
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body = 
           
           '
           <!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta charset="UTF-8">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
               <title>Document</title>
           </head>
           
           <body style="background-color:#EADBC8;padding:50px">
           <div class="es-wrapper-color" style="padding:10px">
           <!--[if gte mso 9]>
               <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                   <v:fill type="tile" color="transparent" origin="0.5, 0" position="0.5, 0"></v:fill>
               </v:background>
           <![endif]-->
           <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
               <tbody>
                   <tr>
                       <td class="esd-email-paddings" valign="top">
                           <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                               <tbody>
                                   <tr>
                                       <td class="esd-stripe" align="center" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                           <table class="es-content-body" width="590" cellspacing="0" cellpadding="0" align="center" style="background-color: transparent;">
                                               <tbody>
                                                   <tr>
                                                       <td class="esd-structure es-p30" align="left" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                                           <table cellspacing="0" cellpadding="0" width="100%">
                                                               <tbody>
                                                                   <tr class="es-visible-simple-html-only">
                                                                       <td class="esd-container-frame es-container-visible-simple-html-only" width="450" valign="top" align="center" esdev-config="h1">
                                                                           <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#9A3B3B" style="background-color: #9A3B3B;padding:20px">
                                                                               <tbody>
                                                                                   <tr>
                                                                                       <td align="left" class="esd-block-text es-p35">
                                                                                           <p style="line-height: 150%; font-size: 14px;color:white">Your Reset Code is :</strong></p>
                                                                                           <p style="line-height: 150%; color: #EADBC8; font-size: 30px;text-align:center">'.session()->get('UniqueCode').'</p>
                                                                                           <p style="line-height: 150%;"><br></p>
                                                                                       
                                                                                           <p style="line-height: 150%;text-align: center; font-size: 11px;color:white"><br>Dont share this message to anyone.</p>
                                                                                           <p style="line-height: 150%; text-align: center; font-size: 11px;color:white">[ THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</p>
                                                                                           <p style="line-height: 150%; text-align: center; font-size: 12px;"><br></p>
                                                                                        
                                                                                       </td>
                                                                                   </tr>
                                                                               </tbody>
                                                                           </table>
                                                                       </td>
                                                                   </tr>
                                                               </tbody>
                                                           </table>
                                                       </td>
                                                   </tr>
                                               </tbody>
                                           </table>
                                       </td>
                                   </tr>
                               </tbody>
                           </table>
                       </td>
                   </tr>
               </tbody>
           </table>
       </div>
           
           </body>
           
           </html>
           
           
           
           ';
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody = 'This is a plain text message body';
            if ($mail->send()) {
              
                session(['codeSend' => 1]);
                return response()->json(['message'=>'success']);
            } else {
                return response()->json(['message'=>'errorsending']);
            }
        } catch (Exception $e) {
            return $e;
        }

    }
}
