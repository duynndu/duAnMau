<?php
if($user){
    $cartUser=getAllDataBy('cart',['*','cart.id AS cart_id','shoes.id AS shoe_id'],
        "JOIN shoes ON shoes.id=cart.shoe_id",
        "WHERE cart.user_id=".$user['id'],
        ["cart.create_at"],
        10
    );
    echo '<pre>';
//    print_r($cartUser);
    echo '</pre>';
}else{

}
$carts=$cartUser??$_SESSION['carts']??[];
?>
<?php
$total = 0;
?>
<h1>Giỏ hàng</h1>
<div class="space-30"></div>
<div class="container grid ">
    <div class="row">
        <div class="col l-8">
            <div class="card-cart">
                <table>
                    <tr>
                        <th></th>
                        <th>Hình ảnh</th>
                        <th class="name-sp">Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng cộng</th>
                    </tr>
                    <?php foreach ($carts as $key => $value): ?>
                        <?php
                        $total+=$value['price']*$value['quantity'];
                        ?>
                        <tr>
                            <td>
                                <input class="cart_id" value="<?=$value['cart_id']??$key?>" type="checkbox">
                            </td>
                            <td>
                                <img style="width: 100px" src="admin/<?= explode(",", $value['image'])[0] ?>">
                            </td>
                            <td class="name-sp">
                                <a href="index.php?action=shoeDetail&shoe_id=<?=$value['shoe_id']?>"><?= $value['name'] ?></a>
                                <p>size:<?= $value['size'] ?></p>
                            </td>
                            <td>
                                <form action="index.php?action=update_cart" method="post">
                                    <div style="width: 30px; height: 40px" class="stepper">
                                        <input class="quantity" type="text" value="<?= $value['quantity'] ?>"
                                               name="quantity">
                                        <input type="hidden" name="cart_id" value="<?=$value['cart_id']??$key?>">
                                        <span>
                                            <i style="font-size: 10px" class="up fa-solid fa-angle-up"></i>
                                            <i style="font-size: 10px" class="down fa-solid fa-angle-down"></i>
                                        </span>
                                    </div>
                                    <button style="border: 1px solid; border-right:none ; padding: 10px">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                    <a style="border: 1px solid; padding: 10px" class="delete-sp"
                                       href="index.php?action=delete_cart&id=<?= $value['cart_id']??$key?>">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </form>
                            </td>
                            <td><?= number_format($value['price'],0,",",".") ?>₫</td>
                            <td><?= number_format($value['price'] * $value['quantity'], 0, ",", ".") ?>₫</td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="col l-4">
            <div class="card-order">
                <div class="cart-panels">
                    <a href="">
                        <span>Sử dụng mã giảm giá</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <table>
                    <tr>
                        <td>Thành tiền</td>
                        <td><?= number_format($total,0,",",".") ?>₫</td>
                    </tr>
                    <tr>
                        <td>Tổng</td>
                        <td><?= number_format($total,0,",",".") ?>₫</td>
                    </tr>
                </table>
                <form action="./index.php?action=order" method="post">
                    <div class="form-control">
                        <label for="">Họ Và Tên</label>
                        <input type="text" name="receiver_name">
                    </div>
                    <div class="form-control">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="receiver_phone" value="<?=$user['phone']??''?>">
                    </div>
                    <div class="form-control">
                        <label for="">Địa chỉ</label>
                        <textarea name="receiver_address" cols="30" rows="5"><?=$user['address']??''?></textarea>
                    </div>
                    <input id="cart_ids" type="hidden" name="cart_ids">
                    <button class="buy-btn">Đặt hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let ups = document.querySelectorAll(".up");
    let downs = document.querySelectorAll(".down");
    let values = document.querySelectorAll(".quantity");

    for (let i = 0; i < values.length; i++) {
        ups[i].onclick = (e) => {
            values[i].value = parseInt(values[i].value) + 1;
        }
        downs[i].onclick = (e) => {
            if (values[i].value > 1) {
                values[i].value = parseInt(values[i].value) - 1;
            }
        }
    }
    let cart_ids=[];
    let ids
    let cart_id=document.querySelectorAll('.cart_id');
    for(let i=0;i<cart_id.length;i++){
        cart_id[i].addEventListener('click',function (e){

            if(cart_id[i].checked){
                console.log('check');
                cart_ids[i]=cart_id[i].value;
            }else {
                cart_ids[i]=0;
                console.log('uncheck');
            }
            ids=cart_ids.filter((value,index)=>{
                return value!==0;
            });
            document.querySelector("#cart_ids").value=ids.join(',');
        });
    }

</script>
<?php
echo "<script>
    
</script>"
?>
