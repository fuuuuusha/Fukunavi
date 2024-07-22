<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

date_default_timezone_set('Etc/UTC');
require dirname(__FILE__) . '/vendor/autoload.php';
require 'config.php';

function get_self_url() {
  $self_url = $_SERVER['PHP_SELF'];
  return $self_url;
}

function check_form_validation($form_data) {
  if (!$form_data['name'] || !$form_data['mail'] || !$form_data['content']) {
    return false;
  } else {
    return true;
  }
}

function send_email($data) {
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 465;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->SMTPAuth = true;
  $mail->AuthType = 'XOAUTH2';

  $provider = new Google(
    [
      'clientId' => CLIENT_ID,
      'clientSecret' => CLIENT_SECRET,
    ]
  );

  $mail->setOAuth(
    new OAuth(
      [
        'provider' => $provider,
        'clientId' => CLIENT_ID,
        'clientSecret' => CLIENT_SECRET,
        'refreshToken' => REFRESH_TOKEN,
        'userName' => EMAIL,
      ]
    )
  );

  $mail->setFrom(EMAIL, 'site title');
  $mail->addAddress($data["mail"], $data["name"]);
  $mailBody = "
    お名前: {$data['name']}
    メールアドレス: {$data['mail']}
    お問い合わせ内容: {$data['content']}
  ";
  $mail->Subject = 'お問い合わせありがとうございます。';

  $mail->CharSet = PHPMailer::CHARSET_UTF8;
  $mail->Body = $mailBody;

  if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    header("Location: ./thanks.php");
    exit;
  }
}