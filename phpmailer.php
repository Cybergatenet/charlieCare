<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require './vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //Set the hostname of the mail server
    $mailer->Host = 'tls://smtp.gmail.com';
    // $mail->Host = 'smtp.gmail.com';
    $mailer->SMTPSecure = 'tls';
    // $mail->Port = 465;
    $mailer->SMTPAuth = true;
    $mailer->Port = 587;

    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'abelchinedu2@gmail.com';

    //Password to use for SMTP authentication
    $mail->Password = 'abchej3647';

    //Set who the message is to be sent from
    $mail->setFrom('from@example.com', 'First Last');

    //Set an alternative reply-to address
    $mail->addReplyTo('replyto@example.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress('cybergatenet@yahoo.com');

    $mail->Subject = 'PHPMailer GMail SMTP test';

    $mail->msgHTML(true);
    $mail->Body    = 'This is the <b>HTML</b> message body <b>in bold!</b>';
    $mail->AltBody = 'This is a plain-text message body for test';
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
    function save_mail($mail)
    {
        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

        $imapStream = imap_open($path, $mail->Username, $mail->Password);

        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);

        return $result;
    }
?>