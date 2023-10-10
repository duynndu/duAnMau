<!DOCTYPE html>
<html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<body>
<div
        id="myChart" style="width:100%; max-width:600px; height:500px;">
</div>

<script>
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            <?php foreach ($list as $key => $value) {
                echo "['".$value['brand_name']."', ".$value['count']."],";
            }?>

        ]);

        const options = {
            title: 'BIỂU ĐỒ THỐNG KÊ SỐ LOẠI SẢN PHẨM CỦA MỖI THƯƠNG HIỆU',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>

</body>
</html>



