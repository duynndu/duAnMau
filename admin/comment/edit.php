<div class="row2">
    <div class="row2 font_title">
        <h1>SỬA BÌNH LUẬN</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Nội dung </label> <br>
                <input type="text" name="content" value="<?=$comment['content']?>">
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="SỬA">

                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listComment"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>