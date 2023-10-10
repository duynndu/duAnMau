<div class="boxright">

    <div class="mb">
        <div class="box_title">TÀI KHOẢN</div>
        <div class="box_content form_account">
            <a href="index.php?action=cart">Giỏ hàng của bạn</a><br>
            <a href="index.php?action=listOrder">Đơn hàng của bạn</a><br>
            <?php if($userID){?>
                <?php if($user['role']){?>
                    <a href="./admin/index.php">Vào trang Admin</a> <br>
                <?php }?>
                <a href="index.php?action=logout">Đăng xuất</a>
            <?php }else{ ?>
            <form action="index.php?action=login" method="post">
                <h4>Tên đăng nhập</h4><br>
                <input type="text" name="username" id="">
                <h4>Mật khẩu</h4><br>
                <input type="password" name="password" id=""><br>
                <input type="checkbox" name="saveLogin" id="">Ghi nhớ tài khoản?
                <br>
                <button>Đăng nhập</button>
                <li class="form_li"><a href="#">Quên mật khẩu</a></li>
                <li class="form_li"><a href="index.php?action=register">Đăng kí thành viên</a></li>
            </form>
            <?php }?>
        </div>
    </div>
    <div class="mb">
        <div class="box_title">Thương hiệu</div>
        <div class="box_content2 product_portfolio">
            <ul>
                <li><a href="index.php">Tất cả</a></li>
                <?php foreach ($brands as $brand): ?>
                    <li><a href="index.php?action=home&brand_id=<?= $brand['id'] ?>"><?= $brand['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="box_search">
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                <input type="text" name="name" placeholder="Từ khóa tìm kiếm">
            </form>
        </div>
    </div>
    <!-- DANH MỤC SẢN PHẨM BÁN CHẠY -->
    <div class="mb">
        <div class="box_title">SẢN PHẨM BÁN CHẠY</div>
        <div class="box_content">
            <?php foreach ($topShoes as $topShoe): ?>
                <div class="selling_products" style="width:100%;">
                    <img src="./admin/<?= explode(',', $topShoe['image'])[0] ?>" alt="anh">
                    <a href="index.php?action=shoeDetail&shoe_id=<?= $topShoe['id'] ?>"><?= $topShoe['name'] ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>