<?php
// This is from submit to send contenct to email
$name = $_POST['name'];
$email_address = $_POST['email_address'];
$subject = $_POST['subject'];
$message = $_POST['message'];
// Create the email and send the message
// This script processes a contact form submission and sends an email with the provided information.
// It retrieves the name, email address, subject, and message from the POST request,
// validates and sanitizes the input, and then sends an email to a specified address.
// The email is sent using the PHP mail function, and appropriate headers are set to ensure the email is formatted correctly.
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die('Invalid request method.');
}
// Check if the required fields are set
if (!isset($name) || !isset($email_address) || !isset($subject) || !isset($message)) {
    die('Required fields are missing.');
}
// Trim whitespace from the input fields
$name = trim($name);
$email_address = trim($email_address);
$subject = trim($subject);
$message = trim($message);
// Check if the input fields are empty
if (empty($name) || empty($email_address) || empty($subject) || empty($message)) {
    die('Please fill in all fields.');
}
// Check if the email address is valid
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address.');
}
// Validate input
if (empty($name) || empty($email_address) || empty($subject) || empty($message)) {
    die('Please fill in all fields.');
}
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address.');
}
// Sanitize input
$name = filter_email_header($name);
$subject = filter_email_header($subject);
$message = filter_email_header($message);
// Sanitize email address
// This function removes any unwanted characters from the email address
// to prevent header injection attacks.
// It is important to sanitize the email address before using it in the headers.
// This is a simple example, you may want to use a more robust sanitization method.
function filter_email_header($email) {
    // Remove any unwanted characters from the email address
    return preg_replace('/[^\w\.-@]/', '', $email);
}
// Sanitize the email address
$email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
// Check if the email address is valid after sanitization
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address after sanitization.');
}
// Sanitize the email address again to ensure it is safe for use in headers 
// This is to prevent header injection attacks
// and to ensure that the email address is safe to use in the headers.
// This function removes any unwanted characters from the email address
// to prevent header injection attacks.
// It is important to sanitize the email address before using it in the headers.
// This is a simple example, you may want to use a more robust sanitization method.
$email_address = filter_email_header($email_address);



#Send email
$headers = "From: $name <$email_address>\r\n" .
           "Reply-To: $email_address\r\n" .
           "X-Mailer: PHP/" . phpversion();
// The headers are set to include the name and email address of the sender
// and to set the reply-to address to the email address of the sender.
// The X-Mailer header is set to the PHP version to indicate that the email was sent using PHP.
// The email is sent to the specified email address with the subject and message.

$sent = mail('abhishek1997sh@gmail.com', 'Contact Form Submission', 
    "Name: $name\n" .
    "Email: $email_addressn\n" .
    "Subject: $subject\n" .
    "Message:\n$message", $headers);
// The mail function is used to send the email.
// The first parameter is the recipient email address,
// the second parameter is the subject of the email,
// the third parameter is the message body, and the fourth parameter is the headers.
// The message body includes the name, email address, subject, and message.
// Check if the email was sent successfully

//Thank user or notify them of a problem
if ($sent) {

?><html>
<head>
<title>Thank You</title>
</head>
<body>
<h1>Thank You</h1>
<p>Thank you for your feedback.</p>
</body>
</html>
<?php

} else {

?><html>
<head>
<title>Something went wrong</title>
</head>
<body>
<h1>Something went wrong</h1>
<p>We could not send your feedback. Please try again.</p>
</body>
</html>
<?php
}


?>