<?php
include_once 'includes/db.php';
include_once 'includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $customer->name = isset($_POST['name']) ? $_POST['name'] : '';
        $customer->email = isset($_POST['email']) ? $_POST['email'] : '';
        $customer->phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $customer->create();
        header("Location: customer.php");
        exit();
    }

    if (isset($_POST['delete'])) {
        $customer->customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
        $customer->delete();
        header("Location: customer.php");
        exit();
    }
}

$stmt = $customer->read();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Customers</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Customers</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="customer.php" method="post">
            <input type="hidden" name="customer_id" value="">
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone">
            <button type="submit" name="create">Create</button>
        </form>
        <h2>Customer List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo isset($row['name']) ? $row['name'] : ''; ?></td>
                    <td><?php echo isset($row['email']) ? $row['email'] : ''; ?></td>
                    <td><?php echo isset($row['phone']) ? $row['phone'] : ''; ?></td>
                    <td>
                        <form action="update_customer.php" method="get">
                            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="customer.php" method="post" style="display:inline;">
                            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
