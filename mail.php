<?php

    $filenameee =  $_FILES['file']['name'];
    $fileName = $_FILES['file']['tmp_name']; 
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sub = $_POST['sub'];
    $cars = $_POST['cars'];
    $usermessage = $_POST['message'];
    
    $message ="Name = ". $name . "\r\n  Email = " . $email . "\r\n Subject = " . $sub . "\r\n Select = " . $cars . "\r\n Message = " . $usermessage;
    
    $subject ="My email subject";
    $fromname ="Client";
    $fromemail = 'asikalazadsovon@gmail.com';  //if u dont have an email create one on your cpanel

    $mailto = 'asikalazadsovon@gmail.com';  //the email which u want to recv this email




    $content = file_get_contents($fileName);
    $content = chunk_split(base64_encode($content));

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: ".$fromname." <".$fromemail.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filenameee . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    //SEND Mail
    if (mail($mailto, $subject, $body, $headers)) {
        echo "Thanks, Send Your Message Success"; // do what you want after sending the email
        
        
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }