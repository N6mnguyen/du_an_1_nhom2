<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['productId']) && isset($_POST['action'])) {
        $productId = $_POST['productId'];
        $action = $_POST['action'];

        if ($action === 'increase') {
            increaseQuantity($productId);
        } elseif ($action === 'decrease') {
            decreaseQuantity($productId);
        }
    }
}

function increaseQuantity($productId) {
    if (isset($_SESSION['giohang'][$productId]['soluong'])) {
        $_SESSION['giohang'][$productId]['soluong']++;
        echo json_encode(['success' => true, 'quantity' => $_SESSION['giohang'][$productId]['soluong']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }
}

function decreaseQuantity($productId) {
    if (isset($_SESSION['giohang'][$productId]['soluong']) && $_SESSION['giohang'][$productId]['soluong'] > 1) {
        $_SESSION['giohang'][$productId]['soluong']--;
        echo json_encode(['success' => true, 'quantity' => $_SESSION['giohang'][$productId]['soluong']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Quantity cannot be less than 1']);
    }
}
?>
