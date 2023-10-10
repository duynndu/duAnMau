<div class="row2">
    <div class="row2 font_title">
        <h1>DANH SÁCH THƯƠNG HIỆU</h1>
    </div>
    <div class="row2 form_content ">
            <div STYLE="text-align: left" class="row2 mb10 formds_loai">
                <table>
                    <tr>
                        <th>BRAND_ID</th>
                        <th>TÊN THƯƠNG HIỆU</th>
                        <th>SẢN PHẨM GIÁ CAO NHẤT</th>
                        <th>SẢN PHẨM GIÁ THẤP NHẤT</th>
                        <th>SỐ LOẠI SẢN PHẨM CÓ</th>
                    </tr>
                    <?php foreach ($list as $value):?>
                        <tr>
                            <td><?=$value['brand_id']?></td>
                            <td><?=$value['brand_name']?></td>
                            <td><?=$value['min']?></td>
                            <td><?=$value['max']?></td>
                            <td><?=$value['count']?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="row mb10 ">
                <a href="index.php?action=pieChart"> <input class="mr20" type="button" value="Xem biểu đồ"></a>
            </div>
    </div>
</div>