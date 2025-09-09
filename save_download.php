<?php
include 'db.php';

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed."]));
}

// Get POST data
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$phone   = $_POST['phone'] ?? '';
$product = $_POST['product'] ?? '';
$file    = $_POST['file'] ?? 'brochure.pdf'; // default file

// Validate email
if(empty($email)){
    echo json_encode(["status" => "error", "message" => "Email is required."]);
    exit;
}

// Check if captcha was filled
$token  = $_POST['g-recaptcha-response'] ?? '';
if(empty($token)){
    echo json_encode(["status" => "error", "message" => "Please verify the CAPTCHA to proceed."]);
    exit;
}

// Verify reCAPTCHA with Google
$secret = '6LchbJ0rAAAAABAEvM3HdRIlljqv32hpE0-oBxoJ';
$remoteip = $_SERVER['REMOTE_ADDR'];

$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$token}&remoteip={$remoteip}");
$response = json_decode($verify);

if(!$response->success){
    echo json_encode(["status" => "error", "message" => "CAPTCHA verification failed."]);
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO downloads (name, email, phone, product, file_path) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $product, $file);

if($stmt->execute()){
    echo json_encode([
        "status" => "success",
        "message" => "Thank you! Your download will start shortly...",
        "file" => $file
    ]);
}else{
    echo json_encode(["status" => "error", "message" => "Database insert failed."]);
}

$stmt->close();
$conn->close();
?>
