<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Retrieve the data sent from JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Extract event details
$date = date('F j, Y', strtotime($data['date']));
$startTime = date('h:i A', strtotime($data['start_time'])); 
$activity = $data['activity'];
$location = $data['location'];
$selectedEmails = $data['selected_emails'];

// Extract attachment data
$attachmentData = base64_decode($data['attachment_data']); // Decode Base64 encoded attachment data
$attachmentName = $data['attachment_name']; // Retrieve attachment name

// Initialize PHPMailer
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'scheduler.website@gmail.com';
$mail->Password = 'ctmrabmbuxjnmsso';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('scheduler.website@gmail.com');

$mail->isHTML(true);

// Loop through selected emails and send invitation with attachment
foreach ($selectedEmails as $email) {
    try {
        // Add recipient
        $mail->addAddress($email);

        // Set email content
        $mail->Subject = 'Invitation to Event';
        $mail->Body = "Dear Participants <br> I hope this message finds you well. It is with great pleasure that I extend to you a formal invitation to attend $activity.<br><br> Here is the details: <br> Date: $date at $startTime <br>  \n\nActivity:  $activity <br> \nLocation: $location";

        // Add attachment
        if (!empty($attachmentData)) {
            $mail->addStringAttachment($attachmentData, $attachmentName);
        }

        // Send email
        $mail->send();

        // Clear attachments for the next email
        $mail->clearAttachments();
    } catch (Exception $e) {
        // Handle errors, if any
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    // Clear recipients for the next email
    $mail->clearAddresses();
}

// Return a plain text response
echo 'Invitations sent successfully';
?>
