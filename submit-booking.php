<?php
function get_env_var($key, $default = '') {
    $env_file = __DIR__ . '/.env';
    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                if (trim($name) == $key) {
                    return trim($value);
                }
            }
        }
    }
    return $default;
}

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
    
    // 1. Send Email Notification
    $recipient = get_env_var('RECIPIENT_EMAIL', 'mdsalim400@gmail.com');
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
    
    // 2. Trigger Webhook API
    $webhook_url = get_env_var('BOOKING_WEBHOOK_URL');
    if (!empty($webhook_url) && filter_var($webhook_url, FILTER_VALIDATE_URL)) {
        $payload = json_encode([
            'event' => 'new_booking',
            'timestamp' => date('c'),
            'data' => [
                'name' => $name,
                'phone' => $phone,
                'alternate_phone' => $alternate_phone,
                'email' => $email,
                'service' => $service,
                'urgency' => $urgency,
                'referrer' => $referrer,
                'message' => $message
            ]
        ]);
        
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);
        curl_exec($ch);
        curl_close($ch);
    }
    
    header("Location: pages/book-now-thank-you.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>
