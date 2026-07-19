<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $alternate_phone = strip_tags(trim($_POST["alternate_phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $service = strip_tags(trim($_POST["service"]));
    $urgency = strip_tags(trim($_POST["urgency"]));
    $referrer = strip_tags(trim($_POST["referrer"]));
    $message = strip_tags(trim($_POST["message"]));
    
    if (empty($name) || empty($phone) || empty($email) || empty($service)) {
        header("Location: index.php");
        exit;
    }
    
    $recipient = "mdsalim400@gmail.com";
    $subject = "New Maid It Easy Booking Request from $name";
    
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Alternate Phone: $alternate_phone\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Service: $service\n";
    $email_content .= "Urgency: $urgency\n";
    $email_content .= "How did they hear: $referrer\n\n";
    $email_content .= "Message/Remarks:\n$message\n";
    
    $email_headers = "From: Maid It Easy Booking <no-reply@maiditeasy.in>";
    
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Redirect to thank you page
    header("Location: pages/book-now-thank-you.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
