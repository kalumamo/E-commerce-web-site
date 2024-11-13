
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
include 'C:\xampp\htdocs\shopping\PHPMailer\src\Exception.php';
include 'C:\xampp\htdocs\shopping\PHPMailer\src\PHPMailer.php';
include 'C:\xampp\htdocs\shopping\PHPMailer\src\SMTP.php';


// Email address of the customer
$email = "kalumamo2011ec@gmail.com"; // Replace with the actual email address

// SQL query to fetch customer ID based on email
$sql_customer = "
    SELECT id
    FROM customers
    WHERE email = ?
";

// Prepare and execute the statement to fetch customer ID
$stmt_customer = $conn->prepare($sql_customer);
if (!$stmt_customer) {
    die("Error in preparing statement: " . $conn->error);
}
$stmt_customer->bind_param("s", $email);
$stmt_customer->execute();
$result_customer = $stmt_customer->get_result();

// Fetch customer ID
$customer_id = null;
if ($row_customer = $result_customer->fetch_assoc()) {
    $customer_id = $row_customer['id'];
}

// Check if customer exists
if (!$customer_id) {
    die("Customer with email $email not found.");
}

// SQL query to fetch order history for the customer
$sql_query = "
    SELECT orderId, postingDate, remark
    FROM ordertrackhistory
    WHERE customerId = ?
    ORDER BY postingDate DESC
";

// Prepare and execute the statement to fetch order history
$stmt = $conn->prepare($sql_query);
if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

// Construct order history message
$orderHistoryMessage = "Dear Customer,\n\nThank you for your recent orders. Here is a summary of your order history:\n\n";
while ($order = $result->fetch_assoc()) {
    $orderHistoryMessage .= "Order ID: " . $order['orderId'] . "\n";
    $orderHistoryMessage .= "Posting Date: " . $order['postingDate'] . "\n";
    $orderHistoryMessage .= "Remark: " . $order['remark'] . "\n\n";
}

// Close the statement and connection
$stmt_customer->close();
$stmt->close();

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
$mail->addAddress($email); // Replace with the customer's email address

// Set the email subject and message
$mail->Subject = 'Order History';
$mail->Body = $orderHistoryMessage;

// Send the email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error sending email. Please check your configuration.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>
``
