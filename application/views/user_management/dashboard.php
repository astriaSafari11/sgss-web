<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

<h4 class="fw-bold text-primary">List Of Verified Users</h4>

<div class="info-box d-flex flex-wrap align-items-stretch">
<div class="row align-items-center mb-3 col-12 m-1">

  <!-- Kiri -->
  <div class="col-md-6">
    <div class="d-flex gap-2">
        <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center p-4 rounded-3" style="width: 80px; height: 80px;">
        <i class="bi bi-person-badge-fill fs-1"></i>
        </a>
        <a href="#" class="btn btn-outline-primary d-flex align-items-center justify-content-center p-4 rounded-3" style="width: 80px; height: 80px;">
        <i class="bi bi-building fs-1"></i>
        </a>
    </div>
    </div>


  <!-- Kanan -->
<div class="col-md-6">
  <div class="d-flex flex-column align-items-end gap-2">

    <a href="<?= site_url('user_management/authorized');?>" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-gear-fill me-1"></i> Set Up Role’s Authorization
    </a>

    <div class="d-flex align-items-center gap-2">
      <label class="me-1 mb-0">Search User:</label>
      <input type="text" class="form-control form-control-sm" placeholder="Search..." style="width: 200px;">
      <button class="btn btn-outline-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Add User
      </button>
    </div>

  </div>
</div>

</div>

<div class="row px-2 w-100 m-1">
<table id="example" class="table table-sm mx-2" style="width:100%" cellspacing="0">
<thead>
        <tr>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">No.</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Username</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Role</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Email</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Phone</th>
            <th style="color: #fff;background-color: #001F82;text-align: center; vertical-align: middle;">Action</th>
        </tr>
    </thead>
    <tbody class="align-middle">
        <tr>
            <td class="text-center" style="font-size: 1.1rem;">1</td>
            <td class="text-center" style="font-size: 1.1rem;">Super Administrator</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Admin
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">admin@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal">
                    <i class="bi bi-info-circle"></i>
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Edit" style="font-size: 1.2rem;">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm rounded-circle" title="Delete" style="font-size: 1.2rem;">
                    <i class="bi bi-trash"></i>
                </button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center" style="font-size: 1.1rem;">2</td>
            <td class="text-center" style="font-size: 1.1rem;">Super Administrator</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Admin
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">admin@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal">
                    <i class="bi bi-info-circle"></i>
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Edit" style="font-size: 1.2rem;">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm rounded-circle" title="Delete" style="font-size: 1.2rem;">
                    <i class="bi bi-trash"></i>
                </button>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center" style="font-size: 1.1rem;">3</td>
            <td class="text-center" style="font-size: 1.1rem;">Super Administrator</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Admin
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">admin@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal">
                    <i class="bi bi-info-circle"></i>
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Edit" style="font-size: 1.2rem;">
                    <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm rounded-circle" title="Delete" style="font-size: 1.2rem;">
                    <i class="bi bi-trash"></i>
                </button>
                </div>
            </td>
        </tr>


        
    </tbody>
</table>
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- isi menyusul -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('_partials/footer.php'); ?>