<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$id = $_GET['id'];
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();
$categories = $conn->query("SELECT * FROM categories");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $original_price = $_POST['original_price'];
    $duration = $_POST['duration'];
    $category_id = $_POST['category_id'];
    $level = $_POST['level'];
    
    if($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $conn->query("UPDATE courses SET image='$image' WHERE id=$id");
    }
    
    $conn->query("UPDATE courses SET 
        title='$title', description='$description', price=$price, 
        original_price=$original_price, duration='$duration', 
        category_id=$category_id, level='$level' WHERE id=$id");
    
    header("Location: manage-courses.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Course</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="form-container">
    <h2>Edit Course</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo $course['title']; ?>" required>
        <textarea name="description" rows="5" required><?php echo $course['description']; ?></textarea>
        <input type="number" name="price" value="<?php echo $course['price']; ?>" required>
        <input type="number" name="original_price" value="<?php echo $course['original_price']; ?>" required>
        <input type="text" name="duration" value="<?php echo $course['duration']; ?>" required>
        <select name="category_id" required>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id']==$course['category_id']?'selected':''; ?>>
                    <?php echo $cat['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <select name="level" required>
            <option value="beginner" <?php echo $course['level']=='beginner'?'selected':''; ?>>Beginner</option>
            <option value="intermediate" <?php echo $course['level']=='intermediate'?'selected':''; ?>>Intermediate</option>
            <option value="expert" <?php echo $course['level']=='expert'?'selected':''; ?>>Expert</option>
        </select>
        <input type="file" name="image" accept="image/*">
        <p>Current Image: <img src="../uploads/<?php echo $course['image']; ?>" width="100"></p>
        <button type="submit" class="btn-primary">Update Course</button>
    </form>
</div>
</body>
</html>