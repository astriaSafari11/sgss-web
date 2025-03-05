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
                  <li class="breadcrumb-item active" aria-current="page">Vendor</li>
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
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
    
<div class="d-flex align-items-center">
        <label for="entriesSelect" class="me-2 fs-7">Show</label>
        <select id="entriesSelect" class="form-select form-select-sm w-auto fs-7">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ms-2 fs-7">entries</span>
    </div>
    <!-- End Dropdown Show X Entries -->

    <!-- Start Search + Filter -->
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <!-- Filter 1 -->
        <label for="filterBy1" class="small">Filter 1:</label>
        <select id="filterBy1" class="form-select form-select-sm w-auto">
            <option value="all">All</option>
            <option value="0">Column 1</option>
            <option value="1">Column 2</option>
            <option value="2">Column 3</option>
        </select>

        <!-- Filter 2 -->
        <label for="filterBy2" class="small">Filter 2:</label>
        <select id="filterBy2" class="form-select form-select-sm w-auto">
            <option value="all">All</option>
            <option value="A">Category A</option>
            <option value="B">Category B</option>
            <option value="C">Category C</option>
        </select>

        <!-- Filter 3 -->
        <label for="filterBy3" class="small">Filter 3:</label>
        <select id="filterBy3" class="form-select form-select-sm w-auto">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <!-- Search Button -->
        <button class="btn btn-outline-primary btn-sm" type="button" id="searchBtn">
            <i class="fas fa-search"></i>
        </button>

    </div>
</div>
  <!-- End Search + filter -->

                        <table id="table-vendor" class="table table-striped table-bordered">
                        <thead style="text-align: center;vertical-align: middle;">
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
                                <th style="color: #fff;background-color: #001F82;text-align: center;">MoQ</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Price / UoM (Rp.)</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price (Rp.)</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Total Price if QTY = MOQ (Rp.)</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Price MOQ/MOQ (Rp.)</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Savings (%)</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Place to buy</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Link</th>
                            </tr>
                        </thead>
                        <tbody>
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
        var vendorTable = $('#table-vendor').DataTable({
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
                { targets: [10,11,12,13],
                    createdCell: function(cell) {
                        $(cell).css('text-align', 'right');
                        $(cell).css('vertical-align', 'middle');
                        $(cell).css('white-space', 'nowrap');
                    }
                },
                { targets: [1,2,3,4,5,6,7,8,9,14,15,16],
                    createdCell: function(cell) {
                        $(cell).css('text-align', 'center');
                        $(cell).css('vertical-align', 'middle');
                        $(cell).css('white-space', 'nowrap');
                    }                    
                },         
                {
                    targets: '_all',
                    createdCell: function(cell) {
                        $(cell).css('vertical-align', 'middle');
                        $(cell).css('white-space', 'nowrap');
                    }
                }
            ],
        });

        $('#table-vendor_wrapper .dataTables_length').remove();
        $('#table-vendor_wrapper .dataTables_filter').remove();

        $('#entriesSelect').on('change', function () {
            var length = $(this).val();
            vendorTable.page.len(length).draw();
        });

        $('#searchBtn').on('click', function() {
            var filter1 = $('#filterBy1').val();
            var filter2 = $('#filterBy2').val();
            var filter3 = $('#filterBy3').val();

            vendorTable.columns(0).search(filter1).draw();
            vendorTable.columns(1).search(filter2).draw();
            vendorTable.columns(2).search(filter3).draw();
        });
    });
</script>

<!-- <script>
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
</script> -->