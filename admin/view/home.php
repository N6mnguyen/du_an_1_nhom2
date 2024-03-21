<?php
$htm_donhang = showsp_donhang(donhang_limit());
$html_dh_new =  show_dh_new(donhang_new_limit());
$html_user_new = showdm_user_new(user_new());
?>

<div class="main-content">
    <h3 class="title-page">
        Dashboards
    </h3>
    <section class="statistics row">
        <div class="col-sm-12 col-md-6 col-xl-3">
            <a href="admin.php?pg=sanphamlist">
                <div class="card mb-3 widget-chart">
                    <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                        <h5>
                            Tổng sản phẩm
                        </h5>
                    </div>
                    <span class="widget-numbers"><?= count(get_sp_all()) ?></span>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <a href="admin.php?pg=users">
                <div class="card mb-3 widget-chart">

                    <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                        <h5>
                            Tổng thành viên
                        </h5>
                    </div>
                    <span class="widget-numbers"><?= count(user_all()) ?></span>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <a href="admin.php?pg=catalog">
                <div class="card mb-3 widget-chart">
                    <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                        <h5>
                            Tổng doanh mục
                        </h5>
                    </div>
                    <span class="widget-numbers"><?= count(danhmuc_all()) ?></span>
                </div>
            </a>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <a href="admin.php?pg=bills">
                <div class="card mb-3 widget-chart">
                    <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                        <h5>
                            Tổng đơn hàng
                        </h5>
                    </div>
                    <span class="widget-numbers"><?= count(donhang_all()) ?></span>
                </div>
            </a>
        </div>
    </section>
    <section class="row">
        <div class="col-sm-12 col-md-6 col xl-6">
            <div class="card chart">

                <p>Tổng doanh thu: <span><?= number_format(tong_doanhthu(donhang_all()), 0, ',', '.') ?> VNĐ</span></p>
                <table class="revenue table table-hover">
                    <thead>
                        <th>stt</th>
                        <th>Mã đơn hàng</th>
                        <th>Doanh thu</th>
                    </thead>
                    <tbody>
                        <?= $htm_donhang ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <div class="card chart">
                <h4>Đơn hàng mới</h4>
                <table class="revenue table table-hover">
                    <thead>
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                    </thead>
                    <tbody>
                        <?= $html_dh_new ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-3">
            <div class="card chart">
                <h4>Khách hàng mới</h4>
                <table class="revenue table table-hover">
                    <thead>
                        <th>Stt</th>
                        <th>Username</th>
                    </thead>
                    <tbody>
                        <?= $html_user_new ?>
                </table>
            </div>
        </div>
    </section>
    <div>
        <h3 class="caption-subject text-uppercase">
            Thống Kê Doanh Thu:
            <b id="text-date">365 Ngày qua</b>
        </h3>
        <select id="select-date" name="id_trangthai" class="select2_demo_3 form-control">
            <option value="7ngay"> 7 Ngày qua </option>
            <option value="28ngay"> 28 Ngày qua </option>
            <option value="60ngay"> 60 Ngày qua </option>
            <option value="90ngay"> 90 Ngày qua </option>
            <option value="180ngay"> 180 Ngày qua </option>
            <option selected value="365ngay"> 365 Ngày qua </option>
        </select>
        <div id="myfirstchart">
        </div>
        <div style="display: grid; grid-template-columns: 70% 30%; gap:60px;">
            <div id="line-adwords">

            </div>
            <div>
                <h5>Thống kê sản phẩm bán chạy</h5>
                <div class="text-center">
                    <!-- Thống kê số lượng sản phẩm trong danh mục -->
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    var myChart; // Khai báo biến biểu đồ ở mức toàn cục
    $(document).ready(function() {
        myChart = new Morris.Area({
            element: 'myfirstchart',

            xkey: 'date',

            ykeys: ['order', "sales", "quantity"],

            labels: ['Đơn hàng', 'Doanh Thu', 'Số lượng bán ra'],
            lineColors: ['#3498db', '#3fb394', '#01f'],
            // fillOpacity: 0,
            animate: 'bounce',
        });

        $('#select-date').change(function() {
            var thoigian = $(this).val();
            if (thoigian == '7ngay') {
                var text = "7 ngày qua";
            } else if (thoigian == '28ngay') {
                var text = "28 ngày qua";
            } else if (thoigian == '60ngay') {
                var text = "60 ngày qua";
            } else if (thoigian == '90ngay') {
                var text = "90 ngày qua";
            } else if (thoigian == '180ngay') {
                var text = "180 ngày qua";
            } else if (thoigian == '365ngay') {
                var text = "365 ngày qua";
            }
            $('#text-date').text(text);
            $.ajax({
                url: "./view/thongke.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    thoigian: thoigian
                },
                success: function(data) {
                    myChart.setData(data); // Sử dụng biến biểu đồ đã khai báo ở trên
                    $('#text-date').text(text);
                }
            });

        })


        // Mặc định chạy 365 ngày
        function thongke() {
            var text = "365 ngày qua";
            $('#text-date').text(text);

            $.ajax({
                url: "./view/thongke.php",
                method: "POST",
                dataType: "JSON",

                success: function(data) {
                    myChart.setData(data); // Sử dụng biến biểu đồ đã khai báo ở trên
                    $('#text-date').text(text);
                }
            });
        }

        // Gọi hàm thongke để tạo biểu đồ ban đầu
        thongke();
    });
    
    var optionsLine = {
        chart: {
            height: 328,
            type: 'line',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                top: 3,
                left: 2,
                blur: 4,
                opacity: 1,
            }
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        //colors: ["#3F51B5", '#2196F3'],

        series: [
            <?= $maxprice ?>,
            <?= $minprice ?>,
            <?= $trungbinh ?>
        ],


        title: {
            text: 'Thống kê giá cả theo danh mục',
            align: 'left',
            offsetY: 25,
            offsetX: 5,
        },
        subtitle: {
            text: 'Tổng tiền',
            offsetY: 55,
            offsetX: 5
        },
        markers: {
            size: 8,
            strokeWidth: 0,
            hover: {
                size: 9
            }
        },
        grid: {
            show: true,
            padding: {
                bottom: 0
            }
        },

        labels: <?= $label; ?>,

        xaxis: {
            tooltip: {
                enabled: false
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -20
        }
    }

    var chartLine = new ApexCharts(document.querySelector('#line-adwords'), optionsLine);
    chartLine.render();
    
    var options = {
        series: <?=$soluong?>,
        chart: {
            width: 350,
            type: 'pie',
        },
        labels: <?= $tensp ?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>