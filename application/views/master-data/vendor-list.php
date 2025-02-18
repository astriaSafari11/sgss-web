<?php $this->load->view('_partials/head.php'); ?>
<style>
    div.dt-container {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('master_data');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                  <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                  Material by Vendor
                </a>   
                <a href="<?= site_url('master_data/material');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                  <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                  Material by Factory
                </a>                 
                <a href="<?= site_url('master_data/vendor_list');?>" class="btn btn-sm btn-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                  <i class="fa-solid fa-address-card" style="margin-right:5px; margin-left: 5px;"></i>
                  Vendor List
                </a>   
                <a href="<?= site_url('master_data/material_list');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                  <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
                  Material List
                </a> 
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Master Data</li>
                  <li class="breadcrumb-item active" aria-current="page">Vendor List</li>
                </ol>
              </div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-header">
                    <div class="card-tools">
                      <a href="<?= site_url('master_data/add_vendor');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add New Vendor
                      </a>                           
                      <a type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                        <i class="fa-solid fa-file-export"></i>
                        Export
                      </a>                       
                      <a type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                      <i class="fa-solid fa-file-import"></i>
                        Import
                      </a>                     
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dt-container">
                        <table id="table-vendor" class="table table-striped table-bordered" width="100%">
                        <thead style="text-align: center;white-space:nowrap;">
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">No.</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor Code</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Category</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Rating</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">
                        </tbody>
                        </table>                         
                    </div>             
                  </div>
                  <!-- /.card-body -->
                  <!-- <div class="card-footer">Footer</div> -->
                  <!-- /.card-footer-->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!--end::Row-->

<?php $this->load->view('_partials/footer.php'); ?>

<script>
      $(document).ready(function() {
          $('#table-vendor').DataTable({
              scrollX: true,
              "processing": true, 
              "serverSide": true, 
              "ordering": false,
              "ajax": {
                "url": "<?= site_url('master_data/get_master_vendor_list');?>",
                "type": "POST"
              },
              "order": [],        
              "columnDefs": [
                {
                    targets: '_all',
                    createdCell: function(cell) {
                      $(cell).css('vertical-align', 'middle');
                    }
                }
            ],
          });      
      });
</script>