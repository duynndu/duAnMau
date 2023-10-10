<h1>Đơn hàng</h1>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Họ và tên</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Trạng thái</th>
        <th>Trạng thái vận chuyển</th>
    </tr>
    <?php foreach ($listOrder as $order):?>
    <tr>
        <td>
            <img style="width: 100px" src="admin/<?=explode(',',$order['image'])[0]?>" alt="">
        </td>
        <td><?=$order['name']?></td>
        <td><?=$order['size']?></td>
        <td><?=$order['quantity']?></td>
        <td><?=$order['price']*$order['quantity']?></td>
        <td><?=$order['receiver_name']?></td>
        <td><?=$order['receiver_phone']?></td>
        <td><?=$order['receiver_address']?></td>
    </tr>
    <?php endforeach;?>

</table>
