<?php

require_once('database.php');

$orders = $_SESSION['orders'];
$pay_method = $_SESSION['paymethod'];
$amount = $_SESSION['total'];

foreach ($orders as $order){
    print_r($order);
    $order_sql = "SELECT * FROM CART WHERE id='$order'";
    $order_result = mysqli_query($connect, $order_sql);
    $order_value = mysqli_fetch_assoc($order_result);

    $pattern_name = $order_value['pattern_name'];
    $pattern_image = $order_value['pattern_image'];
    $order_date = date("Y-m-d");
    $order_details = "Fabric: " . $order_value['fabric_name'].";"
        . "\nPattern Size: " . $order_value['pattern_size'].";"
        . "\nCostume Type: " . $order_value['costume_type'].";"
        . "\nBody Size: " . $order_value['body_size'].";"
        . "\nCostume Color: " . $order_value['costume_color'].";"
        . "\nQuantity: " . $order_value['quantitiy'];
    $pay_status = "Not Paid";

    $sql = "INSERT INTO orders (order_num, user_email, pattern_name,pattern_image, order_details,order_date,amount,pay_method,transaction_id,transaction_number,pay_status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmtinsert = $connect->prepare($sql);
    if ($stmtinsert) {
        $result = $stmtinsert->execute([$order_num,$email,$pattern_name,$pattern_image,$order_details,$order_date,$amount,$pay_method,$transID,$transNum,$pay_status]);

        if($result){
            $sql_remove = "DELETE FROM cart WHERE id='$order'";
            $remove_result = mysqli_query($connect, $sql_remove);
            unset($_SESSION['orders']);
            unset($_SESSION['paymethod']);
            unset($_SESSION['total']);
            unset($_SESSION['subtotal']);
            unset($_SESSION['ship']);
        }
    }

}
