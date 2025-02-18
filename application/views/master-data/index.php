<?php $this->load->view('_partials/head.php'); ?>
<style>
    div.dt-container {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('master_data');?>" class="btn btn-primary position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                  Vendor
                </a>   
                <a href="<?= site_url('master_data/material');?>" class="btn btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                  Material
                </a>   
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Master Data</li>
                  <li class="breadcrumb-item active" aria-current="page">Vendor</li>
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
                      <button type="button" class="btn btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap">
                        Add New Vendor
                      </button>                           
                      <button type="button" class="btn btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                        Export
                      </button>                       
                      <button type="button" class="btn btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                        Import
                      </button>                       
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dt-container">
                        <table id="table-vendor" class="table table-striped table-bordered">
                        <thead style="text-align: center;white-space:nowrap;">
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">No.</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor Code</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Category</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Rating</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Purchase History</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Est. Lead Time</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Price / UoM</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">MoQ</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;width:100px;">Total Price</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price if QTY = MOQ</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Price MOQ/MOQ</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Savings</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Place to buy</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Link</th>
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
                "url": "<?= site_url('master_data/get_master_vendor');?>",
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