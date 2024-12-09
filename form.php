<?php

// Import the PHPMailer class to handle email functionalities.
use PHPMailer\PHPMailer\PHPMailer;
// Import the Exception class to handle errors thrown by PHPMailer.
use PHPMailer\PHPMailer\Exception;

// Includes Composer's autoloader to manage dependencies
require 'vendor/autoload.php';

/**
 * Class SendEmail.
 *
 * Handles sending emails using PHPMailer.
 */
class SendEmail
{
  /**
   * The recipient email address.
   *
   * @var string
   */
  public $email;
  /**
   * The PHPMailer instance.
   *
   * @var PHPMailer
   */
  public $mail;

  /**
   * Constructor.
   *
   * Initializes the email and PHPMailer instance.
   */
  public function __construct()
  {
    // Create an instance of PHPMailer
    $this->email = $_POST['email'];
    $this->mail = new PHPMailer(true);
  }

  /**
   * Configure server settings and send email.
   */
  public function server_settings()
  {
    try {
      $this->mail->isSMTP(); // Send using SMTP
      $this->mail->Host       = 'smtp.gmail.com'; // Set the SMTP server
      $this->mail->SMTPAuth   = true; // Enable SMTP authentication
      $this->mail->Username   = 'example@example.com'; // SMTP username
      $this->mail->Password   = 'bbbb dfdf edfd ddds'; // SMTP password
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
      $this->mail->Port       = 587; // TCP port to connect to (usually 587 for TLS)

      // Recipients
      $this->mail->setFrom('example@example.com', 'Example'); // Sender's email address
      $this->mail->addAddress($this->email); // Recipient's email

      // Content
      $this->mail->isHTML(true); // Set email format to HTML
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
    $email = new SendEmail();
    $email->server_settings();
  } else {
    echo "<p>Provide An Email.</p>";
  }
}
