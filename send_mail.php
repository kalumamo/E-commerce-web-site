<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
Include 'C:\xampp\htdocs\shopping\PHPMailer\src\Exception.php';
Include 'C:\xampp\htdocs\shopping\PHPMailer\src\PHPMailer.php';
Include 'C:\xampp\htdocs\shopping\PHPMailer\src\SMTP.php';

// Insert admin message into order_history table
$adminMessage = "Your custom admin message here."; // Change this to the actual message
$orderId = 123; // Replace with the actual order ID
// Create a new PHPMailer instance
$mail = new PHPMailer();

// Enable SMTP debugging (optional)
$mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to SMTP::DEBUG_SERVER for detailed debugging

// Set the mailer to use SMTP
$mail->isSMTP();

// Specify the SMTP server
$mail->Host = 'smtp.gmail.com'; // Change this to your SMTP server

// Enable SMTP authentication
$mail->SMTPAuth = true;

// SMTP username (your Gmail email address)
$mail->Username = 'AbdiAbate223@gmail.com';

// SMTP password (your Gmail password)
$mail->Password = 'sixf dbhv hqxz hujo';

// Enable TLS encryption
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// TCP port to connect to (use 587 for TLS)
$mail->Port = 587;

// Set the sender's email address
$mail->setFrom('AbdiAbate223@gmail.com', 'Kalu'); // Replace with your details

// Set the recipient's email address
$mail->addAddress('kalumamo2011ec@gmail.com'); // Replace with the customer's email address

// Set the email subject and message
$mail->Subject = 'Order History';
$mail->Body    = 'Dear Customer, Thank you for your recent order. Here is a summary of your order history: please track your order id
If you have any questions, feel free to contact us
With 
1.+251......09
2.Email:your@gmail.com

. Best regards, 
HULU BAND Supper market';


// Send the email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error sending email. Please check your configuration.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>
