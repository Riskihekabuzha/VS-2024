<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $customer->customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
    $customer->name = isset($_POST['name']) ? $_POST['name'] : '';
    $customer->email = isset($_POST['email']) ? $_POST['email'] : '';
    $customer->phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $customer->update();
    header("Location: customer.php");
    exit();
}

if (isset($_GET['customer_id'])) {
    $customer->customer_id = $_GET['customer_id'];
    $customer_data = $customer->readOne();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Customer</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Update Customer</h1>
    <form action="update_customer.php" method="post">
        <input type="hidden" name="customer_id" value="<?php echo isset($customer_data['customer_id']) ? $customer_data['customer_id'] : ''; ?>">
        <input type="text" name="name" placeholder="Name" value="<?php echo isset($customer_data['name']) ? $customer_data['name'] : ''; ?>">
        <input type="email" name="email" placeholder="Email" value="<?php echo isset($customer_data['email']) ? $customer_data['email'] : ''; ?>">
        <input type="text" name="phone" placeholder="Phone" value="<?php echo isset($customer_data['phone']) ? $customer_data['phone'] : ''; ?>">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
