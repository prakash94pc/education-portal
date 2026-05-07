<?php include '../config/database.php';
if(!isAdmin()) header("Location: login.php");

$courses = $conn->query("SELECT c.*, cat.name as category_name FROM courses c LEFT JOIN categories cat ON c.category_id=cat.id ORDER BY c.id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Manage Courses</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<div class="admin-container">
    <h1>Manage Courses</h1>
    <a href="add-course.php" class="btn-primary">+ Add New Course</a>
    <a href="dashboard.php" class="btn-secondary">← Back to Dashboard</a>
    
    <table class="admin-table">
        <tr>
            <th>ID</th><th>Image</th><th>Title</th><th>Category</th><th>Price</th><th>Duration</th><th>Action</th>
        </tr>
        <?php while($row = $courses->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><img src="../uploads/<?php echo $row['image']; ?>" width="50" height="50" style="object-fit:cover"></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['category_name']; ?></td>
            <td>₹<?php echo $row['price']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td>
                <a href="edit-course.php?id=<?php echo $row['id']; ?>">✏️ Edit</a> |
                <a href="delete-course.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this course?')">🗑️ Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>