<?php
class Customer {
    private $conn;
    private $table_name = "customers";

    public $customer_id;
    public $name;
    public $email;
    public $phone;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method read
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, phone=:phone";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method delete
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->customer_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, phone = :phone WHERE customer_id = :customer_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":customer_id", $this->customer_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method readOne
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE customer_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));

        // bind id of record to read
        $stmt->bindParam(1, $this->customer_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];

        return $row;
    }
}


class Product {
    private $conn;
    private $table_name = "products";

    public $product_id;
    public $name;
    public $description;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method read
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, price=:price";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method delete
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->product_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, price = :price WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":product_id", $this->product_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method readOne
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));

        // bind id of record to read
        $stmt->bindParam(1, $this->product_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->price = $row['price'];

        return $row;
    }
}


class Order {
    private $conn;
    private $table_name = "orders";

    public $order_id;
    public $customer_id;
    public $product_id;
    public $quantity;
    public $order_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method read
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Method create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET customer_id=:customer_id, product_id=:product_id, quantity=:quantity, order_date=:order_date";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->order_date = htmlspecialchars(strip_tags($this->order_date));

        // bind values
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":order_date", $this->order_date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method delete
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->order_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET customer_id = :customer_id, product_id = :product_id, quantity = :quantity, order_date = :order_date WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->order_date = htmlspecialchars(strip_tags($this->order_date));
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));

        // bind values
        $stmt->bindParam(":customer_id", $this->customer_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":order_date", $this->order_date);
        $stmt->bindParam(":order_id", $this->order_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Method readOne
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));

        // bind id of record to read
        $stmt->bindParam(1, $this->order_id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->customer_id = $row['customer_id'];
        $this->product_id = $row['product_id'];
        $this->quantity = $row['quantity'];
        $this->order_date = $row['order_date'];

        return $row;
    }
}

?>
