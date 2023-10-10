<div class="row2">
    <div class="row2 font_title">
        <h1>THÊM MỚI LOẠI HÀNG HÓA</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Thương hiệu </label> <br>
                <input type="text" name="name" placeholder="Nhập thương hiệu">
            </div>
            <div style="display: flex;flex-direction: column" class="row2 mb10">
                <label>Hỉnh ảnh</label> <br>
                <input type="file" name="image"> <br>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="THÊM MỚI">

                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listBrand"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>