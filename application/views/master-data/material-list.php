<?php $this->load->view('_partials/head.php'); ?>
<style>
    div.dt-container {
        width: 100%;
        margin: 0 auto;
    }
</style>
<div class="row mb-2">
<div class="col-sm-9">
                <?php $this->load->view('master-data/_header_parts.php'); ?>     
              </div>
              <div class="col-sm-3">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Master Data</li>
                  <li class="breadcrumb-item active" aria-current="page">Material List</li>
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
                      <a href="<?= site_url('master_data/add_material');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap">
                        <i class="fa-solid fa-circle-plus"></i>
                        Add New Material
                      </a>                                              
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="dt-container">
                        <table id="table-vendor" class="table table-striped table-bordered" width="100%">
                        <thead style="text-align: center;white-space:nowrap;">
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">No.</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item Code</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Factory</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Size</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Lot Size</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Order Cycle</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Initial Stock</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Avg Lead Time</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Standard Safety Stock</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;vertical-align:center;white-space:nowrap;">
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
                "url": "<?= site_url('master_data/get_master_material');?>",
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