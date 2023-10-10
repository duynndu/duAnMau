<div class="row2">
    <div class="row2 font_title">
        <h1>THÊM MỚI THÀNH VIÊN</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
            <div class="row2 mb10 form_content_container">
                <label> Username </label> <br>
                <input type="text" name="username">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Password </label> <br>
                <input type="text" name="password">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Email </label> <br>
                <input type="text" name="email">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Phone </label> <br>
                <input type="text" name="phone">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Address </label> <br>
                <input type="text" name="address">
            </div>
            <div align="left" class="row2 mb10 form_content_container">
                <label> Role </label> <br>
                <select name="role">
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="THÊM MỚI">

                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listUser"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>