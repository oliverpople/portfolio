<?php
require 'vendor/autoload.php';

$email = filter_var(trim($_POST["con_email"]), FILTER_SANITIZE_EMAIL);
$message = trim($_POST["con_message"]);

      $from = new SendGrid\Email(null, $email);
      $subject = "Hello World from the SendGrid PHP Library!";
      $to = new SendGrid\Email(null, "oliverpople@gmail.com");
      $content = new SendGrid\Content("text/plain",  $message);
      $mail = new SendGrid\Mail($from, $subject, $to, $content);

      $apiKey = getenv('SENDGRID_API_KEY');
      $sg = new \SendGrid($apiKey);

      $response = $sg->client->mail()->send()->post($mail);
      echo $response->statusCode();
      echo $response->headers();
      echo $response->body();

    // Only process POST reqeusts.
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //
        // // Get the form fields and remove whitespace.
        //
        // $name = strip_tags(trim($_POST["con_name"]));
        // $name = str_replace(array("\r","\n"),array(" "," "),$name);
        // $email = filter_var(trim($_POST["con_email"]), FILTER_SANITIZE_EMAIL);
        // $message = trim($_POST["con_message"]);
        //
        // // Check that data was sent to the mailer.
        // if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     // Set a 400 (bad request) response code and exit.
        //     http_response_code(400);
        //     echo "Please complete the form and try again.";
        //     exit;
        // }
        //
        // // Set the recipient email address.
        // // FIXME: Update this to your desired email address.
        // $recipient = "oliverpople@gmail.com";
        //
        // // Set the email subject.
        // $subject = "New contact from $name";
        //
        // // Build the email content.
        // $email_content = "Name: $name\n";
        // $email_content .= "Email: $email\n\n";
        // $email_content .= "Subject: $subject\n\n";
        // $email_content .= "Message:\n$message\n";
        //
        // // Build the email headers.
        // $email_headers = "From: $name <$email>";
        //
        // // Send the email.
        // if (mail($recipient, $subject, $email_content, $email_headers)) {
        //     // Set a 200 (okay) response code.
        //     http_response_code(200);
        //     echo "Thank You! Your message has been sent.";
    //     } else {
    //         // Set a 500 (internal server error) response code.
    //         http_response_code(500);
    //         echo "Oops! Something went wrong and we couldn't send your message.";
    //     }
    //
    // } else {
    //     // Not a POST request, set a 403 (forbidden) response code.
    //     http_response_code(403);
    //     echo "There was a problem with your submission, please try again.";
    // }

?>
