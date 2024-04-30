<?php
function orderItemsTableExist($conn)
{
  $stmt = $conn->prepare("SHOW TABLES LIKE 'order_items'");
  $stmt->execute();

  if ($stmt->rowCount() == 0) {
    $createTableSQL = "
          CREATE TABLE order_items (
              id INT AUTO_INCREMENT PRIMARY KEY,
              quantity INT NOT NULL,
              price DECIMAL(10, 2) NOT NULL,
              order_id INT NOT NULL,
              product_id INT NOT NULL,
              FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
              FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
          )
      ";
    $stmt = $conn->prepare($createTableSQL);
    $stmt->execute();
    echo "Table 'order_items' created successfully.";
  } else {
    echo "Table 'order_items' already exists.";
  }
}

function ordersTableExist($conn){
  $stmt = $conn->prepare("SHOW TABLES LIKE 'orders'");
  $stmt->execute();

  if ($stmt->rowCount() == 0) {
    $createTableSQL = "
      CREATE TABLE orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        total_amount DECIMAL(10, 2) NOT NULL,
        notes VARCHAR(255),
        status VARCHAR(20) NOT NULL,
        date DATETIME NOT NULL,
        total_quantity INT NOT NULL,
        room_id INT NOT NULL,
        user_id INT NOT NULL,
        FOREIGN KEY (room_id) REFERENCES rooms(id),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $stmt = $conn->prepare($createTableSQL);
    $stmt->execute();
  } else {
    echo "Table 'orders' already exists.";
  }
}
