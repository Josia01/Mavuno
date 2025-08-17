<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: contact.html?status=error');
        exit;
    }
    
    // Recipient email (change this to your actual email)
    $to = "info@mavunotrade.org";
    
    // Email subject
    $email_subject = "New Contact Form Submission: $subject";
    
    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Send email
    if (mail($to, $email_subject, $email_content, $headers)) {
        // Success - redirect with success message
        header('Location: contact.html?status=success');
    } else {
        // Failed - redirect with error message
        header('Location: contact.html?status=error');
    }
    exit;
} else {
    // Not a POST request - redirect to contact page
    header('Location: contact.html');
    exit;
}
?>