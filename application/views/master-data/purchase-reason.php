<?php $this->load->view ('_partials/head.php'); ?>
<style>
  div.dt-container {
    width: 100%;
    margin: 0 auto;
  }
</style>
<div class="row mb-2">
  <div class="col-sm-9">
    <?php $this->load->view ('master-data/_header_parts.php'); ?>
  </div>
  <div class="col-sm-3">
    <ol class="breadcrumb float-sm-end">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item" aria-current="page">Master Data</li>
      <li class="breadcrumb-item active" aria-current="page">Purchase Reason List</li>
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
          <a href="#" class="btn btn-sm btn-outline-primary position-relative"
            style="font-weight: 600; border-radius: 50px; white-space:nowrap">
            <i class="fa-solid fa-circle-plus"></i>
            Add New Purchase Reason
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="dt-container">

        <?php $this->load->view ('_partials/search_bar.php'); ?>

          <table id="purchase_table" class="table table-striped table-bordered" width="100%">
            <thead style="text-align: center;white-space:nowrap;">
              <tr>
                <th style="color: #fff;background-color: #001F82;text-align: center; width: 80px">No.</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">ID</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Type</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Purchase Reason</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">Approval Status</th>
                <th style="color: #fff;background-color: #001F82;text-align: center;">WL Approval</th>
                <th style="color: #fff;background-color: #001F82;text-align: center; width: 120px;">Action</th>
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

<?php $this->load->view ('_partials/footer.php'); ?>

<script>
$(document).ready(function () {
    $('#purchase_table').DataTable({
        scrollX: true,
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": {
            "url": "<?= site_url('master_data/get_purchase_reason'); ?>",
            "type": "POST"
        },
        "order": [],
        "columnDefs": [
            {
                targets: 1, // Sembunyikan kolom ID
                visible: false 
            },
            {
                targets: 4, // Kolom Approval Status
                render: function (data, type, row) {
                    return data == "1" ? '<span class="badge bg-success">Approved</span>' : 
                                         '<span class="badge bg-danger">Not Approved</span>';
                }
            },
            {
                targets: '_all',
                createdCell: function (cell) {
                    $(cell).css('vertical-align', 'middle');
                }
            }
        ],
        "columns": [
            { "data": 0 }, // No.
            { "data": 1 }, // ID (Hidden)
            { "data": 2 }, // Type
            { "data": 3 }, // Purchase Reason
            { "data": 4 }, // Approval Status (Akan dirender dengan badge)
            { "data": 5 }, // WL Approval
            { "data": 6 }  // Action (Tombol Edit)
        ],
        "searching": false,
        "lengthChange": false
    });
});

</script>