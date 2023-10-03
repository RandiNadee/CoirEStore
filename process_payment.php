<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_id = $_POST['c_id'];
    $u_id = $_SESSION['uid'];
    if (!empty($c_id)) {
        process_order($u_id, $c_id);
    } else {
        header("location:cart.php");
        exit();
    }
}

function process_order($user_id, $cart_id)
{
    include_once("database.php");
    $sql = "SELECT p_id, qty FROM cart WHERE user_id = '$user_id'";
    $query = mysqli_query($con, $sql);
    $p_st = "Inprogress";
    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_array($query)) {
            $product_id[] = $row["p_id"];
            $qty[] = $row["qty"];
        }

        for ($i = 0; $i < count($product_id); $i++) {
            $sql = "INSERT INTO orders (user_id,product_id,qty,p_status,order_date) VALUES ('$user_id','" . $product_id[$i] . "','" . $qty[$i] . "','$p_st', CURDATE())";
            mysqli_query($con, $sql);
        }

        $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
        if (mysqli_query($con, $sql)) {
            header("location:customer_order.php");
            exit();
        }
    } else {
        header("location:cart.php");
        exit();
    }
}
?>