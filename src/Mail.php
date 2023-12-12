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

    public function __construct()
    {
        $this -> mailer = new PHPMailer(true);
    }
}