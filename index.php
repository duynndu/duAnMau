<?php
session_start();
$userID = $_COOKIE['id'] ?? $_SESSION['id'] ?? 0;
include 'model/pdo.php';
include 'view/header.php';
if (!isset($_COOKIE['guest_id'])) {
    $guestID = bin2hex(random_bytes(16));
    setcookie('guest_id', $guestID, time() + 86400 * 30);
} else {
    $guestID = $_COOKIE['guest_id'];
}
$shoes = getAll('shoes', null, null);
$brands = getAll('brands', null, null);
$topShoes = getAll('shoes', ['view DESC'], 10);
$user = getDataBy('users', [
    'id' => $userID
]);

$action = $_GET['action'] ?? 'home';
switch ($action) {
    case 'shoeDetail':
    {
        $ShoesByBrandId = getDataBy('shoes', ['id' => $_GET['shoe_id']]);
        $splq=getAll('shoes',null,null,"WHERE brand_id=".$ShoesByBrandId['brand_id']);
        $comments = getAllDataBy(
            "comments",
            ['comments.*', 'users.username'],
            "JOIN users ON comments.user_id=users.id",
            "WHERE comments.shoe_id='" . $_GET['shoe_id'] . "'", ['create_at']);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['content']) && ($_POST['content'])) {
                addData('comments', [
                    'user_id' => $user['id'],
                    'shoe_id' => $_GET['shoe_id'],
                    'content' => $_POST['content']
                ]);
                header("location:" . $_SERVER['REQUEST_URI']);
            }
            if (isset($_POST['quantity']) && ($_POST['quantity']) && ($_POST['size'])) {
                if ($user) {
                    $defined = getDataBy('cart', [
                        'shoe_id' => $_GET['shoe_id'],
                        'user_id' => $user['id'],
                        'size' => $_POST['size']
                    ]);
                    if ($defined) {
                        updateData('cart', [
                            'quantity' => $defined['quantity'] + $_POST['quantity']
                        ], $defined['id']);
                    } else {
                        addData('cart', [
                            'user_id' => $user['id'],
                            'shoe_id' => $_GET['shoe_id'],
                            'quantity' => $_POST['quantity'],
                            'size' => $_POST['size']
                        ]);
                    }
//                    header("location:".$_SERVER['REQUEST_URI']);
                } else {
                    $_SESSION['carts'] = $_SESSION['carts'] ?? [];
                    $_SESSION['carts'][count($_SESSION['carts'])] = [
                        'guest' => session_id(),
                        'shoe_id' => $_GET['shoe_id'],
                        'image' => $ShoesByBrandId['image'],
                        'name' => $ShoesByBrandId['name'],
                        'price' => $ShoesByBrandId['price'],
                        'quantity' => $_POST['quantity'],
                        'size' => $_POST['size']
                    ];

                    echo 'chưa login';
                }
            }
        }
        include 'view/shoeDetail.php';
        break;
    }
    case 'home':
    {
        $_GET['brand_id'] = $_GET['brand_id'] ?? 0;
        $sql = '';
        if (isset($_GET['brand_id'])) {
            $sql = "";
            $like = "";
            if ($_GET['brand_id']) {
                if (isset($_POST['name'])) {
                    if ($_POST['name']) {
                        $like = "AND name LIKE '%${_POST['name']}%'";
                    }
                }
                $sql = "WHERE brand_id = ${_GET['brand_id']} ${like}";
                $shoes = getAll('shoes', null, null, "$sql");
            } else {
                if (isset($_POST['name'])) {
                    if ($_POST['name']) {
                        $sql = "WHERE name LIKE '%${_POST['name']}%'";
                    }
                }
                $shoes = getAll('shoes', null, null, "$sql");
            }

        }
        include 'view/home.php';
        break;
    }
    case 'register':
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (addData('users', $_POST) > 0) {
                echo "<script>
                    alert('Đăng kí tài khoản thành công');
                </script>";
            }
        }
        include 'view/auth/register.php';
        break;
    }
    case 'login':
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $saveLogin = isset($_POST['saveLogin']);
            $user = getDataBy('users', [
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ]);
            if ($user) {
                $_SESSION['id'] = $user['id'];
                if ($saveLogin) {
                    setcookie('id', $user['id'], time() + 100);
                }
                echo "<script>
                    alert('Đăng nhập thành công');
                    window.location='./index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Tài khoản không tồn tại');
                    window.location='" . $_SERVER['HTTP_REFERER'] . "';  
                </script>";
            }
        }
        break;
    }
    case 'logout':
    {
        unset($_SESSION['id']);
        setcookie('id', '', time() - 3600);
        header('Location: index.php');
        break;
    }
    case 'cart':
    {
        include './view/cart.php';
    }
    case 'update_cart':
    {
        if (isset($_POST['quantity']) && ($_POST['quantity'])) {
            if ($user) {
                updateData('cart', [
                    'quantity' => $_POST['quantity']
                ], $_POST['cart_id']);
                header("location:./index.php?action=cart");
            } else {
                print_r($_POST);
                $_SESSION['carts'][$_POST['cart_id']]['quantity'] = $_POST['quantity'];
                header("location:./index.php?action=cart");
            }
        }
        break;
    }
    case 'delete_cart':
    {
        if (isset($_GET['id']) && ($_GET['id'])) {
            if ($user) {
                if (deleteData('cart', $_GET['id']) > 0) {
                    echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=cart';
                </script>";
                } else {
                    echo "<script>alert('Không tìm thấy hàng để xóa');
                    window.location='./index.php?action=cart';
                </script>";
                }
            } else {
                print_r($_GET);
                array_splice($_SESSION['carts'], $_GET['id'], 1);
                echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=cart';
                </script>";
            }
        }
        break;
    }
    //đặt hàng
    case 'order':
    {
        if (isset($_POST['cart_ids']) && strlen($_POST['cart_ids']) > 0) {
            if ($user) {
                $order_id = addDataReturnId('orders', [
                    'user_id' => $user['id'],
                    'receiver_name' => $_POST['receiver_name'],
                    'receiver_phone' => $_POST['receiver_phone'],
                    'receiver_address' => $_POST['receiver_address']
                ]);
                $cart_ids = explode(',', $_POST['cart_ids']);
                print_r($cart_ids);
                foreach ($cart_ids as $cart_id) {
                    $cart = getDataBy('cart', [
                        'id' => $cart_id
                    ]);
                    addData('order_details', [
                        'order_id' => $order_id,
                        'shoe_id' => $cart['shoe_id'],
                        'quantity' => $cart['quantity'],
                        'size' => $cart['size'],
                    ]);
                }
            } else {
                $order_id = addDataReturnId('orders', [
                    'guest_id' => $_COOKIE['guest_id'],
                    'receiver_name' => $_POST['receiver_name'],
                    'receiver_phone' => $_POST['receiver_phone'],
                    'receiver_address' => $_POST['receiver_address']
                ]);
                $cart_ids = explode(',', $_POST['cart_ids']);
                foreach ($cart_ids as $cart_id) {
                    addData('order_details', [
                        'order_id' => $order_id,
                        'shoe_id' => $_SESSION['carts'][$cart_id]['shoe_id'],
                        'quantity' => $_SESSION['carts'][$cart_id]['quantity'],
                        'size' => $_SESSION['carts'][$cart_id]['size'],
                    ]);
                }
//                echo session_id();
            }
        } else {
            //chưa chọn đơn hàng nào để mua
            header('location:./index.php?action=cart');
        }
        break;
    }
    case 'listOrder':
    {
        if ($user) {
            $listOrder = getAllDataBy('order_details',
                ['*', 'orders.id AS order_id', 'order_details.id AS od_id', 'shoes.id AS shoe_id'],
                "JOIN orders
                ON orders.id=order_details.order_id
                JOIN shoes ON order_details.shoe_id=shoes.id",
                "WHERE orders.user_id=" . $user['id'],
                ['order_details.id']
            );
        }else{
            $listOrder = getAllDataBy('order_details',
                ['*', 'orders.id AS order_id', 'order_details.id AS od_id', 'shoes.id AS shoe_id'],
                "JOIN orders
                ON orders.id=order_details.order_id
                JOIN shoes ON order_details.shoe_id=shoes.id",
                "WHERE orders.guest_id='".$_COOKIE['guest_id']."'",
                ['order_details.id']
            );
        }

        include './view/listOrder.php';
        break;
    }
    case 'updateAcc':{
        if($_SERVER['REQUEST_METHOD']=="POST"){
            print_r($_POST);
            updateData('users',$_POST,$userID);
            header('location:'.$_SERVER['REQUEST_URI']);
        }
        include 'view/auth/updateAcc.php';
        break;
    }
    case 'forgotPassword':{
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $equal=getDataBy('users',[
                'email'=>$_POST['email']
            ]);
            if($equal){
                echo '<script>alert("Mật khẩu của bạn là '.$equal['password'].'")</script>';
            }else{
                echo '<script>alert("không tìm thấy")</script>';
            }
        }
        include 'view/auth/forgotPassword.php';
        break;
    }
}
include 'view/footer.php';
?>