<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private static string $host = "smtp.gmail.com";
    private static int $port = 465;
    private PHPMailer $mailer;
    private string $email;
    private string $secret;

    //Mail message variables
    private string $from;
    private string $address;
    private string $subject;
    private string $body;
    private string $creator;

    private function setData():self {
        $this -> mailer -> isSMTP();
        $this -> mailer -> Host = $this::$host;
        $this -> mailer -> Port = $this::$port;
        $this -> mailer -> Username = $this -> email;
        $this -> mailer -> Password = $this -> secret;
        $this -> mailer -> SMTPAuth = true;
        $this -> mailer -> SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        return $this;
    }

    private function setMailMessage():void {
        $this -> mailer -> setFrom($this -> email, 'Mailer',true);
        $this -> mailer -> addAddress($this -> email);
        $this -> mailer -> isHTML(false);
        $this -> mailer -> Subject = $this -> subject;
        $this -> mailer -> Body = $this -> body;
        $this -> mailer -> AltBody = $this -> body;
    }

    public function __construct(string $subject, string $body, string $creator)
    {
        $this -> mailer = new PHPMailer(true);
        $this -> email = $_ENV['email'];
        $this -> secret = $_ENV['secret'];

        $this -> subject = $subject;
        $this -> body = $body;
        $this -> creator = $creator;

        $this -> setData() -> setMailMessage();
    }

    public function send():bool {
        try {
            $this -> mailer -> send();
        }
        catch (\Exception $e) {
            return false;
        }

        return true;

    }
}