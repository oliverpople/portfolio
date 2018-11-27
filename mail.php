<?php
  require 'vendor/autoload.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = strip_tags(trim($_POST["con_name"]));
  $name = str_replace(array("\r","\n"),array(" "," "),$name);
  $email = filter_var(trim($_POST["con_email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["con_message"]);

  $from = new SendGrid\Email(null, $email);
  $subject = "Portfolio Site email from $name";
  $to = new SendGrid\Email(null, "oliverpople@gmail.com");
  $content = new SendGrid\Content("text/plain",  $message);
  $mail = new SendGrid\Mail($from, $subject, $to, $content);

  $apiKey = getenv('SENDGRID_API_KEY');
  $sg = new \SendGrid($apiKey);

  $response = $sg->client->mail()->send()->post($mail);
  echo $response->statusCode();
  echo $response->headers();
  echo $response->body();
  echo "Thank You! Your message has been sent.";

} else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
