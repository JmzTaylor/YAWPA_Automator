<?php
/* Copyright (C) 2017  James Taylor (jmztaylor)

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA */

require 'includes/PHPMailerAutoload.php';
require 'config.php';
if (!empty($_GET) && $_GET['user'] == "") {
  $mail = new PHPMailer; // Enable verbose debug output
  $mail->isSMTP(); // Set mailer to use SMTP
  $mail->Host       = $smtpURL; // Specify main and backup SMTP servers
  $mail->SMTPAuth   = true; // Enable SMTP authentication
  $mail->Username   = $smtpUser; // SMTP username
  $mail->Password   = $smtpPass; // SMTP password
  $mail->SMTPSecure = $smtpSecure; // Enable TLS encryption, `ssl` also accepted
  $mail->Port       = $smtpPort; // TCP port to connect to
  $mail->setFrom($mailTo, $_GET['name']); // Name is optional
  $mail->addReplyTo($_GET['email'], $_GET['name']);
  $mail->addAddress($mailTo);
  $mail->isHTML(true); // Set email format to HTML
  $mail->Subject = 'YAWPA Automator';
  $mail->Body    = $_GET['message'];
  if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
    echo 'Message has been sent';
  }
} else {
  echo "It Failed";
}
?>