<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

<!-- style tambahan buat hover -->
<style>
.custom-btn-a:hover {
    background-color: white !important;
    color: #002F6C !important;
    border: 1px solid #002F6C !important;
}

.custom-btn-b:hover {
    background-color: #002F6C !important;
    color: white !important;
    border: 1px solid #002F6C !important;
}

.btn-hover-set{
    color: #001F82;
    background-color: #DAEAFF;
    border: 1px solid rgb(145, 167, 197);
}

.btn-hover-set:hover {
    background-color: #001F82; 
    color: white; 
    border-color: #DAEAFF;
    transition: 0.3s ease-in-out;
    text-decoration: underline;
}

#dollar-chart {
    width: 110px; /* Sesuaikan ukuran dengan gambar */
    position: relative;
    top: 20px;
    height: 90px;
    bottom: 0;
    left: 45%;
    transform: translateX(-50%);
}

#cash-chart {
    width: 80px; /* Sesuaikan ukuran dengan gambar */
    height: 90px;
    position: relative;
    top: 12px;
    bottom: 0;
    left: 54%;
    transform: translateX(-50%);
}

.unclickable {
    pointer-events: none;
    cursor: default;
}
</style>

<!-- Welcoming Message -->
<div class="row d-flex align-items-stretch">
    <h4 class="fw-bold text-primary">Hi, <?php echo $this->session->userdata('user_name'); ?>!</h4>
    <h6 class="text-primary">Take a look of our update</h6>
</div>

<!-- Start Row 1 -->
<div class="row col-12 d-flex flex-wrap">
    <!-- Goods Management Label -->
    <div class="col-md-12">
        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px; font-weight: 600; color: #FFFFFF; background-color:#001F82;">
            Goods
        </span>
    </div>
    
    <!-- Card 1: Goods Management -->
    <div class="col-md-9 col-sm-12 col-12">
        <div class="info-box info-box-main" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <div class="row">
                    <!-- Cost Section -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">COST</span>
                        <div class="info-box d-flex flex-column align-items-center text-center" style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 200px;">
                            <p class="text-primary text-start fs-8 mx-0" style="line-height: 1.2;">Contains the percentage of achievement purchase compared to target</p>
                            <div id="chart-container" style="position: relative; width: 150px; height: 110px; margin: auto;">
                                <img src="<?= base_url('assets/dist/dollar_for_chart.png'); ?>" class="img-fluid" style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); max-width: 100%; height: auto; pointer-events: none; z-index: 10;">
                                <div id="dollar-chart"></div>
                            </div>
                            <h4 class="mb-0 mt-2 fw-bold text-primary">50%</h4>
                            <h6 class="text-primary">vs Target</h6>
                        </div>
                    </div>

                    <!-- Cash Section -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">CASH</span>
                        <div class="info-box d-flex flex-column align-items-center text-center" style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <p class="text-primary text-start fs-8 mx-0" style="line-height: 1.2;">Contains the percentage of achievement purchase compared to target</p>
                            <div id="chart-container" style="position: relative; width: 150px; height: 110px; margin: auto;">
                                <img src="<?= base_url('assets/dist/cash_chart_icon.png'); ?>" class="img-fluid" style="position: absolute; top: 0; transform: translateX(-50%); height: 110px; pointer-events: none; z-index: 10;">
                                <div id="cash-chart"></div>
                            </div>
                            <h4 class="mb-0 mt-2 fw-bold text-primary">95%</h4>
                            <h6 class="text-primary">vs Baseline</h6>
                        </div>
                    </div>

                    <!-- Service Section -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">SERVICE</span>
                        <div class="info-box d-flex flex-column align-items-center text-center" style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <p class="text-primary text-start fs-8 mx-0" style="line-height: 1.2;">Contains the percentage of achievement purchase compared to target</p>
                            <img src="<?= base_url('assets/dist/service1.png'); ?>" class="img-fluid" style="height: 110px;">
                            <h4 class="mb-0 mt-2 fw-bold text-primary">10</h4>
                            <h6 class="text-primary">Late Requests</h6>
                        </div>
                    </div>
                </div>
                <a href="<?=site_url('goods_management');?>" class="btn btn-sm btn-outline-primary fw-bold py-2" style="border-radius: 30px; margin-top: 2px;">See more..</a>
            </div>
        </div>
    </div>

    <!-- Card 2: To Do List -->
    <div class="col-md-3 col-sm-12 col-12">
        <div class="info-box info-box-main align-item-center" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <div class="row justify-content-between">
                    <!-- Item To Do List -->
                    <div class="col-12 px-3 mt-0">

                    <!-- <a href="<?= site_url ('goods_management/order/' . _encrypt ($v->id)); ?>"
                      class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 150px;">
                      ORDER NOW
                    </a> -->

                        <!-- <a href="<?=site_url('goods_management');?>" class="btn mb-2 fw-bold btn-hover-set w-100 text-center" style="border-radius: 50px; font-weight: 600;">ITEM TO DO LIST</a> -->

                        <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">ITEM TO DO LIST</span>

                        <div class="info-box d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                            <h3 class="fw-bold text-primary mb-3">5</h3>
                            <a href="<?=site_url('goods_management');?>" class="btn fw-bold w-100 text-uppercase custom-btn-b" 
                                style="background-color: white; color: #001F82; border: 1px solid #C4C4C4; border-radius: 20px; padding: 5px; text-align: center; display: block;">
                                ACTION
                            </a>
                        </div>

                    </div>
                    <!-- Need Feedback -->
                    <div class="col-12 px-3 mt-3">
                        <!-- <a href="<?=site_url('goods_management/feedback');?>" class="btn mb-2 fw-bold btn-hover-set w-100 text-center" style="border-radius: 50px; font-weight: 600;">NEED FEEDBACK</a> -->

                        <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">NEED FEEDBACK</span>

                        <div class="info-box d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                            <h3 class="fw-bold text-primary mb-3">5</h3>
                            <a href="<?=site_url('goods_management/feedback');?>" class="btn fw-bold w-100 text-uppercase custom-btn-b" 
                                style="background-color: white; color: #001F82; border: 1px solid #C4C4C4; border-radius: 20px; padding: 5px; text-align: center; display: block;">
                                ACTION
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row 1 -->


<!-- start row 2 -->
<div class="row col-12 d-flex flex-wrap">
    <!-- Service Management Label -->
    <div class="col-md-12">
        <span class="btn mb-2 fw-bold w-100 d-block text-center unclickable" 
            style="border-radius: 50px; font-weight: 600; color: #FFFFFF; background-color:#001F82;">
            Service
        </span>
    </div>

    <!-- Card 1: Service Management -->
    <div class="col-md-9 col-sm-12 col-12">
        <!-- <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #FFFFFF;background-color:#001F82;">
            Service Management
        </span> -->

        <div class="info-box info-box-main" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <div class="row">
                    <!-- Cost -->
                    <div class="col-md-6 px-2">
                        <span class="btn mb-2 fw-bold unclickable" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">
                            COST
                        </span>
                        <!-- Konten Cost -->
                        <div class="info-box d-flex flex-column align-items-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            
                            <p class="text-primary text-start fs-8 mx-0" style="line-height: 1.2;">Contains the percentage of achievement purchase compared to target</p>
                            
                            <!-- <img src="<?= base_url('assets/dist/cost2.png'); ?>" 
                                alt="Cost2 Icon" 
                                class="img-fluid" 
                                style="height: 120px;"> -->

                            <div id="cost-service-chart" style="width: 400px; height: 100px;"></div>
                            
                            <!-- Teks 2 Kolom -->
                            <div class="row w-100 text-center mt-3">
                                <div class="col-6">
                                    <h4 class="mb-0 fw-bold text-primary">5%</h4>
                                    <h6 class="text-primary">on cost</h6>
                                </div>
                                <div class="col-6">
                                    <h4 class="mb-0 fw-bold text-primary">2%</h4>
                                    <h6 class="text-primary">gain</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="col-md-6 px-2">
                        <span class="btn mb-2 fw-bold unclickable" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">
                            SERVICE
                        </span>
                        <!-- Konten Service -->
                        <div class="info-box d-flex flex-column align-items-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            
                            <p class="text-primary text-start fs-8 mx-0" style="line-height: 1.2;">Contains the percentage of achievement purchase compared to target</p>

                            <img src="<?= base_url('assets/dist/people.png'); ?>" 
                                alt="people Icon" 
                                class="img-fluid my-3 w-100">
                            <h4 class="mb-0 mt-0 fw-bold text-primary">50</h4>
                            <h6 class="mb-0 text-primary">late requests</h6>
                        </div>
                    </div>
                </div>

                <a href="<?=site_url('service_management');?>" class="btn btn-sm btn-outline-primary fw-bold py-2" style="border-radius: 30px;">
                    See more..
                </a>
            </div>
        </div>
    </div>  

    <!-- Card 2: To Do List -->
    <div class="col-md-3 col-sm-12 col-12">
        <!-- <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #FFFFFF;background-color:#001F82;">Service Management</span> -->
        <div class="info-box info-box-main align-item-center" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                
                <div class="row justify-content-between">
                    <!-- ITEM TO DO LIST -->
                    <div class="col-12 px-3 mt-0">
                    <!-- <a href="<?=site_url('service_management');?>" class="btn mb-2 fw-bold btn-hover-set" style="border-radius: 50px;width: 100%;font-weight: 600;">ITEM TO DO LIST</a> -->

                    <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">ITEM TO DO LIST</span>

                    <div class="info-box d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                            <h3 class="fw-bold text-primary mb-3">5</h3>
                            <a href="<?=site_url('service_management');?>" class="btn fw-bold w-100 text-uppercase custom-btn-b" 
                                style="background-color: white; color: #001F82; border: 1px solid #C4C4C4; border-radius: 20px; padding: 5px; text-align: center; display: block;">
                                ACTION
                            </a>
                        </div>
                    
                    </div>

                    <!-- NEED FEEDBACK -->
                    <div class="col-12 px-3 mt-3">
                    <!-- <a href="<?=site_url('goods_management/feedback');?>" class="btn mb-2 fw-bold btn-hover-set" style="border-radius: 50px;width: 100%;font-weight: 600;">NEED FEEDBACK</a> -->

                    <span class="btn mb-2 fw-bold w-100 text-center unclickable" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">NEED FEEDBACK</span>

                    <div class="info-box d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                            <h3 class="fw-bold text-primary mb-3">5</h3>
                            <a href="<?=site_url('goods_management/feedback');?>" class="btn fw-bold w-100 text-uppercase custom-btn-b" 
                                style="background-color: white; color: #001F82; border: 1px solid #C4C4C4; border-radius: 20px; padding: 5px; text-align: center; display: block;">
                                ACTION
                            </a>
                        </div>

                    </div>
                </div> 

            </div>
        </div>
    </div>

</div>
<!-- end row 2 -->

<!-- saving simulator section  -->
<div class="row d-flex align-items-stretch mt-3 ms-1">
    <h4 class="fw-bold text-primary">Saving Simulator</h4>
    <h6 class="text-primary">Summary of item savings</h6>
</div>

<!-- row 3 start -->
<div class="row d-flex align-items-stretch mx-1">

        <!-- card 1 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold unclickable" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">SAVINGS</span>

        <div class="info-box card-1" style="border-radius: 20px;">
            <div class="info-box-content justify-content-center align-items-center" style="color: #001F82;">
                
            <div id="savingcharts" style="width: 330px; height: 250px; position: relative;" class="mx-0 my-0 mb-0 mt-0"></div>
            
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold unclickable" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">LOSS/GAIN</span>

        <div class="info-box card-2 align-item-center justify-content-center" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
            <div class="d-flex align-items-center justify-content-center text-center gap-3">
            <!-- Bagian Kiri -->
            <div class="text-center" style="color: #002F6C;">
                <div class="fw-bold" style="font-size: 50px;">70</div>
                <div>Competitive</div>
            </div>

            <!-- Garis Miring (/) -->
            <div class="fw-bold" style="font-size: 100px;">/</div>

            <!-- Bagian Kanan -->
            <div class="text-center" style="color: #C1272D;">
                <div class="fw-bold" style="font-size: 50px;">50</div>
                <div>Need review</div>
            </div>
        </div>

        <!-- Tombol Action -->
        <button class="btn mt-2 fw-bold custom-btn-a" 
            style="background-color: #002F6C; color: white; border-radius: 20px; padding: 10px 30px;">
            ACTION
        </button>

            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        </div>

        <!-- card 3 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold unclickable" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">MARKET RESEARCH</span>

        <div class="info-box card-3" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <!-- Angka -->
                <div class="fw-bold text-center mb-0" style="font-size:70px">3</div>
                <!-- Deskripsi -->
                <div class="fs-4 text-center mt-0 mb-1">need action</div>

                <button class="btn mt-3 fw-bold w-100 text-uppercase custom-btn-b"
                    style="background-color: white; color: #001F82; border: 1px solid #C4C4C4; border-radius: 20px; padding: 10px;">
                    ACTION
                </button>

            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        </div>

    </div>
    <!-- row 3 end --->

    <!-- details calculation section  -->
<div class="row d-flex align-items-stretch mt-3 mx-1">
    <h4 class="fw-bold text-primary">Details Calculation</h4>
</div>
    <!-- end details calculation section -->


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
        Highcharts.chart('savingcharts', {
            chart: {
                type: 'pie',
                backgroundColor: null,
                spacing: [0, 0, 0, 0], 
                margin: [0, 0, 0, 0],
                plotBackgroundColor: null,
                events: {
                    render: function () {
                        var chart = this,
                            centerX = chart.plotLeft + chart.plotWidth / 2,
                            centerY = chart.plotTop + chart.plotHeight / 2;

                        if (chart.customImage) {
                            chart.customImage.destroy();
                        }

                        chart.customImage = chart.renderer.image(
                            '<?= base_url("assets/dist/images/saving_icon.png"); ?>', // URL ikon
                            centerX - 25, // Sesuaikan posisi X agar di tengah
                            centerY - 12, // Sesuaikan posisi Y agar di tengah
                            50, // Lebar gambar
                            50  // Tinggi gambar
                        ).add();
                    }
                }
            },
            title: { text: '' },
            plotOptions: {
                pie: {
                    innerSize: '60%',
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}%',
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold'
                        },
                        distance: 15 // Menempatkan angka di luar chart
                    }
                }
            },
            series: [{
                data: [
                    {
                        name: 'Realized',
                        y: 95,
                        color: '#002F6C',
                        dataLabels: {
                            enabled: true,
                            format: '<b>95%<br>Realized</b>',
                            style: { color: '#002F6C', fontSize: '14px' },
                            align: 'left',
                            verticalAlign: 'top',
                            // x: -50,
                            // y: -70
                        }
                    },
                    {
                        name: 'Opportunity',
                        y: 5,
                        color: '#C1272D',
                        dataLabels: {
                            enabled: true,
                            format: '<b>5%<br>Opportunity</b>',
                            style: { color: '#C1272D', fontSize: '14px' },
                            align: 'right',
                            verticalAlign: 'bottom',
                            // x: 80,
                            // y: 70
                        }
                    }
                ]
            }],
            credits: { enabled: false },
            tooltip: { enabled: false }
        });

        Highcharts.chart('dollar-chart', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent', 
                margin: [0, 0, 0, 0],
                height: 55, 
                width: 110  // Sesuaikan ukuran chart dengan gambar
            },
            title: { text: '' },
            xAxis: { labels: { enabled: false }, tickLength: 0 },
            yAxis: {
                labels: { enabled: false },
                gridLineWidth: 0,
                title: { text: '' },
                min: 0,
                max: 100
            },
            legend: { enabled: false },
            tooltip: { enabled: false }, 
            exporting: { enabled: false }, 
            plotOptions: {
                column: {
                    borderWidth: 0,
                    pointPadding: 0,
                    groupPadding: 0,
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Total',
                data: [50], // Nilai bar
                color: 'rgba(0, 110, 0, 0.7)' 
            }]
        });

        Highcharts.chart('cash-chart', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent',
                margin: [0, 0, 0, 0],
                height: 58, 
                width: 70  
            },
            title: { text: '' },
            xAxis: { labels: { enabled: false }, tickLength: 0 },
            yAxis: {
                labels: { enabled: false },
                gridLineWidth: 0,
                title: { text: '' },
                min: 0,
                max: 100
            },
            legend: { enabled: false },
            tooltip: { enabled: false }, 
            exporting: { enabled: false }, 
            plotOptions: {
                column: {
                    borderWidth: 0,
                    pointPadding: 0,
                    groupPadding: 0,
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Total',
                data: [95], // Nilai bar
                color: 'rgba(0, 110, 0, 0.7)'
            }]
        });

        Highcharts.chart('cost-service-chart', {
            chart: {
                type: 'bar',
                backgroundColor: 'transparent',
                margin: [0, 0, 0, 0]
            },
            title: { text: '' },
            xAxis: {
                categories: [''],
                title: { text: null },
                lineWidth: 0,
                opposite: true 
            },
            yAxis: {
                title: { text: 'Persentase (%)' },
                min: -10, 
                max: 10,
                gridLineWidth: 1, 
                plotLines: [{
                    color: 'black', // Warna sumbu tengah
                    width: 2, // Ketebalan sumbu
                    value: 0, // Letak di titik nol
                    zIndex: 5 // Supaya di atas elemen lain
                }]
            },
            legend: { enabled: false },
            credits: { enabled: false },
            exporting: {
                enabled: true,
                menuItemStyle: {
                    background: 'transparent', // Buat transparan
                    color: '#000' // Pastikan teks tetap terlihat
                },
                buttons: {
                    contextButton: {
                        symbolFill: '#000', // Warna ikon garis tiga
                        theme: {
                            fill: 'transparent' // Transparan saat diklik
                        }
                    }
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            series: [{
                name: 'On Cost',
                data: [-5], // Nilai negatif, jadi ke kiri
                color: ' #C1272D'
            }, {
                name: 'Gain',
                data: [2], // Nilai positif, jadi ke kanan
                color: 'rgba(0, 110, 0, 0.7)'
            }]
        });


    // logic untuk tinggi card tertentu
    document.addEventListener("DOMContentLoaded", function () {
    let targetRows = [2, 3, 5, 6, 9]; // Index row yang ingin diatur

    targetRows.forEach(index => {
        let targetRow = document.querySelectorAll(".row")[index];

        if (targetRow) {
            let cards = targetRow.querySelectorAll(".info-box");

            if (cards.length > 0) {
                let maxHeight = 0;

                // Cari tinggi maksimum dalam row ini
                cards.forEach(card => {
                    let cardHeight = card.offsetHeight;
                    if (cardHeight > maxHeight) {
                        maxHeight = cardHeight;
                    }
                });

                // Set semua card di row ini ke tinggi maksimum
                cards.forEach(card => {
                    card.style.height = maxHeight + "px";
                });
            }
        }
    });
});

// Logic untuk menyamakan tinggi card putih utama
document.addEventListener("DOMContentLoaded", function () {
    let targetRows = [1, 4]; // row tertentu

    targetRows.forEach(index => {
        let targetRow = document.querySelectorAll(".row")[index];

        if (targetRow) {
            let cards = targetRow.querySelectorAll(".info-box-main"); // Hanya card putih utama

            if (cards.length > 0) {
                let maxHeight = 0;

                cards.forEach(card => {
                    let cardHeight = card.offsetHeight;
                    if (cardHeight > maxHeight) {
                        maxHeight = cardHeight;
                    }
                });

                cards.forEach(card => {
                    card.style.height = maxHeight + "px";
                });
            }
        }
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".app-sidebar");
    let originalSizes = [];

    if (sidebar) {
        Highcharts.charts.forEach((chart, index) => {
            if (chart) {
                originalSizes[index] = {
                    width: chart.chartWidth,
                    height: chart.chartHeight
                };
            }
        });

        sidebar.addEventListener("mouseenter", function () {
            Highcharts.charts.forEach((chart, index) => {
                if (chart) {
                    // Pilih chart berdasarkan ID
                    if (chart.renderTo.id === 'savingcharts' || chart.renderTo.id === 'cost-service-chart') {
                        // Kurangi ukuran lebar 20%
                        let newWidth = originalSizes[index].width * 0.8;
                        let newHeight = newWidth * (originalSizes[index].height / originalSizes[index].width);
                        chart.setSize(newWidth, newHeight, false);

                        // Set margin/padding menjadi 0 dan align center
                        chart.renderTo.style.margin = '0';
                        chart.renderTo.style.padding = '0';
                        chart.renderTo.style.display = 'block';
                        chart.renderTo.style.marginLeft = 'auto';
                        chart.renderTo.style.marginRight = 'auto';
                    }
                }
            });
        });

        sidebar.addEventListener("mouseleave", function () {
            Highcharts.charts.forEach((chart, index) => {
                if (chart) {
                    // Pilih chart berdasarkan ID
                    if (chart.renderTo.id === 'savingcharts' || chart.renderTo.id === 'cost-service-chart') {
                        let newWidth = originalSizes[index].width;
                        let newHeight = originalSizes[index].height;
                        chart.setSize(newWidth, newHeight, false);

                        // Set margin/padding kembali ke normal
                        chart.renderTo.style.margin = '';
                        chart.renderTo.style.padding = '';
                        chart.renderTo.style.display = '';
                        chart.renderTo.style.marginLeft = '';
                        chart.renderTo.style.marginRight = '';
                    }
                }
            });
        });
    }
});


    </script>

<?php $this->load->view('_partials/footer.php'); ?>
