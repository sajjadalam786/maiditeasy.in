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
    $age = strip_tags(trim($_POST["age"]));
    $gender = strip_tags(trim($_POST["gender"]));
    $role = strip_tags(trim($_POST["role"]));
    $experience = strip_tags(trim($_POST["experience"]));
    $salary = strip_tags(trim($_POST["salary"]));
    $work_type = strip_tags(trim($_POST["work_type"]));
    $location = strip_tags(trim($_POST["location"]));
    $message = strip_tags(trim($_POST["message"]));
    
    if (empty($name) || empty($phone) || empty($role) || empty($location)) {
        header("Location: pages/career.php");
        exit;
    }
    
    // 1. Send Email Notification
    $recipient = get_env_var('RECIPIENT_EMAIL', 'mdsalim400@gmail.com');
    $subject = "New Job Application: $role - $name";
    
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Alternate Phone: $alternate_phone\n";
    $email_content .= "Age: $age\n";
    $email_content .= "Gender: $gender\n";
    $email_content .= "Role Applied For: $role\n";
    $email_content .= "Experience: $experience\n";
    $email_content .= "Expected Salary: $salary\n";
    $email_content .= "Work Type Preference: $work_type\n";
    $email_content .= "Preferred Work Location: $location\n\n";
    $email_content .= "Work History/Remarks:\n$message\n";
    
    $email_headers = "From: Maid It Easy Careers <no-reply@maiditeasy.in>";
    mail($recipient, $subject, $email_content, $email_headers);
    
    // 2. Trigger Webhook API
    $webhook_url = get_env_var('APPLICATION_WEBHOOK_URL');
    if (!empty($webhook_url) && filter_var($webhook_url, FILTER_VALIDATE_URL)) {
        $payload = json_encode([
            'event' => 'new_application',
            'timestamp' => date('c'),
            'data' => [
                'name' => $name,
                'phone' => $phone,
                'alternate_phone' => $alternate_phone,
                'age' => $age,
                'gender' => $gender,
                'role' => $role,
                'experience' => $experience,
                'salary' => $salary,
                'work_type' => $work_type,
                'location' => $location,
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
    header("Location: pages/career.php");
    exit;
}
?>
