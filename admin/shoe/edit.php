<div class="row2">
    <div class="row2 font_title">
        <h1>SỬA HÀNG HÓA</h1>
    </div>
    <div class="row2 form_content ">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label> Name </label> <br>
                <input type="text" name="name" value="<?=$shoe['name']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> sizes </label> <br>
                <input type="text" name="sizes" value="<?=$shoe['sizes']?>">
            </div>
            <div class="row2 mb10 form_content_container">
                <label> price </label> <br>
                <input type="text" name="price" value="<?=$shoe['price']?>">
            </div>
            <div style="display: flex;flex-direction: column" class="row2 mb10 form_content_container">
                <label> images </label> <br>
                <div align="left" class="images">
                    <?php foreach (explode(",",$shoe['image']) as $image):?>
                        <img width="100px" src="<?=$image?>" alt="">
                    <?php endforeach;?>
                </div>
                <input type="file" name="image[]" multiple>
            </div>
            <div style="display: flex;flex-direction: column" class="row2 mb10">
                <label for=""> Chọn thương hiệu </label>
                <select style="width: 100px" name="brand_id" id="">
                    <?php foreach ($brands as $brand):?>
                        <option <?=$brand['id']==$shoe['brand_id']? 'selected':''?> value="<?=$brand['id']?>"><?=$brand['name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="row mb10 ">
                <input class="mr20" type="submit" value="SỬA">
                <input  class="mr20" type="reset" value="NHẬP LẠI">

                <a href="index.php?action=listShoe"><input class="mr20" type="button" value="DANH SÁCH"></a>
            </div>
        </form>
    </div>
</div>