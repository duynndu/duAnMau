<style>
    th{
        text-transform: uppercase;
    }
</style>
<div class="row2">
    <div class="row2 font_title">
        <h1>Danh sách bình luận</h1>
    </div>
    <div class="row2 form_content ">
        <form action="#" method="POST">
            <div class="row2 mb10 formds_loai">
                <table>
                    <tr>
                        <th>NỘI DUNG</th>
                        <th>USERNAME</th>
                        <th>NGÀY TẠO</th>
                    </tr>
                    <?php foreach ($comments as $comment):?>
                        <tr>
                            <td><?=$comment['content']?></td>
                            <td><?=$comment['username']?></td>
                            <td><?=$comment['create_at']?></td>
                            <td>
                                <a href="index.php?action=editComment&id=<?=$comment['id']?>"><input type="button" value="Sửa"></a>
                                <a onclick="return confirm('Xóa nó')" href="./index.php?action=deleteComment&id=<?=$comment['id']?>"><input type="button" value="Xóa"></a></td>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </form>
    </div>
</div>
