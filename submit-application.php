<?php
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
    
    $recipient = "mdsalim400@gmail.com";
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
    
    header("Location: pages/book-now-thank-you.php");
    exit;
} else {
    header("Location: pages/career.php");
    exit;
}
?>
