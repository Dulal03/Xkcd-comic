<?php

/**
 * Generate a 6-digit numeric verification code.
 */
function generateVerificationCode(): string {
    // TODO: Implement this function
    $randomNumber = random_int(100000, 999999);
    return (string) $randomNumber;
}

/**
 * Send a verification code to an email.
 */
function sendVerificationEmail(string $email, string $code): bool {
    // TODO: Implement this function
    $to = $email;
    $subject = "Your Verification Code";
    $message = "<html><p>Your verification code is: <strong>$code</strong></p></html>";
    $headers = "From: no-reply@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    if (mail($to, $subject, $message,$headers)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Register an email by storing it in a file.
 */
function registerEmail(string $email): bool {
  $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
    $emails = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
      if (!in_array($email, $emails)) {
          file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
          return TRUE;

      }else{
          return FALSE;
      }

}

/**
 * Unsubscribe an email by removing it from the list.
 */
function unsubscribeEmail(string $email): bool {
    $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
    $content = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (in_array($email, $content)) {
        $emails = array_diff($content, [$email]); 
        file_put_contents($file, implode(PHP_EOL, $emails) . PHP_EOL);
        return true;
    } else {
        return false;
    }
}

/**
 * Fetch random XKCD comic and format data as HTML.
 */
function fetchAndFormatXKCDData(): string {
    // TODO: Implement this function
    $ver = file_get_contents("https://xkcd.com/".rand(1,3000)."/info.0.json");
    $ver1 =(array) json_decode($ver);
    return "<h2>XKCD Comic</h2><img src=".$ver1['img']." alt='XKCD Comic'><p><a href='localhost\htdocs\Rt_campus\xkcd-Dulal03\src\unsubscribe.php' id='unsubscribe-button'>Unsubscribe</a></p>";
}

/**
 * Send the formatted XKCD updates to registered emails.
 */
function sendXKCDUpdatesToSubscribers(): void {
  $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
     $var = fetchAndFormatXKCDData();
    if (file_exists($file)){
    $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $subject = "XKCD comic";
    $headers = "From: no-reply@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    foreach ($emails as $email) {
        mail($email, $subject, $var, $headers);
       }
  }
}
