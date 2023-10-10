<div class="row2">
    <div class="row2 font_title">
        <h1>SỬA THÔNG TIN THÀNH VIÊN</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Username </label> <br>
                <input type="text" name="username" value="<?=$user['username']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Password </label> <br>
                <input type="text" name="password" value="<?=$user['password']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Email </label> <br>
                <input type="text" name="email" value="<?=$user['email']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Phone </label> <br>
                <input type="text" name="phone" value="<?=$user['phone']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> Address </label> <br>
                <input type="text" name="address" value="<?=$user['address']?>">
            </div>
            <div align="left" class="row2 mb10 form_content_container">
                <label> Role </label> <br>
                <select name="role">
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
                <script>
                    let option=document.querySelectorAll('option');
                    for(let i=0;i<option.length;i++){
                        if(option[i].value==='<?=$user['role']?>'){
                            option[i].selected=true;
                        }
                    }
                </script>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="SỬA">

                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listUser"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>