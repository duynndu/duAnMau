<main class="catalog  mb ">

    <div class="boxleft">
        <div class="banner">
            <img id="banner" src="imgnh0.jpg" alt="">
            <button class="pre" onclick="pre()">&#10094;</button>
            <button class="next" onclick="next()">&#10095;</button>
        </div>
        <div class="space-30"></div>
        <div class="items">
            <?php foreach ($shoes as $shoe): ?>
                <div class="box_items">
                    <div class="box_items_img">
                        <img src="admin/<?= explode(',', $shoe['image'])[0] ?>" alt="">
                        <div class="add" ">ADD TO CART</div>
                    </div>
                    <a class="item_name" href="index.php?action=shoeDetail&shoe_id=<?=$shoe['id']?>"><?= $shoe['name'] ?></a>
                    <p class="price"><?= $shoe['price'] ?></p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <?php include './view/box_right.php'?>

</main>
<script src="main.js">

</script>