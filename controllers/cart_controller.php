<?php
require_once "../models/cart_model.php";
require_once "../models/pdo.php";

// Add to cart controller
function add_to_cart_controller($user_id, $product_id, $quantity) {
    try {
        add_to_cart($user_id, $product_id, $quantity);
        echo "Added to cart successfully.";
    } catch (PDOException $e) {
        echo "Error adding to cart: " . $e->getMessage();
    }
}

// Show cart controller
function show_cart($user_id) {
    global $conn;
    try {
        $cart_items = get_cart_items($user_id, $conn);
        // Display cart items
        foreach ($cart_items as $item) {
            echo "Product: " . $item['name'] . ", Price: " . $item['price_sale'] . ", Quantity: " . $item['quantity'] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error fetching cart items: " . $e->getMessage();
    }
}

// Remove from cart controller
function remove_from_cart_controller($user_id, $product_id) {
    global $conn;
    try {
        remove_from_cart($user_id, $product_id, $conn);
        echo "Removed from cart successfully.";
    } catch (PDOException $e) {
        echo "Error removing from cart: " . $e->getMessage();
    }
}

// Clear cart controller
function clear_cart_controller($user_id) {
    global $conn;
    try {
        clear_cart($user_id, $conn);
        echo "Cart cleared successfully.";
    } catch (PDOException $e) {
        echo "Error clearing cart: " . $e->getMessage();
    }
}

// // Call the controller functions
// $user_id = 2; // Example user ID
// $product_id = '2'; // Example product ID
// $quantity = '2'; // Example quantity

add_to_cart_controller($user_id, $product_id, $quantity);
show_cart($user_id);
// remove_from_cart_controller($user_id, $product_id);
// clear_cart_controller($user_id);

// Xử lý xóa hết giỏ hàng
if (isset($_POST['clear_cart'])) {
    $user_id = $_SESSION['user_id'];
    clear_cart($user_id);
    // echo "Đã xóa hết sản phẩm khỏi giỏ hàng!";
    header("Location: ../index.php?page=cart");
    exit();
}

?>
