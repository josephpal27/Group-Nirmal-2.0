<?php
include 'db.php';
$message = "";

// Fetch categories
$categories = mysqli_query($conn, "SELECT id, name FROM blog_categories ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $title = trim($_POST['title']);
    $category_id = (int)$_POST['category_id'];
    $content = trim($_POST['content']);
    $meta_title = trim($_POST['meta_title']);
    $meta_description = trim($_POST['meta_description']);
    $meta_keywords = trim($_POST['meta_keywords']);
    $article_schema = trim($_POST['article_schema']);
    $slug_input = trim($_POST['slug']);

    // Generate slug
    $slug_base = !empty($slug_input) ? $slug_input : $title;
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug_base), '-'));

    // Check required fields
    if (!empty($title) && $category_id > 0 && !empty($content) && isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/blogs/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Prepare and execute insert query using prepared statements
            $stmt = $conn->prepare("INSERT INTO blogs (title, slug, image, category_id, content, meta_title, meta_description, meta_keywords, article_schema) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssisssss", $title, $slug, $image_name, $category_id, $content, $meta_title, $meta_description, $meta_keywords, $article_schema);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Blog added successfully.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Database error: Unable to add blog.</div>";
            }

            $stmt->close();
        } else {
            $message = "<div class='alert alert-danger'>Error uploading image.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Please fill all required fields and upload an image.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($pageDesc); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Blog</h2>
    <?php echo $message; ?>
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Blog Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Custom Slug (optional)</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter custom slug or leave blank">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">-- Select Category --</option>
                <?php while ($cat = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Blog Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="2" placeholder="Enter meta description"></textarea>
        </div>

        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="keyword1, keyword2, keyword3">
        </div>

        <div class="mb-3">
            <label for="article_schema" class="form-label">Article Schema (JSON-LD)</label>
            <textarea class="form-control" id="article_schema" name="article_schema" rows="4" placeholder='Paste schema here'></textarea>
        </div>

        <!-- Text Editor Toolbar -->
        <div class="mb-2">
            <button type="button" onclick="format('bold')"><b>B</b></button>
            <button type="button" onclick="format('italic')"><i>I</i></button>
            <button type="button" onclick="format('underline')"><u>U</u></button>
            <button type="button" onclick="format('insertOrderedList')">1.</button>
            <button type="button" onclick="format('insertUnorderedList')">•</button>
            <button type="button" onclick="format('formatBlock', 'h1')">H1</button>
            <button type="button" onclick="format('formatBlock', 'h2')">H2</button>
            <button type="button" onclick="format('formatBlock', 'h3')">H3</button>
            <button type="button" onclick="format('formatBlock', 'h4')">H4</button>
             <button type="button" onclick="format('formatBlock', 'h5')">H5</button>
            <button type="button" onclick="format('formatBlock', 'h6')">H6</button>
           <select onchange="format('fontSize', this.value)"> <option value="">Size</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> <option value="6">6</option> <option value="7">7</option> </select>
 <!-- Font color -->
            <input type="color" onchange="format('foreColor', this.value)" title="Text Color">
        </div>
        <!-- Rich Text Area -->
        <div id="editor" contenteditable="true" style="border:1px solid #ccc; padding:10px; min-height:200px;"></div>
        <textarea name="content" id="content" style="display:none;"></textarea>

        <button type="submit" class="btn btn-primary mt-3">Add Blog</button>
        <a href="dashboard.php?page=blogs" class="btn btn-secondary mt-3">Back</a>

    </form>
</div>

<script>
  function format(command, value = null) {
    document.execCommand(command, false, value);
  }

  document.querySelector('form').addEventListener('submit', function () {
    const editor = document.getElementById('editor');
    const plainText = editor.innerText || editor.textContent;

    // Optional: Limit preview to 300 characters with ...
    const preview = plainText.length > 1000 ? plainText.substring(0, 1000) + '...' : plainText;

    document.getElementById('content').value = preview;
});
</script>
</body>
</html>
