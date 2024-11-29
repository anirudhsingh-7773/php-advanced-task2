<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class sendEmail
{
  public $email;
  public $mail;

  public function __construct()
  {
    // Create an instance of PHPMailer
    $this->email = $_POST['email'];
    $this->mail = new PHPMailer(true);
  }

  public function serverSettings()
  {
    try {
      $this->mail->isSMTP();                                            // Send using SMTP
      $this->mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through (e.g., SMTP server address)
      $this->mail->SMTPAuth   = true;                                     // Enable SMTP authentication
      $this->mail->Username   = 'example@example.com';                 // SMTP username (your email address)
      $this->mail->Password   = 'bbbb dfdf edfd ddds';                          // SMTP password (your email password or app password)
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           // Enable TLS encryption
      $this->mail->Port       = 587;                                      // TCP port to connect to (usually 587 for TLS)

      // Recipients
      $this->mail->setFrom('example@example.com', 'Example');  // Sender's email address
      $this->mail->addAddress($this->email);                                    // Add the recipient (the user’s email)

      // Content
      $this->mail->isHTML(true);                                          // Set email format to HTML
      $this->mail->Subject = 'Thank You Mail!';
      $this->mail->Body    = '<h1>Thank you for your submission.</p>';
      $this->mail->AltBody = 'Thank you for your submission.';

      // Send the email
      if ($this->mail->send()) {
        echo '<p>Welcome email has been sent to ' . htmlspecialchars($this->email) . '</p>';
      } else {
        echo '<p>Error sending email.</p>';
      }
    } catch (Exception $e) {
      echo "<p>Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}.</p>";
    }
  }
}

// Check if the form is submitted and email is provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['email'])) {
    $email = new sendEmail();
    $email->serverSettings();
  } else {
    echo "<p>Provide An Email.</p>";
  }
}
