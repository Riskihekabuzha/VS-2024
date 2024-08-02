<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $order->order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
    $order->customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
    $order->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $order->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $order->order_date = isset($_POST['order_date']) ? $_POST['order_date'] : '';
    $order->update();
    header("Location: order.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $order->order_id = $_GET['order_id'];
    $order_data = $order->readOne();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Update Order</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="update_order.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo isset($order_data['order_id']) ? $order_data['order_id'] : ''; ?>">
            <input type="number" name="customer_id" placeholder="Customer ID" value="<?php echo isset($order_data['customer_id']) ? $order_data['customer_id'] : ''; ?>">
            <input type="number" name="product_id" placeholder="Product ID" value="<?php echo isset($order_data['product_id']) ? $order_data['product_id'] : ''; ?>">
            <input type="number" name="quantity" placeholder="Quantity" value="<?php echo isset($order_data['quantity']) ? $order_data['quantity'] : ''; ?>">
            <input type="datetime-local" name="order_date" placeholder="Order Date" value="<?php echo isset($order_data['order_date']) ? date('Y-m-d\TH:i', strtotime($order_data['order_date'])) : ''; ?>">
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
