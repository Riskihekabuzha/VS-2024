<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $product->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product->name = isset($_POST['name']) ? $_POST['name'] : '';
    $product->description = isset($_POST['description']) ? $_POST['description'] : '';
    $product->price = isset($_POST['price']) ? $_POST['price'] : '';
    $product->update();
    header("Location: product.php");
    exit();
}

if (isset($_GET['product_id'])) {
    $product->product_id = $_GET['product_id'];
    $product_data = $product->readOne();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Update Product</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="update_product.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo isset($product_data['product_id']) ? $product_data['product_id'] : ''; ?>">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($product_data['name']) ? $product_data['name'] : ''; ?>">
            <input type="text" name="description" placeholder="Description" value="<?php echo isset($product_data['description']) ? $product_data['description'] : ''; ?>">
            <input type="number" step="0.01" name="price" placeholder="Price" value="<?php echo isset($product_data['price']) ? $product_data['price'] : ''; ?>">
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
