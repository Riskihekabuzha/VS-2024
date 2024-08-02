<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $order->customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
        $order->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
        $order->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $order->order_date = isset($_POST['order_date']) ? $_POST['order_date'] : '';
        $order->create();
        header("Location: order.php");
        exit();
    }

    if (isset($_POST['update'])) {
        $order->order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
        $order->customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
        $order->product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
        $order->quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $order->order_date = isset($_POST['order_date']) ? $_POST['order_date'] : '';
        $order->update();
        header("Location: order.php");
        exit();
    }

    if (isset($_POST['delete'])) {
        $order->order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
        $order->delete();
        header("Location: order.php");
        exit();
    }
}

$stmt = $order->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Orders</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="order.php" method="post">
            <input type="hidden" name="order_id" value="">
            <input type="number" name="customer_id" placeholder="Customer ID">
            <input type="number" name="product_id" placeholder="Product ID">
            <input type="number" name="quantity" placeholder="Quantity">
            <input type="datetime-local" name="order_date" placeholder="Order Date">
            <button type="submit" name="create">Create</button>
        </form>
        <h2>Order List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo isset($row['customer_id']) ? $row['customer_id'] : ''; ?></td>
                    <td><?php echo isset($row['product_id']) ? $row['product_id'] : ''; ?></td>
                    <td><?php echo isset($row['quantity']) ? $row['quantity'] : ''; ?></td>
                    <td><?php echo isset($row['order_date']) ? $row['order_date'] : ''; ?></td>
                    <td>
                     <form action="order.php" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                     <a href="update_order.php?order_id=<?php echo $row['order_id']; ?>">Update</a>
                     <button type="submit" name="delete">Delete</button>
              </form>
        </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
