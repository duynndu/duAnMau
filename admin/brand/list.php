<div class="row2">
    <div class="row2 font_title">
        <h1>DANH SÁCH THƯƠNG HIỆU</h1>
    </div>
    <div class="row2 form_content ">
        <form action="#" method="POST">
            <div class="row2 mb10 formds_loai">
                <table>
                    <tr>
                        <th></th>
                        <th>MÃ LOẠI</th>
                        <th>HÌNH ẢNH</th>
                        <th>TÊN LOẠI</th>
                        <th></th>
                    </tr>
                    <?php foreach ($brands as $brand):?>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td><?=$brand['id']?></td>
                            <td><img width="50px" src="<?=$brand['image']?>" alt=""></td>
                            <td><?=$brand['name']?></td>
                            <td>
                                <a href="index.php?action=editBrand&id=<?=$brand['id']?>"><input type="button" value="Sửa"></a>
                                <a onclick="return confirm('Xóa nó')" href="./index.php?action=deleteBrand&id=<?=$brand['id']?>"><input type="button" value="Xóa"></a></td>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="button" value="CHỌN TẤT CẢ">
                <input  class="mr20" type="button" value="BỎ CHỌN TẤT CẢ">
                <a href="index.php?action=addBrand"> <input class="mr20" type="button" value="NHẬP THÊM"></a>
            </div>
        </form>
    </div>
</div>