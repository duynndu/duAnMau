<main class="catalog  mb ">

    <div class="boxleft">
        <?php
        $images = explode(",", $ShoesByBrandId['image']);
        $sizes = explode(",", $ShoesByBrandId['sizes']);
        ?>
        <div class="space-30"></div>
        <div class="grid wide">
            <div class="row no-gutters">
                <div class="product-left col l-7">
                    <div class="row no-gutters">
                        <div class="col l-2">
                            <?php foreach ($images as $image): ?>
                                <div class="item">
                                    <img src="admin/<?= $image ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col l-10">
                            <div class="item_primary">
                                <img src="" alt="">
                                <div class="loop"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-right col l-5">
                    <div class="product-detail">
                        <h3><?=$ShoesByBrandId['name']?></h3>
                        <div class="rating">
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span class="times-rating">100 Đánh giá</span>
                        </div>
                        <div class="price-group">
                            <span class="price-new"><?= number_format($ShoesByBrandId['price'],0,",",".") ?>₫</span>
                            <del class="price-old">2.290.000₫</del>
                        </div>
                        <div class="space-30"></div>
                        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                            <div class="product-option">
                                <p>Chọn size:</p>
                                <div class="input-option">
                                    <?php foreach ($sizes as $key => $size): ?>
                                        <input id="input-option<?= $key ?>" type="radio" name="size" value="<?= $size ?>">
                                        <label for="input-option<?= $key ?>" class="option-value"><?= $size ?></label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="group-button">
                                <div class="stepper">
                                    <input id="quantity" type="text" value="1" name="quantity">
                                    <span>
                            <i class="up fa-solid fa-angle-up"></i>
                            <i class="down fa-solid fa-angle-down"></i>
                        </span>
                                </div>
                                <button id="button-card"><i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ</button>
                                <a href="" id="extra"><i class="fa-brands fa-bitcoin"></i> Mua hàng ngay</a>
                            </div>
                            <input hidden="hidden" type="text" value="<?=$_GET['shoe_id']?>" name="shoe_id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var first_item = document.querySelectorAll(".item")[0].querySelector("img");
            var all_item = document.querySelectorAll(".item");
            var scaleNumber = 2;//chỉnh cấp độ zoom
            var loop = document.querySelector('.loop');
            var item_primary = document.querySelector('.item_primary');
            var img = item_primary.querySelector('img');
            let src = first_item.src;
            img.src = first_item.src;
            for (let i = 0; i < all_item.length; i++) {
                all_item[i].querySelector("img").onclick = function (e) {
                    src = all_item[i].querySelector("img").src;
                    img.src = src;
                    loop.style.background = `url(${src})`;
                }
            }
            loop.style.background = `url(${src})`;
            item_primary.addEventListener('mousemove', function (e) {
                loop.style.backgroundSize = img.offsetWidth * scaleNumber + 'px ' + img.offsetHeight * scaleNumber + 'px';
                loop.style.display = 'block';
                let x = e.clientX - item_primary.offsetLeft;
                let y = e.clientY - item_primary.offsetTop + window.scrollY;
                loop.style.left = x + 'px';
                loop.style.top = y + 'px';
                let loopX = x / (img.offsetWidth / 100) + '%';
                let loopY = y / (img.offsetHeight / 100) + '%';
                loop.style.backgroundPositionX = loopX;
                loop.style.backgroundPositionY = loopY;
            });
            loop.addEventListener('mouseleave', function (e) {
                loop.style.display = 'none';
            });


            let up = document.querySelector(".up");
            let down = document.querySelector(".down");
            let value = document.querySelector("#quantity");
            up.onclick = (e) => {
                console.log("up");
                value.value = parseInt(value.value) + 1;
                console.log(value.value);
            }
            down.onclick = (e) => {
                console.log("down");
                if (value.value > 1) {
                    value.value = parseInt(value.value) - 1;
                }
            }
        </script>
        <div class="space-30"></div>


        <div class="mb">
            <div class="box_title">BÌNH LUẬN</div>
            <div class="box_content2  product_portfolio binhluan ">
                <table cellspacing="10px">
                    <?php foreach ($comments as $comment):?>
                        <tr>
                            <td><?=$comment['content']?></td>
                            <td><?=$comment['username']?></td>
                            <td><?=$comment['create_at']?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="box_search">
                <?php if($user){?>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                        <input type="text" hidden="hidden" name="shoe_id" value="<?=$ShoesByBrandId['id']?>">
                        <input type="text" name="content">
                        <button>Gửi bình luận</button>
                    </form>
                <?php }else{?>
                    <div class="">BÌNH LUẬN</div>
                    <p>Đăng nhập để sử dụng tính năng này</p>
                <?php }?>
            </div>

        </div>

        <div class=" mb">
            <div class="box_title">SẢN PHẨM CÙNG LOẠI</div>
            <div class="box_content">
                <?php foreach ($splq as $value):?>
                <li><a href="index.php?action=shoeDetail&shoe_id=<?=$value['id']?>"><?=$value['name']?></a></li>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <?php include './view/box_right.php'?>

</main>
