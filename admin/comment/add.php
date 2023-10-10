<div class="row2">
    <div class="row2 font_title">
        <h1>THÊM MỚI BÌNH LUẬN</h1>
    </div>
    <div class="row2 form_content ">
        <form style="text-align: left" action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Nội dung </label> <br>
                <input type="text" name="content">
            </div>
            <div class="row2 mb10 form_content_container">
                <select name="user_id" id="">
                    <?php foreach ($users as $user):?>
                        <option value="<?=$user['id']?>"><?=$user['username']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="row2 mb10 form_content_container">
                <select name="shoe_id" id="">
                    <?php foreach ($shoes as $shoe):?>
                        <option value="<?=$shoe['id']?>"><?=$shoe['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="THÊM">

                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listComment"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>