<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once 'vendor/autoload.php';
use App\Mail;

if(
    isset($_POST['subject']) &&
    isset($_POST['body']) &&
    isset($_POST['email'])
) {
    $mail = new Mail(
        $_POST['subject'],
        $_POST['body'],
        $_POST['email']
    );

    if($mail -> send()) {
       echo json_encode(['result' => true]);
    }

    else {
        echo json_encode(['result' => false]);
    }
}