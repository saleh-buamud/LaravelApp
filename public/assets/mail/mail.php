<?php
// Basic validation
if (!isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    http_response_code(400);
    echo "Invalid request";
    exit;
}

$name = htmlspecialchars($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = htmlspecialchars($_POST['subject']);
$phone = htmlspecialchars($_POST['phone'] ?? '');
$message = htmlspecialchars($_POST['message']);

$email_message = "
Name: $name
Subject: $subject
Email: $email
Phone: $phone
Message:
$message
";

// Send mail
mail("example@gmail.com", "New Contact Message", $email_message);

// Redirect
header("Location: ../../mail-success.html");
exit;
?>