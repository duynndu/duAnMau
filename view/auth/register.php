<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự án mẫu</title>
    <link rel="stylesheet" href="css/css.css">
    <script src="https://kit.fontawesome.com/509cc166d7.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- <style>
      form li a{

      }
    </style> -->
</head>
<body>
<div class="boxcenter">
    <main class="catalog  mb ">

        <div class="boxleft">

            <div class="box_title">Đăng ký thành viên</div>
            <div class="box_content form_account">
                <form class="register-form" action="./index.php?action=register" method="post">
                    <div>
                        <p>Email</p>
                        <input type="email" name="email" placeholder="email">
                    </div>
                    <div>
                        <p>Tên đăng nhập</p>
                        <input type="text" name="username" placeholder="user">
                    </div>
                    <div>
                        <p>Mật khẩu</p>
                        <input type="password" name="password" placeholder="pass">
                    </div>
                    <button>Đăng kí</button>
                    <input type="reset" value="Nhập lại">
                </form>
            </div>

        </div>
        <?php include './view/box_right.php' ?>

    </main>
    <!-- BANNER 2 -->
</div>
<script src="main.js">

</script>
</body>
</html>