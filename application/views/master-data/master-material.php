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
                  <li class="breadcrumb-item active" aria-current="page">Material Factory</li>
                </ol>
              </div>
            </div>
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-body">
                    <div class="dt-container">
                        <table id="table-vendor" class="table table-striped table-bordered" width="100%">
                        <thead style="text-align: center;">
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">No.</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item Code</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Item Name</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Vendor Code</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Factory</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">UoM</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">MoQ</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">LT_PR_PO</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">LT_PO_TO_DELIV</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Total Lead Time</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Lot Size</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Order Cycle</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Initial Stock</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Standard Safety Stock</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;vertical-align:center;">
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
                "url": "<?= site_url('master_data/get_master_material_by_factory');?>",
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