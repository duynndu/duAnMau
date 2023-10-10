<style>
    th{
        text-transform: uppercase;
    }
</style>
<div class="row2">
    <div class="row2 font_title">
        <h1>Danh sách bình luận theo tên sản phẩm</h1>
    </div>
    <div class="row2 form_content ">
        <form action="#" method="POST">
            <div class="row2 mb10 formds_loai">
                <table>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng bình luận</th>
                        <th>mới nhất</th>
                        <th>cũ nhất</th>
                    </tr>
                    <?php foreach ($commends as $commend):?>
                        <tr>
                            <td><?=$commend['name']?></td>
                            <td><?=$commend['count_bl']?></td>
                            <td><?=$commend['latest']?></td>
                            <td><?=$commend['oldest']?></td>
                            <td>
                                <a href="index.php?action=listCommentDetail&shoe_id=<?=$commend['shoes_id']?>">Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="button" value="CHỌN TẤT CẢ">
                <input  class="mr20" type="button" value="BỎ CHỌN TẤT CẢ">
                <a href="index.php?action=addComment"> <input class="mr20" type="button" value="NHẬP THÊM"></a>
            </div>
        </form>
    </div>
</div>