<?php

include 'db.php';

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all downloads
$result = $conn->query("SELECT * FROM downloads ORDER BY download_time DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Download Records</title>
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

    .file-cell {
      max-width: 250px;
      word-wrap: break-word;
      white-space: pre-wrap;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Download Records</h5>
        <div class="table-responsive">
          <table class="table table-borderless align-middle">
            <thead>
              <tr>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PHONE</th>
                <th>INTERESTED PRODUCTS</th>
                <th>DOWNLOADED ON</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['product']) ?></td>
                    <td><?= date("d M Y H:i", strtotime($row['download_time'])) ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center text-muted">No downloads yet.</td>
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

<?php $conn->close(); ?>