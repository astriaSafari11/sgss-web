<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

    <!-- row 1 start -->
    <div class="row d-flex align-items-stretch">
        <h3 class="fw-bold text-primary">Main Dashboard</h3>

        <!-- card 1 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Overview of Spend</span>

        <div class="info-box card-1" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
            <h10 class="mb-3">KPI-spend vs baseline (budget/YoY)</h10>

            <div class="d-flex justify-content-between align-items-center rounded me-1">
        
            <div class="text-center me-3">
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
        <a href="#" class="btn btn-sm btn-outline-primary fw-bold mt-3 py-2" style="border-radius: 30px">
                See Details...
            </a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Top Loss</span>

        <div class="info-box card-2" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
            <h10 class="text-primary mb-2">Top Items causing Leakage</h10>

            <div id="loss_chart" style="width: 100%;" class="d-flex justify-content-between align-items-center rounded"></div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        </div>

        <!-- card 3 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Top Gain</span>

        <div class="info-box card-3" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
            <h10 class="small text-primary">Top items that already competitive with largest savings</h10>

            <div id="gain_chart" style="width: 100%;" class="d-flex justify-content-between align-items-center rounded"></div>
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
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Overview of Savings Potential</span>

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
                    <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2 px-3" style="border-radius: 30px;">
                        Submit
                    </a>
                </div>
            </div>
        </div>

        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Current Items vs Baseline Graph</span>

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
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;">Vendor of Choice</span>

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

function equalizeCardHeight() {
    let firstRow = document.querySelector('.row'); // Hanya memilih row pertama

    if (firstRow) {
        let cards = firstRow.querySelectorAll('.info-box'); 
        let maxHeight = 0;

        cards.forEach(card => {
            card.style.height = "auto"; 
        });

        cards.forEach(card => {
            maxHeight = Math.max(maxHeight, card.offsetHeight);
        });

        cards.forEach(card => {
            card.style.height = maxHeight + "px";
        });
    }
}

window.onload = equalizeCardHeight;
window.onresize = equalizeCardHeight;

// script untuk demo klik btn sesaat
document.addEventListener("DOMContentLoaded", function () {
    let buttons = document.querySelectorAll(".btn-group button");

    buttons.forEach(button => {
        button.addEventListener("click", function () {
            buttons.forEach(btn => btn.classList.remove("active"));

            this.classList.add("active");
        });
    });
});

</script>

<?php $this->load->view('_partials/footer.php'); ?>