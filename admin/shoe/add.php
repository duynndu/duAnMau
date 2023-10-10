<div class="row2">
    <div class="row2 font_title">
        <h1>THÊM MỚI HÀNG HÓA</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Name </label> <br>
                <input type="text" name="name" placeholder="Tên sản phẩm">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> sizes </label> <br>
                <input type="text" name="sizes">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> price </label> <br>
                <input type="text" name="price">
            </div>
            <div style="display: flex;flex-direction: column" class="row2 mb10 form_content_container">
                <label> images </label> <br>
                <input type="file" name="image[]" multiple>
            </div>
            <div style="display: flex;flex-direction: column" class="row2 mb10">
                <label for=""> Chọn thương hiệu </label>
                <select style="width: 100px" name="brand_id" id="">
                    <?php foreach ($brands as $brand):?>
                        <option value="<?=$brand['id']?>"><?=$brand['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="THÊM MỚI">
                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listShoe"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>