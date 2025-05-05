<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

<h4 class="fw-bold text-primary">List Of Verified Users</h4>

<div class="info-box d-flex flex-wrap align-items-stretch">
<div class="row align-items-center mb-3 col-12 m-1">

  <!-- Kiri -->
    <div class="col-md-6">
      <div class="d-flex gap-2">
        <a href="#" class="btn btn-outline-primary d-flex flex-column align-items-center justify-content-center p-4 rounded-3 toggle-table active" data-target="table-user" style="width: 80px; height: 80px;">
          <i class="bi bi-person-badge-fill fs-1"></i>
          <span class="fs-7 mt-1">UNILEVER</span>
        </a>
        <a href="#" class="btn btn-outline-primary d-flex flex-column align-items-center justify-content-center p-4 rounded-3 toggle-table" data-target="table-supplier" style="width: 80px; height: 80px;">
          <i class="bi bi-building fs-1"></i>
          <span class="fs-7 mt-1">SUPPLIER</span>
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
      <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AddUser">
        <i class="bi bi-plus-lg"></i> Add User
      </button>
    </div>

  </div>
</div>

</div>

<div class="row px-2 w-100 m-1">

<!-- table user -->
<table id="table-user" class="table table-sm mx-2" style="width:100%" cellspacing="0">
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


<!-- table supplier -->
<table id="table-supplier" class="table table-sm mx-2 d-none" style="width:100%;" cellspacing="0">
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
            <td class="text-center" style="font-size: 1.1rem;">Nama Supplier</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Supplier
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">supplier@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal2">
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
            <td class="text-center" style="font-size: 1.1rem;">Nama Supplier</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Supplier
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">supplier@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal2">
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
            <td class="text-center" style="font-size: 1.1rem;">Nama Supplier</td>
            <td class="text-center">
                <span class="badge text-primary" style="background-color: #DAEAFF; color: #000; font-size: 1rem; padding: 0.5em 0.75em;">
                Supplier
                </span>
            </td>
            <td class="text-center" style="font-size: 1.1rem;">supplier@gmail.com</td>
            <td class="text-center" style="font-size: 1.1rem;">081212121212</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                <button class="btn btn-outline-primary btn-sm rounded-circle" title="Detail" style="font-size: 1.2rem;" data-bs-toggle="modal" data-bs-target="#detailModal2">
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

</div>

<!-- Modal user -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless fs-6">
          <tr>
            <th class="text-primary">Nama</th>
            <td>: Super Administrator</td>
          </tr>
          <tr>
            <th class="text-primary">Role</th>
            <td>: <span class="badge text-primary fs-6" style="background-color: #DAEAFF; color: #000;">Admin</span></td>
          </tr>
          <tr>
            <th class="text-primary">Email</th>
            <td>: admin@gmail.com</td>
          </tr>
          <tr>
            <th class="text-primary">No. HP</th>
            <td>: 081212121212</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal supplier -->
<div class="modal fade" id="detailModal2" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless fs-6">
          <tr>
            <th class="text-primary">Nama</th>
            <td>: Nama Supplier</td>
          </tr>
          <tr>
            <th class="text-primary">Role</th>
            <td>: <span class="badge text-primary fs-6" style="background-color: #DAEAFF; color: #000;">Supplier</span></td>
          </tr>
          <tr>
            <th class="text-primary">Email</th>
            <td>: supplier@gmail.com</td>
          </tr>
          <tr>
            <th class="text-primary">No. HP</th>
            <td>: 081212121212</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="AddUser" tabindex="-1" aria-labelledby="AddUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="AddUserLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form>
        <div class="modal-body">
        
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nama" placeholder="Nama">
            <label class="text-primary fw-bold" for="nama">Nama</label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" placeholder="Email">
            <label class="text-primary fw-bold" for="email">Email</label>
          </div>

          <div class="form-floating mb-3">
            <select class="form-select" id="role">
              <option value="Choose">-- Choose Role --</option>
              <option value="Admin">Admin</option>
              <option value="Requestor">Requestor</option>
            </select>
            <label class="text-primary fw-bold" for="role">Role</label>
          </div>

          <div class="form-floating mb-3">
            <select class="form-select" id="kategori">
              <option value="Choose">-- Choose Category --</option>
              <option value="Unilever">Unilever</option>
              <option value="Supplier">Supplier</option>
            </select>
            <label class="text-primary fw-bold" for="kategori">Kategori</label>
          </div>

          <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="phone" placeholder="Phone" pattern="[0-9]*" inputmode="numeric" required>
            <label class="text-primary fw-bold" for="phone">Phone</label>
          </div>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
        
      </form>
    </div>
  </div>
</div>



<script>
  document.querySelectorAll('.toggle-table').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelectorAll('.toggle-table').forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      document.querySelectorAll('table[id^="table-"]').forEach(table => {
        table.classList.add('d-none');
      });

      const targetId = this.getAttribute('data-target');
      document.getElementById(targetId).classList.remove('d-none');
    });
  });
</script>



<?php $this->load->view('_partials/footer.php'); ?>