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
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>ROLE</th>
                        <th></th>
                    </tr>
                    <?php foreach ($users as $user):?>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td><?=$user['id']?></td>
                            <td><?=$user['username']?></td>
                            <td><?=$user['password']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=$user['phone']?></td>
                            <td><?=$user['address']?></td>
                            <td><?=$user['role']==0?'User':'admin'?></td>
                            <td>
                                <a href="index.php?action=editUser&id=<?=$user['id']?>"><input type="button" value="Sửa"></a>
                                <a onclick="return confirm('Xóa nó')" href="./index.php?action=deleteUser&id=<?=$user['id']?>"><input type="button" value="Xóa"></a></td>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="button" value="CHỌN TẤT CẢ">
                <input  class="mr20" type="button" value="BỎ CHỌN TẤT CẢ">
                <a href="index.php?action=addUser"> <input class="mr20" type="button" value="NHẬP THÊM"></a>
            </div>
        </form>
    </div>
</div>