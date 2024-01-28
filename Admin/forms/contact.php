<?php
require_once "include/classes/meekrodb.2.3.class.php";
require 'db_config.php';

if (isset($_POST['send-msg'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  echo("jello");
  die();

  // Insert query using MeekroDB
  $inserted = DB::insert('contact_messages', [
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message
  ]);

  if ($inserted) {
    header("Location: ../contact.php");
  }
}
?>