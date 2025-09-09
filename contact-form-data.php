<?php

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.html");
    exit();
}

include 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secretKey = "6LchbJ0rAAAAABAEvM3HdRIlljqv32hpE0-oBxoJ"; // Replace with your real secret key
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    // Verify with Google
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$responseKey}&remoteip={$userIP}";
    $response = file_get_contents($verifyURL);
    $responseData = json_decode($response);

    if ($responseData->success) {
        // CAPTCHA successful — sanitize and insert data
        $name         = mysqli_real_escape_string($conn, trim($_POST['name']));
        $email        = mysqli_real_escape_string($conn, trim($_POST['email']));
        $company_name = mysqli_real_escape_string($conn, trim($_POST['company_name']));
        $phone_number = mysqli_real_escape_string($conn, trim($_POST['phone_number']));
        $message      = mysqli_real_escape_string($conn, trim($_POST['message']));
        $created_at   = date("Y-m-d H:i:s");

        $insert = "INSERT INTO contact_form (name, email, company_name, phone_number, message, created_at)
                   VALUES ('$name', '$email', '$company_name', '$phone_number', '$message', '$created_at')";

        if (mysqli_query($conn, $insert)) {
            echo "Message submitted successfully!";
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "reCAPTCHA verification failed. Please try again.";
    }
}

// Fetch contact form submissions (for admin view)
$query = "SELECT name, email, company_name, phone_number, message, created_at FROM contact_form ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      border-radius: 0.75rem;
    }

    .card-title {
      font-weight: 600;
      font-size: 1.2rem;
      color: #3a3a3a;
    }

    .table thead th {
      background-color: #f6f6f8;
      font-weight: 600;
      color: #3a3a3a;
    }

    .table td {
      color: #6c757d;
      vertical-align: middle;
    }

    .message-cell {
      max-width: 300px;
      white-space: pre-wrap;
      word-wrap: break-word;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Contact Form Data</h5>
        <div class="table-responsive">
          <table class="table table-borderless align-middle">
            <thead>
              <tr>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>COMPANY NAME</th>
                <th>PHONE NUMBER</th>
                <th>SUBMITTED ON</th>
                <th>MESSAGE</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                    <td><?= htmlspecialchars($row['phone_number']) ?></td>
                    <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                    <td class="message-cell"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center text-muted">No data available.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
