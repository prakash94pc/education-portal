<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$categories = $conn->query("SELECT * FROM categories");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'];
    $duration = $_POST['duration'];
    $category_id = $_POST['category_id'];
    $level = $_POST['level'];
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    
    $conn->query("INSERT INTO courses (title, description, price, original_price, image, duration, category_id, level) 
                  VALUES ('$title', '$description', $price, $original_price, '$image', '$duration', $category_id, '$level')");
    
    header("Location: manage-courses.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Course</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="form-container">
    <h2>Add New Course</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Course Title" required>
        <textarea name="description" rows="5" placeholder="Course Description" required></textarea>
        <input type="number" name="price" placeholder="Price (₹)" required>
        <input type="number" name="original_price" placeholder="Original Price (₹)" required>
        <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <select name="level" required>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="expert">Expert</option>
        </select>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" class="btn-primary">Add Course</button>
    </form>
</div>
</body>
</html>