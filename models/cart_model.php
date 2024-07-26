<?php
/**
 * Đức: Hàm lấy tất cả các sản phẩm tương ứng với mỗi giỏ hàng, và khách hàng
 */
function lay_tat_ca_san_pham_trong_cart_item($user_id) {
    $sql = "
        select cart_item.product_id, quantity, price_sale from cart_item
        inner join product 
        on cart_item.product_id = product.product_id
        where user_id = $user_id;
    ";
    return lay_nhieu_hang($sql);
}

// Lấy danh sách sản phẩm trong giỏ hàng của một user
function get_cart_items($user_id) {
    global $conn;
    $sql = "SELECT product.name, product.price_sale, cart_item.quantity, cart_item.product_id FROM cart_item INNER JOIN product ON cart_item.product_id = product.product_id WHERE cart_item.user_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (PDOException $e) {
        throw $e;
    }
}

// Thêm một sản phẩm vào giỏ hàng
function add_to_cart($user_id, $product_id, $quantity) {
    global $conn;

    // Kiểm tra xem sản phẩm có tồn tại không
    $product_exists = check_product_exists($product_id);

    if ($product_exists) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $existing_product = get_cart_item($user_id, $product_id);

        if ($existing_product) {
            // Nếu đã tồn tại, cập nhật số lượng
            $new_quantity = $existing_product['quantity'] + $quantity;
            update_cart_item_quantity($user_id, $product_id, $new_quantity);
        } else {
            // Nếu chưa tồn tại, thêm mới vào giỏ hàng
            $sql = "INSERT INTO cart_item (user_id, product_id, quantity) VALUES (?, ?, ?)";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute([$user_id, $product_id, $quantity]);
            } catch (PDOException $e) {
                throw $e;
            }
        }
    } else {
        // Sản phẩm không tồn tại, có thể thực hiện các xử lý khác tùy vào yêu cầu
        throw new Exception("Sản phẩm không tồn tại.");
    }
}

// Kiểm tra sản phẩm có tồn tại không
function check_product_exists($product_id) {
    global $conn;
    $sql = "SELECT * FROM product WHERE product_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? true : false;
    } catch (PDOException $e) {
        throw $e;
    }
}

// Xóa một sản phẩm khỏi giỏ hàng
function remove_from_cart($user_id, $product_id) {
    global $conn;
    $sql = "DELETE FROM cart_item WHERE user_id = ? AND product_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id, $product_id]);
    } catch (PDOException $e) {
        throw $e;
    }
}

// Cập nhật số lượng của sản phẩm trong giỏ hàng
function update_cart_item_quantity($user_id, $product_id, $quantity) {
    global $conn;
    $sql = "UPDATE cart_item SET quantity = ? WHERE user_id = ? AND product_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$quantity, $user_id, $product_id]);
    } catch (PDOException $e) {
        throw $e;
    }
}

// Xóa hết giỏ hàng của một user
function clear_cart($user_id) {
    global $conn;
    $sql = "DELETE FROM cart_item WHERE user_id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
    } catch (PDOException $e) {
        throw $e;
    }
}
?>
