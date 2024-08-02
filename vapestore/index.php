<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vape Store</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Vape Store Management</h1>
    </header>
    <nav>
        <ul>
            <li><a href="customer.php">Manage Customers</a></li>
            <li><a href="product.php">Manage Products</a></li>
            <li><a href="order.php">Manage Orders</a></li>
        </ul>
    </nav>
    <section class="hero">
    </section>
    <footer>
        <p>&copy; 2024 Vape Store. All rights reserved.</p>
        <p>Manage your customers, products, and orders efficiently with our system.</p>
    </footer>
</body>
</html>
