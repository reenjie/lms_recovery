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
}
