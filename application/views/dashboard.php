<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>
<!--begin::Row-->
            <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box text-bg-white">
                  <span class="info-box-icon"> 
                  <img
                  src="<?= base_url('assets/dist/images/home_icon.png');?>"
                  alt="Home Icon"
                  class="brand-image icon"
                  style="width:50px; height:50px"
                />
               </span>
                  <div class="info-box-content" style="height: 150px;color: #001F82;">
                    <button type="button" class="btn btn-secondary" style="font-size: 24px; font-weight: 600; color: #001F82; border-radius: 20px;">Home</button>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box text-bg-white">
                  <span class="info-box-icon"> 
                  <img
                  src="<?= base_url('assets/dist/images/goods_icon.png');?>"
                  alt="Goods Icon"
                  class="brand-image icon"
                  style="width:50px; height:50px"
                />  
                </span>
                  <div class="info-box-content" style="height: 150px;color: #001F82;">
                    <button type="button"data-bs-toggle="dropdown"  class="btn btn-secondary" style="font-size: 24px; font-weight: 600; color: #001F82; border-radius: 20px;">Goods Management</button>
                    <!-- <a class="nav-link" data-bs-toggle="dropdown" href="#">
                      <i class="bi bi-bell-fill" style="color: #001F82;"></i>
                      <span class="navbar-badge badge text-bg-warning">1</span>
                    </a> -->
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" style="width: 300px;">
                      <a href="gm-performance-dashboard.php" class="dropdown-item dropdown-footer" style="font-size: 20px; font-weight: 600;">Performance Dashboard</a>
                      <div class="dropdown-divider"></div>
                      <div class="dropdown-divider"></div>
                      <a href="item-movement.php" class="dropdown-item dropdown-footer" style="font-size: 20px; font-weight: 600;">Stock Card</a>
                      <div class="dropdown-divider"></div>
                      <div class="dropdown-divider"></div>
                      <a href="gm-transaction-card.php" class="dropdown-item dropdown-footer" style="font-size: 20px; font-weight: 600;">Transaction Card</a>
                      <div class="dropdown-divider"></div>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item dropdown-footer" style="font-size: 20px; font-weight: 600;">Master Data</a>
                    </div>                    
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>  
              <!-- /.col -->              
              <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box text-bg-white">
                  <span class="info-box-icon">
                  <img
                  src="<?= base_url('assets/dist/images/service_icon.png');?>"
                  alt="Service Icon"
                  class="brand-image icon"
                  style="width:55px; height:45px"
                />
               </span>
                  <div class="info-box-content" style="height: 150px;color: #001F82;">
                    <button type="button" class="btn btn-secondary" style="font-size: 24px; font-weight: 600; color: #001F82; border-radius: 20px;">Service Management</button>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>  
              <!-- /.col -->              
              <div class="col-md-6 col-sm-6 col-12">
                <div class="info-box text-bg-white">
                  <span class="info-box-icon"> 
                  <img
                  src="<?= base_url('assets/dist/images/saving_icon.png');?>"
                  alt="Saving Icon"
                  class="brand-image icon"
                  style="width:50px; height:50px"
                />
                  </span>
                  <div class="info-box-content" style="height: 150px;color: #001F82;">
                  <a href="<?= base_url('saving-simulator.php'); ?>" class="btn btn-secondary" style="font-size: 24px; font-weight: 600; color: #001F82; border-radius: 20px;">
                      Saving Simulator
                  </a>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>  
              <!-- /.col -->              
            </div>
            <!--end::Row-->            
          </div>
          <!--end::Container-->

<?php $this->load->view('_partials/footer.php'); ?>