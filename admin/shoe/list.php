<div class="row2">
    <form style="text-align: left" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <input type="text" name="name">
        <select name="brand_id" id="">
            <option value="0">Tất cả</option>
            <?php foreach ($brands as $brand):?>
                <option value="<?=$brand['id']?>"><?=$brand['name']?></option>
            <?php endforeach;?>
        </select>
        <button>Tìm</button>
    </form>
    <div class="row2 font_title">
        <h1>DANH SÁCH GIÀY</h1>
    </div>
    <div class="row2 form_content ">
        <div class="row2 mb10 formds_loai">
            <table>
                <tr>
                    <th></th>
                    <th>MÃ LOẠI</th>
                    <th>HÌNH ẢNH</th>
                    <th>TÊN LOẠI</th>
                    <th>SIZE</th>
                    <th>GIÁ</th>
                    <th></th>
                </tr>
                <?php foreach ($shoes as $shoe): ?>
                    <tr>
                        <td><input type="checkbox" name="" id=""></td>
                        <td><?= $shoe['id'] ?></td>
                        <td><img width="50px" src="<?= explode(',', $shoe['image'])[0] ?>" alt=""></td>
                        <td><?= $shoe['name'] ?></td>
                        <td><?= $shoe['sizes'] ?></td>
                        <td><?= $shoe['price'] ?></td>
                        <td>
                            <a href="index.php?action=editShoe&id=<?=$shoe['id']?>"><input type="button" value="Sửa"></a>
                            <a onclick="return confirm('Xóa nó')" href="./index.php?action=deleteShoe&id=<?=$shoe['id']?>"><input type="button" value="Xóa"></a></td>
                        </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="row mb10 ">
            <input class="mr20" type="button" value="CHỌN TẤT CẢ">
            <input class="mr20" type="button" value="BỎ CHỌN TẤT CẢ">
            <a href="index.php?action=addShoe"> <input class="mr20" type="button" value="NHẬP THÊM"></a>
        </div>
    </div>
</div>