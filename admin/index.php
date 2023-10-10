<?php
include 'header.php';

include '../model/pdo.php';
$action = $_GET['action'] ?? 'home';
switch ($action) {
    case 'listComment':
    {
        $commends = query("SELECT shoes.name,shoes.id AS shoes_id, COUNT(comments.id) AS count_bl, DATE(MAX(comments.create_at)) AS latest, MIN(DATE(comments.create_at)) AS oldest
        FROM comments
        JOIN shoes ON shoes.id=comments.shoe_id
        GROUP BY shoes.id")->fetchAll();
        include 'comment/listComment.php';
        break;
    }
    case 'listCommentDetail':{
        $shoeId=$_GET['shoe_id']??'';
        $comments=query("SELECT comments.id, comments.content, users.username,DATE(comments.create_at) AS create_at,comments.shoe_id
        FROM comments
        JOIN users ON comments.user_id=users.id
        WHERE comments.shoe_id=".$shoeId)->fetchAll();
        include 'comment/listCommentDetail.php';
        break;
    }
    case 'listShoe':
    {
        $shoes = getAll('shoes', null, null);
        $brands = getAll('brands', null, null);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sql = "";
            $like = "";
            if ($_POST['brand_id']) {
                if ($_POST['name']) {
                    $like = "AND name LIKE '%${_POST['name']}%'";
                }
                $sql = "WHERE brand_id = ${_POST['brand_id']} ${like}";
                $shoes = getAll('shoes', null, null, "$sql");
            } else {
                if ($_POST['name']) {
                    $sql = "WHERE name LIKE '%${_POST['name']}%'";
                }
                $shoes = getAll('shoes', null, null, "$sql");
            }
        }
        include 'shoe/list.php';
        break;
    }
    case 'listBrand':
    {
        $brands = getAll('brands', null, null);
        include 'brand/list.php';
        break;
    }
    case 'listUser':
    {
        $users = getAll('users', null, null);
        include 'user/list.php';
        break;
    }

    case 'addShoe':
    {
        $brands = getAll('brands', null, null);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $image_file = $_FILES['image'];
            $targets = [];
            for ($i = 0; $i < count($image_file['name']); $i++) {
                $targets[count($targets)] = "./public/images/shoes/" . $image_file['name'][$i];
                move_uploaded_file($image_file['tmp_name'][$i], $targets[$i]);
            }
            $targets = implode(",", $targets);
            if (addData('shoes', [
                    'name' => $_POST['name'],
                    'sizes' => $_POST['sizes'],
                    'price' => $_POST['price'],
                    'image' => $targets,
                    'brand_id' => $_POST['brand_id'],
                ]) > 0) {
                echo "<script>alert('Thêm thành công');
                    window.location='./index.php?action=listShoe';
                </script>";
            }
        }
        include 'shoe/add.php';
        break;
    }
    case 'addBrand':
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $image_file = $_FILES['image'];
            $target = "./public/images/brands/" . $image_file['name'];
            move_uploaded_file($image_file['tmp_name'], $target);
            if (addData('brands', [
                    'name' => $_POST['name'],
                    'image' => $target
                ]) > 0) {
                echo "<script>alert('Thêm thành công');
                    window.location='./index.php?action=listBrand';
                </script>";
            }
        }
        include 'brand/add.php';
        break;
    }
    case 'addUser':
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            addData('users', [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'role' => $_POST['role']
            ]);
        }
        include 'user/add.php';
        break;
    }
    case 'addComment';{
        $shoes=getAll('shoes',null,null);
        $users=getAll('users',null,null);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            addData('comments',$_POST);
        }
        include 'comment/add.php';
        break;
    }

    case 'editShoe':
    {
        $brands = getAll('brands', null, null);
        $shoe = getDataBy('shoes', [
            'id' => $_GET['id']
        ]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $image_file = $_FILES['image'];
            $targets = $shoe['image'];

            if ($image_file['name'][0] != '') {
                $targets = [];
                for ($i = 0; $i < count($image_file['name']); $i++) {
                    $targets[count($targets)] = "./public/images/shoes/" . $image_file['name'][$i];
                    move_uploaded_file($image_file['tmp_name'][$i], $targets[$i]);
                }
                $targets = implode(",", $targets);
            }
            if (updateData('shoes', [
                    'name' => $_POST['name'],
                    'sizes' => $_POST['sizes'],
                    'price' => $_POST['price'],
                    'image' => $targets,
                    'brand_id' => $_POST['brand_id'],
                ], $_GET['id']) > 0) {
                echo "<script>alert('sửa thành công');
                    window.location='./index.php?action=listShoe';
                </script>";
            } else {
                echo "<script>
                    if(confirm('Chưa thay đổi gì xác nhân rời đi')){
                        window.location='./index.php?action=listShoe';
                    }
                </script>";
            }
        }
        include "shoe/edit.php";
        break;
    }
    case 'editBrand':
    {
        $brand = getDataBy('brands', [
            'id' => $_GET['id']
        ]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $image_file = $_FILES['image'];
            $target = $brand['image'];
            if ($image_file['name'] != '') {
                $target = "./public/images/brands/" . $image_file['name'];
                move_uploaded_file($image_file['tmp_name'], $target);
            }
            if (updateData('brands', [
                    'name' => $_POST['name'],
                    'image' => $target,
                ], $_GET['id']) > 0) {
                echo "<script>alert('sửa thành công');
                    window.location='./index.php?action=listBrand';
                </script>";
            } else {
                echo "<script>
                    if(confirm('Chưa thay đổi gì xác nhân rời đi')){
                        window.location='./index.php?action=listBrand';
                    }
                </script>";
            }
        }
        include "brand/edit.php";
        break;
    }
    case 'editUser':
    {
        $user = getDataBy('users', [
            'id' => $_GET['id']
        ]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (updateData('users', [
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'address' => $_POST['address'],
                    'role' => $_POST['role']
                ], $_GET['id']) > 0) {
                echo "<script>alert('sửa thành công');
                    window.location='./index.php?action=listUser';
                </script>";
            } else {
                echo "<script>
                    if(confirm('Chưa thay đổi gì xác nhân rời đi')){
                        window.location='./index.php?action=listUser';
                    }
                </script>";
            }
        }
        include "user/edit.php";
        break;
    }
    case 'editComment':{
        $id=$_GET['id']??'';
        $comment=getDataBy('comments',[
           'id'=>$id,
        ]);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (updateData('comments', [
                    'content' => $_POST['content'],
                ], $_GET['id']) > 0) {
                echo "<script>alert('sửa thành công');
                    window.location='./index.php?action=listComment';
                </script>";
            } else {
                echo "<script>
                    if(confirm('Chưa thay đổi gì xác nhân rời đi')){
                        window.location='./index.php?action=listComment';
                    }
                </script>";
            }
        }
        include 'comment/edit.php';
        break;
    }

    case 'deleteShoe':
    {
        if (isset($_GET['id'])) {
            if (deleteData('shoes', $_GET['id']) > 0) {
                echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=listShoe';
                </script>";
            } else {
                echo "<script>alert('Không tìm thấy hàng để xóa');
                    window.location='./index.php?action=listShoe';
                </script>";
            }
        }
        break;
    }
    case 'deleteBrand':
    {
        if (isset($_GET['id'])) {
            if (deleteData('brands', $_GET['id']) > 0) {
                echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=listBrand';
                </script>";
            } else {
                echo "<script>alert('Không tìm thấy hàng để xóa');
                    window.location='./index.php?action=listBrand';
                </script>";
            }
        }
        break;
    }
    case 'deleteUser':
    {
        if (isset($_GET['id'])) {
            if (deleteData('users', $_GET['id']) > 0) {
                echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=listUser';
                </script>";
            } else {
                echo "<script>alert('Không tìm thấy hàng để xóa');
                    window.location='./index.php?action=listUser';
                </script>";
            }
        }
        break;
    }
    case 'deleteComment':
    {
        if (isset($_GET['id'])) {
            if (deleteData('comments', $_GET['id']) > 0) {
                echo "<script>alert('Xóa thành công');
                    window.location='./index.php?action=listComment';
                </script>";
            } else {
                echo "<script>alert('Không tìm thấy hàng để xóa');
                    window.location='./index.php?action=listComment';
                </script>";
            }
        }
        break;
    }


    case 'thongKe':
    {
        $list = statistical();
        include 'thongKe/list.php';
        break;
    }
    case 'pieChart':
    {
        $list = statistical();
        include 'thongKe/pieChart.php';
        break;
    }


    case 'home':
    {
        include 'home.php';
        break;
    }
}
include 'footer.php';