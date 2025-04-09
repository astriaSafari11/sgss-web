<head>
    <?php $this->load->view ('_partials/head.php'); ?>
</head>

<style>
    .unclickable {
        pointer-events: none;
        cursor: default;
    }
</style>

<div class="main-content">
    <!-- row 1 start -->
    <div class="row d-flex align-items-stretch">
        <h3 class="fw-bold text-primary">Main Dashboard</h3>

        <!-- card 1 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Overview
                of Spend</span>

            <div class="info-box card-1" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <h10 class="mb-3">KPI-spend vs baseline (budget/YoY)</h10>

                    <div class="d-flex justify-content-between align-items-center rounded me-1">

                        <div class="text-center me-1">
                            <div class="fw-bold text-primary fs-5">50.000.0000 IDR</div>
                            <div class="text-primary small">vs 42.500.000 IDR</div>
                        </div>

                        <div class="d-flex align-items-center mx-3">
                            <i class="bi bi-cursor-fill text-danger fs-1" style="transform: rotate(-45deg);"></i>
                        </div>

                        <div class="text-center ms-3">
                            <div class="fw-bold text-primary fs-5">15%</div>
                            <div class="text-primary small">vs 2024 YoY</div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary fw-bold mt-2 py-2" style="border-radius: 30px">
                        See Details...
                    </a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Top
                Loss</span>

            <div class="info-box card-2" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <h10 class="text-primary mb-2">Top Items causing Leakage</h10>

                    <div id="loss_chart" style="width: 100%;"
                        class="d-flex justify-content-between align-items-center rounded"></div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

        <!-- card 3 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Top
                Gain</span>

            <div class="info-box card-3" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <h10 class="small text-primary">Top items that already competitive with largest savings</h10>

                    <div id="gain_chart" style="width: 100%;"
                        class="d-flex justify-content-between align-items-center rounded"></div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

    </div>
    <!-- row 1 end --->

    <!-- start row 2 -->
    <div class="row d-flex align-items-stretch">
        <!-- card 1 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Overview
                of Savings Potential</span>

            <div class="info-box" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <h10 class="mb-3">KPI-current potential savings available</h10>

                    <div class="d-flex align-items-center justify-content-between rounded me-1">
                        <!-- Kolom untuk Gauge Chart -->
                        <div id="gauge-chart" style="width: 50%; height: 120px;"></div>

                        <!-- Kolom untuk Teks -->
                        <div class="text-end">
                            <h5 style="color: #001F82; font-weight: bold;">50.000.0000 IDR</h5>
                            <p class="small" style="color: #001F82;">Potential savings</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary fw-bold my-2 py-2" style="border-radius: 30px">
                        See Details...
                    </a>

                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- saving warriors -->
            <div class="info-box" style="border-radius: 20px; padding: 41px; width: 100%;">
                <div class="row align-items-center px-0 w-100">
                    <!-- Kolom 1: Teks (di kiri, mentok) -->
                    <div class="col-6 px-0">
                        <h5 class="fw-bold text-start" style="color: #001F82; white-space: nowrap;">Saving Warriors</h5>
                    </div>
                    <!-- Kolom 2: Tombol (di kanan, mentok) -->
                    <div class="col-6 px-0 text-end">
                        <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2 px-3"
                            style="border-radius: 30px;">
                            Submit
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Current
                Items vs Baseline Graph</span>

            <div class="info-box p-3" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <!-- Navbar/Filter Kecil -->
                    <div class="btn-group w-100" role="group">
                        <button class="btn btn-outline-primary fw-bold active">Spend 2025</button>
                        <button class="btn btn-outline-primary fw-bold">Budget</button>
                    </div>

                    <!-- Chart -->
                    <div id="stackedBarChart" style="height: 180px;"></div>

                    <!-- Filter (Btn) -->
                    <div class="d-flex flex-column w-100 text-center">
                        <button class="btn btn-outline-primary w-100 mb-1 fw-bold">Budget</button>
                        <button class="btn btn-outline-primary w-100 mb-1 fw-bold">FY 2024</button>
                        <button class="btn btn-outline-primary w-100 fw-bold">YTD 2024</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- card 3 -->
        <div class="col-md-4 col-sm-12 col-12">
            <span class="btn mb-2 fw-bold unclickable unclickable"
                style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Vendor
                of Choice</span>

            <div class="info-box" style="border-radius: 20px;">
                <div class="info-box-content" style="color: #001F82;">
                    <h10 class="mb-3">Top spent vendors & savings contributing to vendors</h10>

                    <div id="vendorBarChart" style="height: 283px;"></div>

                    <!-- <div class="d-flex justify-content-between align-items-center rounded me-1">
                </div> -->
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>

    </div>
    <!-- end row 2 -->

    <!-- saving table section  -->
    <div class="row d-flex align-items-stretch mt-3 mx-2">
        <h4 class="fw-bold text-primary">Saving Table</h4>

        <table id="example" class="table table-sm mx-2" style="max-width:100%; box-sizing: border-box;" cellspacing="0">
            <thead>
                <tr>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Quantity</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">UoM Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price</th>
                    <th style="color: #fff;background-color: #001F82;text-align: center;">Purchase Reason</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;"><a href="<?php echo site_url ('saving_simulator/detail'); ?>">Masker
                    </td>
                    <td style="text-align: center;">20</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Earplug</td>
                    <td style="text-align: center;">20</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND02</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Masker</td>
                    <td style="text-align: center;">50</td>
                    <td style="text-align: center;">Box</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Alkohol</td>
                    <td style="text-align: center;">100</td>
                    <td style="text-align: center;">ml</td>
                    <td style="text-align: center;">VND01</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Alkohol</td>
                    <td style="text-align: center;">100</td>
                    <td style="text-align: center;">ml</td>
                    <td style="text-align: center;">VND03</td>
                    <td style="text-align: center;">Rp 5000</td>
                    <td style="text-align: center;">Rp 500000</td>
                    <td style="text-align: center;">Routine Buy</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- end saving table section -->

</div>

<!-- script buat gauge chart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<script>
    Highcharts.chart('loss_chart', {
        chart: {
            type: 'bar',
            height: 130,
            spacing: [5, 5, 5, 5]
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: null
            },
            labels: {
                overflow: 'justify'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'center',
            verticalAlign: 'top',
            itemMarginTop: 0,
            itemMarginBottom: 0,
            margin: 0,
            y: -10
        },
        credits: { enabled: false },
        series: [{
            name: 'Series 1',
            data: [5, 7, 15, 20],
            color: '#C0392B'
        }],
        plotOptions: {
            bar: {
                pointPadding: 0.0001, // Jarak dalam setiap bar
                groupPadding: 0.0001  // Jarak antar kelompok bar
            }
        }
    });

    Highcharts.chart('gain_chart', {
        chart: {
            type: 'bar',
            height: 130,
            spacing: [5, 5, 5, 5]
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: null
            },
            labels: {
                overflow: 'justify'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'center',
            verticalAlign: 'top',
            itemMarginTop: 0,
            itemMarginBottom: 0,
            margin: 0,
            y: -10
        },
        credits: { enabled: false },
        series: [{
            name: 'Series 1',
            data: [5, 7, 15, 20],
            color: '#016836'
        }],
        plotOptions: {
            bar: {
                pointPadding: 0.0001, // Jarak dalam setiap bar
                groupPadding: 0.0001  // Jarak antar kelompok bar
            }
        }
    });

    Highcharts.chart('gauge-chart', {
        chart: {
            type: 'gauge',
            backgroundColor: 'transparent',
            spacing: [0, 0, 0, 0],
            margin: [0, 0, 0, 0],
            spacingTop: 0,
            spacingBottom: 0,
        },
        title: null,
        credits: { enabled: false },
        pane: {
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '70%'],
            size: '130%',
            background: [{
                outerRadius: '100%',
                innerRadius: '70%',
                shape: 'arc',
                borderWidth: 0,
                backgroundColor: '#FFC72C'
            }]
        },
        yAxis: {
            min: 0,
            max: 100,
            tickPositions: [],
            labels: { enabled: false },
            plotBands: [{
                id: 'filled-band',
                from: 0,
                to: 65,
                color: '#001F82',
                thickness: '30%'
            }]
        },
        plotOptions: {
            gauge: {
                dial: {
                    radius: '80%',
                    backgroundColor: '#001F82',
                    baseLength: '15%',
                    baseWidth: 8,
                    borderWidth: 0
                },
                pivot: {
                    backgroundColor: '#001F82',
                    radius: 10
                }
            }
        },
        series: [{
            name: 'Savings [%]',
            data: [0],
            dataLabels: { enabled: false }
            // tooltip: { enabled: false },
        }]
    }, function (chart) {
        let targetValue = 65;
        let currentValue = 0;

        let interval = setInterval(() => {
            if (currentValue < targetValue) {
                currentValue += 5;

                chart.series[0].points[0].update(currentValue);
                chart.yAxis[0].update({
                    plotBands: [{
                        id: 'filled-band',
                        from: 0,
                        to: currentValue,
                        color: '#001F82',
                        thickness: '30%'
                    }]
                });
            } else {
                clearInterval(interval);
            }
        }, 30);
    });

    Highcharts.chart('stackedBarChart', {
        chart: { type: 'bar', backgroundColor: 'transparent', height: 190 },
        title: { text: '' },
        xAxis: {
            categories: ["Item 1", "Item 2", "Item 3", "Item 4"],
            title: { text: null }
        },
        yAxis: {
            min: 0,
            max: 50,
            title: { text: null },
            labels: { overflow: 'justify' }
        },
        tooltip: { shared: true },
        plotOptions: {
            series: {
                stacking: 'normal',
                borderRadius: 5,
                dataLabels: { enabled: false }
            },
            bar: {
                pointPadding: 0.0001, // Jarak dalam setiap bar
                groupPadding: 0.0001  // Jarak antar kelompok bar
            }
        },
        legend: { layout: 'horizontal', align: 'center', verticalAlign: 'top' },
        credits: { enabled: false },
        series: [
            { name: 'Series 1', data: [5, 10, 15, 20], color: '#001F82' },
            { name: 'Series 2', data: [10, 20, 25, 20], color: '#AEBECD' }
        ]
    });

    Highcharts.chart('vendorBarChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Vendor 1', 'Vendor 2', 'Vendor 3', 'Vendor 4'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            enabled: false
        },
        credits: { enabled: false },
        series: [{
            name: 'Series 1',
            data: [7, 2, 15, 5],
            color: '#001F82'
        }, {
            name: 'Series 2',
            data: [2, 10, 5, 20],
            color: '#A9C6E8'
        }]
    });

    function equalizeSelectedRowsCardHeight() {
        let targetRows = [0]; // Index row yang ingin diatur
        let allRows = document.querySelectorAll(".row");

        targetRows.forEach(index => {
            let targetRow = allRows[index];

            if (targetRow) {
                let cards = targetRow.querySelectorAll(".info-box");

                if (cards.length > 0) {
                    // Reset tinggi dulu
                    cards.forEach(card => {
                        card.style.height = "auto";
                    });

                    // Cari tinggi maksimum
                    let maxHeight = 0;
                    cards.forEach(card => {
                        maxHeight = Math.max(maxHeight, card.offsetHeight);
                    });

                    // Set tinggi ke semua card
                    cards.forEach(card => {
                        card.style.height = maxHeight + "px";
                    });
                }
            }
        });
    }

    document.addEventListener("DOMContentLoaded", equalizeSelectedRowsCardHeight);
    window.addEventListener("resize", equalizeSelectedRowsCardHeight);

    // function equalizeCardHeight() {
    //     let firstRow = document.querySelector('.row'); 

    //     if (firstRow) {
    //         let cards = firstRow.querySelectorAll('.info-box'); 
    //         let maxHeight = 0;

    //         cards.forEach(card => {
    //             card.style.height = "auto"; 
    //         });

    //         cards.forEach(card => {
    //             maxHeight = Math.max(maxHeight, card.offsetHeight);
    //         });

    //         cards.forEach(card => {
    //             card.style.height = maxHeight + "px";
    //         });
    //     }
    // }

    // window.onload = equalizeCardHeight;
    // window.onresize = equalizeCardHeight;

    // script untuk demo klik btn (sementara)
    document.addEventListener("DOMContentLoaded", function () {
        let buttons = document.querySelectorAll(".btn-group button");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                buttons.forEach(btn => btn.classList.remove("active"));

                this.classList.add("active");
            });
        });
    });

    window.onload = function () {
        const sidebar = document.querySelector(".app-sidebar");
        const mainContent = document.querySelector(".main-content"); // Ganti sesuai elemen utama kamu

        let originalSizes = [];

        // Simpan ukuran asli semua chart
        Highcharts.charts.forEach((chart, index) => {
            if (chart) {
                originalSizes[index] = {
                    width: chart.chartWidth,
                    height: chart.chartHeight
                };
            }
        });

        if (sidebar && mainContent) {
            sidebar.addEventListener("mouseenter", function () {
                // Resize Highcharts
                Highcharts.charts.forEach((chart, index) => {
                    if (chart) {
                        let newWidth = originalSizes[index].width * 0.8;
                        let newHeight = newWidth * 0.5;
                        chart.setSize(newWidth, newHeight, false);

                        chart.renderTo.style.margin = '0';
                        chart.renderTo.style.padding = '0';
                        chart.renderTo.style.display = 'block';
                        chart.renderTo.style.marginLeft = 'auto';
                        chart.renderTo.style.marginRight = '0';
                    }
                });

                // Scale semua konten
                mainContent.style.transform = 'scale(0.95)';
                mainContent.style.transformOrigin = 'top center';
                //   mainContent.style.transition = 'transform 0.3s ease';
            });

            sidebar.addEventListener("mouseleave", function () {
                // Reset chart
                Highcharts.charts.forEach((chart, index) => {
                    if (chart) {
                        chart.setSize(originalSizes[index].width, originalSizes[index].height, false);
                        chart.renderTo.style.margin = '';
                        chart.renderTo.style.padding = '';
                        chart.renderTo.style.display = '';
                        chart.renderTo.style.marginLeft = '';
                        chart.renderTo.style.marginRight = '';
                    }
                });

                // Reset scale konten
                mainContent.style.transform = 'scale(1)';
            });
        }
    };

</script>

<?php $this->load->view ('_partials/footer.php'); ?>
