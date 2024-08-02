<?php
// Include file koneksi dan fungsi-fungsi yang dibutuhkan
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

// Proses form jika disubmit untuk create, update, atau delete
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Jika form create disubmit
    if (isset($_POST['create'])) {
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->create();
        // Redirect atau refresh halaman setelah create berhasil
        header("Location: product.php");
        exit();
    }

    // Jika form update disubmit
    if (isset($_POST['update'])) {
        $product->product_id = $_POST['product_id'];
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->update();
        // Redirect atau refresh halaman setelah update berhasil
        header("Location: product.php");
        exit();
    }

    // Jika form delete disubmit
    if (isset($_POST['delete'])) {
        $product->product_id = $_POST['product_id'];
        $product->delete();
        // Redirect atau refresh halaman setelah delete berhasil
        header("Location: product.php");
        exit();
    }
}

// Ambil data dari database untuk ditampilkan
$stmt = $product->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Products</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="product.php" method="post">
            <input type="hidden" name="product_id" value="">
            <input type="text" name="name" placeholder="Name">
            <textarea name="description" placeholder="Description"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price">
            <button type="submit" name="create">Create</button>

        </form>
        <h2>Product List</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td>
    <form action="product.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <a href="update_product.php?product_id=<?php echo $row['product_id']; ?>" class="update-link">Update</a>
        <button type="submit" name="delete">Delete</button>
    </form>
</td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
