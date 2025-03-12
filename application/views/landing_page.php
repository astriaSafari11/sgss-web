<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

<!-- style tambahan buat hover -->
<style>
.card-2 button:hover {
    background-color: white !important;
    color: #002F6C !important;
    border: 1px solid #002F6C !important;
}

.card-3 button:hover {
    background-color: #002F6C !important;
    color: white !important;
    border: 1px solid #002F6C !important;
}
</style>

<!-- Welcoming Message -->
<div class="row d-flex align-items-stretch">
    <h4 class="fw-bold text-primary">Hi, <?php echo $this->session->userdata('user_name'); ?>!</h4>
    <h6 class="text-primary">Take a look of our update</h6>
</div>

<!-- start row 1 -->
<div class="row">
    <!-- Card 1: Goods Management -->
    <div class="col-md-6 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px; width: 100%; font-weight: 600; color: #FFFFFF; background-color:#001F82;">
            Goods Management
        </span>

        <div class="info-box" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <div class="row">
                    <!-- Cost -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold" style="border-radius: 50px; width: 100%; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                            COST
                        </span>
                        <!-- Konten Cost -->
                        <div class="info-box d-flex flex-column align-items-center justify-content-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <img src="<?= base_url('assets/dist/dollarIcon.png'); ?>" 
                                alt="Dollar Icon" 
                                class="img-fluid w-100" 
                                style="height: 110px;">
                            <h4 class="mb-0 mt-2 fw-bold text-primary">50%</h4>
                            <h6 class="text-primary">vs Target</h6>
                        </div>
                    </div>

                    <!-- Cash -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold" style="border-radius: 50px; width: 100%; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                            CASH
                        </span>
                        <!-- Konten Cash -->
                        <div class="info-box d-flex flex-column align-items-center justify-content-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <img src="<?= base_url('assets/dist/cash.png'); ?>" 
                                alt="Cash Icon" 
                                class="img-fluid" 
                                style="height: 110px;">
                            <h4 class="mb-0 mt-2 fw-bold text-primary">95%</h4>
                            <h6 class="text-primary">vs baseline</h6>
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="col-md-4 px-2">
                        <span class="btn mb-2 fw-bold" style="border-radius: 50px; width: 100%; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                            SERVICE
                        </span>
                        <!-- Konten Service -->
                        <div class="info-box d-flex flex-column align-items-center justify-content-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <img src="<?= base_url('assets/dist/service1.png'); ?>" 
                                alt="Service1 Icon" 
                                class="img-fluid" 
                                style="height: 110px;">
                            <h4 class="mb-0 mt-2 fw-bold text-primary">10</h4>
                            <h6 class="text-primary">late requests</h6>
                        </div>
                    </div>
                </div>

                <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2" style="border-radius: 30px; margin-top: 2px;">
                    See more..
                </a>
            </div>
        </div>
    </div>

    <!-- Card 2: Service Management -->
    <div class="col-md-6 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #FFFFFF;background-color:#001F82;">
            Service Management
        </span>

        <div class="info-box" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <div class="row">
                    <!-- Cost -->
                    <div class="col-md-6 px-2">
                        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">
                            COST
                        </span>
                        <!-- Konten Cost -->
                        <div class="info-box d-flex flex-column align-items-center justify-content-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <img src="<?= base_url('assets/dist/cost2.png'); ?>" 
                                alt="Cost2 Icon" 
                                class="img-fluid" 
                                style="height: 120px;">
                            
                            <!-- Teks 2 Kolom -->
                            <div class="row w-100 text-center">
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
                        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">
                            SERVICE
                        </span>
                        <!-- Konten Service -->
                        <div class="info-box d-flex flex-column align-items-center justify-content-center text-center" 
                            style="border-radius: 20px; background-color: #F8F9FA; padding: 15px; min-height: 150px;">
                            <img src="<?= base_url('assets/dist/people.png'); ?>" 
                                alt="people Icon" 
                                class="img-fluid my-4 w-100">
                            <h4 class="mb-0 mt-1 fw-bold text-primary">50</h4>
                            <h6 class="mb-3 text-primary">late requests</h6>
                        </div>
                    </div>
                </div>

                <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2" style="border-radius: 30px;">
                    See more..
                </a>
            </div>
        </div>
    </div>
</div>
<!-- end row 1 -->


<!-- start row 2 -->
<div class="row">
    <!-- Card 1: Goods Management -->
    <div class="col-md-6 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #FFFFFF;background-color:#001F82;">Goods Management</span>

        <div class="info-box" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                
                <div class="row">
                    <!-- ITEM TO DO LIST -->
                    <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">ITEM TO DO LIST</span>
                    <div class="info-box align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                            <h3 class="fw-bold text-primary">5</h3>
                        </div>
                    
                    </div>

                    <!-- NEED FEEDBACK -->
                    <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">NEED FEEDBACK</span>
                    <div class="info-box align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                        <h3 class="fw-bold text-primary text-center">5</h3>
                        </div>

                    </div>
                </div> 

            </div>
        </div>
    </div>

    <!-- Card 2: Service Management -->
    <div class="col-md-6 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #FFFFFF;background-color:#001F82;">Service Management</span>

        <div class="info-box" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                
                <div class="row">
                    <!-- ITEM TO DO LIST -->
                    <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">ITEM TO DO LIST</span>
                    <div class="info-box align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                        <h3 class="fw-bold text-primary text-center">5</h3>
                        </div>

                    </div>

                    <!-- NEED FEEDBACK -->
                    <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF;border: 1px solid rgb(145, 167, 197);">NEED FEEDBACK</span>
                    <div class="info-box align-items-center justify-content-center" style="border-radius: 20px; background-color: #F8F9FA;">
                        <h3 class="fw-bold text-primary text-center">5</h3>
                        </div>

                    </div>
                </div> 

            </div>
        </div>
    </div>
</div>
<!-- end row 2 -->

<!-- Goods Management Section (Detail) -->
<div class="container-fluid">
    <div class="row">
        <h3 class="fw-bold text-primary mt-3">Goods Management</h3>
        <h6 class="text-primary">Reports and overview of goods management performance</h6>

        <!-- Bagian Atas: Cost, Cash, Service -->
        <div class="col-12">
            <div class="row">
                <div class="col-md-4 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        COST
                    </span>
                    <div class="info-box d-flex flex-column align-items-center justify-content-center text-center bg-white" 
                        style="border-radius: 20px; padding: 15px; min-height: 150px;">
                        
                        <h10 class="text-primary fs-7 text-start">Contains the percentage of achievement purchase compared to target</h10>
                        
                        <img src="<?= base_url('assets/dist/dollarIcon.png'); ?>" 
                            alt="Dollar Icon" 
                            class="img-fluid" 
                            style="height: 110px;">
                        <h4 class="mb-0 mt-2 fw-bold text-primary">50%</h4>
                        <h6 class="text-primary">vs Target</h6>
                    </div>
                </div>

                <div class="col-md-4 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        CASH
                    </span>
                    <div class="info-box d-flex flex-column align-items-center justify-content-center text-center bg-white" 
                        style="border-radius: 20px; padding: 15px; min-height: 150px;">

                        <h10 class="text-primary fs-7 text-start">Contains the percentage of achievement purchase compared to target</h10>

                        <img src="<?= base_url('assets/dist/cash.png'); ?>" 
                            alt="Cash Icon" 
                            class="img-fluid" 
                            style="height: 110px;">
                        <h4 class="mb-0 mt-2 fw-bold text-primary">95%</h4>
                        <h6 class="text-primary">vs baseline</h6>
                    </div>
                </div>

                <div class="col-md-4 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        SERVICE
                    </span>
                    <div class="info-box d-flex flex-column align-items-center justify-content-center text-center bg-white" 
                        style="border-radius: 20px; padding: 15px; min-height: 150px;">

                        <h10 class="text-primary fs-7 text-start">Contains the percentage of achievement purchase compared to target</h10>

                        <img src="<?= base_url('assets/dist/service1.png'); ?>" 
                            alt="Service1 Icon" 
                            class="img-fluid" 
                            style="height: 110px;">
                        <h4 class="mb-0 mt-2 fw-bold text-primary">10</h4>
                        <h6 class="text-primary">late requests</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Btn See More -->
        <div class="col-12">
            <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2 px-5" style="border-radius: 10px;">
                See more..
            </a>
        </div>

        <!-- Bagian Bawah: ITEM TO DO LIST & NEED FEEDBACK -->
        <h3 class="fw-bold text-primary mt-3">Goods Management</h3>
        <h6 class="text-primary">Summary of item status and activity</h6>

        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        ITEM TO DO LIST
                    </span>
                    <div class="info-box d-flex align-items-center justify-content-center bg-white" style="border-radius: 20px;">
                        <h3 class="fw-bold text-primary" style="font-size:40px;">5</h3>
                    </div>
                </div>

                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        NEED FEEDBACK
                    </span>
                    <div class="info-box d-flex align-items-center justify-content-center bg-white" style="border-radius: 20px;">
                        <h3 class="fw-bold text-primary text-center" style="font-size:40px;">5</h3>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- end Goods Management Detail -->

<!-- Service Management Section (Detail) -->
<div class="container-fluid">
    <div class="row">
        <h3 class="fw-bold text-primary mt-3">Service Management</h3>
        <h6 class="text-primary">Reports and overview of service management performance</h6>

        <!-- Bagian Atas: Cost & Service -->
        <div class="col-12">
            <div class="row">
                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        COST
                    </span>
                    <div class="info-box d-flex flex-column bg-white" 
                        style="border-radius: 20px; padding: 15px; min-height: 150px;">

                        <h10 class="text-primary fs-7 text-start w-100">Contains the percentage of achievement purchase compared to target</h10>

                        <div class="row w-100 d-flex align-items-center text-center mt-2">
                            <div class="col-4">
                                <h4 class="mb-0 fw-bold text-primary">5%</h4>
                                <h6 class="text-primary">on cost</h6>
                            </div>
                            <div class="col-4">
                                <img src="<?= base_url('assets/dist/cost2.png'); ?>" 
                                    alt="Cost2 Icon" 
                                    class="img-fluid" 
                                    style="height: 115px;">
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0 fw-bold text-primary">2%</h4>
                                <h6 class="text-primary">gain</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        SERVICE
                    </span>
                    <div class="info-box d-flex flex-column align-items-center justify-content-center text-center bg-white" 
                        style="border-radius: 20px; padding: 15px; min-height: 150px;">

                        <h10 class="text-primary fs-7 text-start w-100">Contains the percentage of achievement purchase compared to target</h10>

                        <img src="<?= base_url('assets/dist/people.png'); ?>" 
                            alt="People Icon" 
                            class="img-fluid" 
                            style="height: 80px;">
                        <h4 class="mb-0 mt-0 fw-bold text-primary">50</h4>
                        <h6 class="text-primary">late requests</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Btn See More -->
        <div class="col-12">
            <a href="#" class="btn btn-sm btn-outline-primary fw-bold py-2 px-5" style="border-radius: 10px;">
                See more..
            </a>
        </div>

        <!-- Bagian Bawah: ITEM TO DO LIST & NEED FEEDBACK -->
        <h3 class="fw-bold text-primary mt-3">Service Tasks</h3>
        <h6 class="text-primary">Summary of item status and activity</h6>

        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        ITEM TO DO LIST
                    </span>
                    <div class="info-box d-flex align-items-center justify-content-center bg-white" style="border-radius: 20px;">
                        <h3 class="fw-bold text-primary" style="font-size:40px;">5</h3>
                    </div>
                </div>

                <div class="col-md-6 px-2">
                    <span class="btn mb-2 fw-bold w-100" style="border-radius: 50px; font-weight: 600; color: #001F82; background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">
                        NEED FEEDBACK
                    </span>
                    <div class="info-box d-flex align-items-center justify-content-center bg-white" style="border-radius: 20px;">
                        <h3 class="fw-bold text-primary text-center" style="font-size:40px;">5</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Service Management Detail -->

<!-- saving simulator section  -->
<div class="row d-flex align-items-stretch mt-3 ms-1">
    <h3 class="fw-bold text-primary">Saving Simulator</h3>
    <h6 class="text-primary">Summary of item savings</h6>
</div>

<!-- row 3 start -->
<div class="row d-flex align-items-stretch mx-1">

        <!-- card 1 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">SAVINGS</span>

        <div class="info-box card-1" style="border-radius: 20px;">
            <div class="info-box-content justify-content-center align-items-center" style="color: #001F82;">
                
            <div id="savingcharts" style="width: 330px; height: 250px;" class="mx-0 my-0 mb-0 mt-0"></div>
            
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>

        <!-- card 2 -->
        <div class="col-md-4 col-sm-12 col-12">
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">LOSS/GAIN</span>

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
        <button class="btn mt-2 fw-bold" 
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
        <span class="btn mb-2 fw-bold" style="border-radius: 50px;width: 100%;font-weight: 600;color: #001F82;background-color:#DAEAFF; border: 1px solid rgb(145, 167, 197);">MARKET RESEARCH</span>

        <div class="info-box card-3" style="border-radius: 20px;">
            <div class="info-box-content" style="color: #001F82;">
                <!-- Angka -->
                <div class="fw-bold text-center mb-0" style="font-size:70px">3</div>
                <!-- Deskripsi -->
                <div class="fs-4 text-center mt-0 mb-1">need action</div>

                <button class="btn mt-4 fw-bold w-100 text-uppercase"
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
                <td style="text-align: center;">Masker</td>
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

    // logic untuk tinggi card tertentu
    document.addEventListener("DOMContentLoaded", function () {
    let targetRows = [2, 12, 16]; // Index row yang ingin diatur

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

    </script>

<?php $this->load->view('_partials/footer.php'); ?>
