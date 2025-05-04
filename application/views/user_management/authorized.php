<head>
	<?php $this->load->view('_partials/head.php'); ?>
</head>

<style>
.menu-button:hover img {
	filter: brightness(0) invert(1); 
}

.menu-button.active {
	background-color: #001F82;
	color: white;
}

.menu-button.active img {
  	filter: brightness(0) invert(1);
}
</style>
<!-- <h4 class="text-primary">tmpt role nanti</h4> -->
<h4 class="fw-bold text-primary">Role Authorization</h4>

<div class="info-box d-flex flex-wrap align-items-stretch mx-1">
  
<div class="mx-3 my-2">
  <div class="row mt-2 col-12">
    <label for="roleSelect" class="form-label">Select a role to define user access permissions:</label>
    <div class="d-flex gap-2">
      <select id="roleSelect" class="form-select w-auto">
        <option selected disabled>--Choose Here--</option>
        <option value="admin">Admin</option>
        <option value="requestor">Requestor</option>
        <option value="approver">Approver</option>
      </select>
      <button class="btn btn-outline-primary">+ Add New Role</button>
    </div>
  </div>

  <!-- Menu buttons -->
<div class="row mt-2 col-12">
  <div id="menuButtons" class="d-flex gap-2 flex-wrap my-3" style="display: none !important;">
    <button class="btn btn-outline-primary menu-button" data-page="home">
		<img
			src="<?= base_url('assets/dist/images/home_icon.png');?>"
			alt="Home Icon"
			class="brand-image icon"
			style="width:30px; height:30px"
		/>Home</button>
    <button class="btn btn-outline-primary menu-button" data-page="goods">
		<img
			src="<?= base_url('assets/dist/images/goods_icon.png');?>"
			alt="Goods Icon"
			class="brand-image icon"
			style="width:30px; height:30px"
			/>Goods</button>
    <button class="btn btn-outline-primary menu-button" data-page="service">
		<img
			src="<?= base_url('assets/dist/images/service_icon.png');?>"
			alt="Service Icon"
			class="brand-image icon"
			style="width:30px; height:30px"
			/>Service</button>
    <button class="btn btn-outline-primary menu-button" data-page="saving">
		<img 
			src="<?= base_url('assets/dist/images/saving_icon.png'); ?>" 
			alt="Saving Icon" 
			class="brand-image icon ms-2" 
			style="width:30px; height:30px"
			/>Saving</button>
    <button class="btn btn-outline-primary menu-button" data-page="user"><i class="bi bi-person-gear fs-4 ms-2"></i>User Management</button>
  </div>
</div>

  <!-- Access checkboxes -->
  <div id="accessContainer" class="row col-12 ms-2" style="display: none;">
    <h5 class="mb-3 text-primary" id="accessTitle">Access List</h5>
    <div id="accessList" class="row row-cols-1 row-cols-md-2 g-2">
      <!-- isi akses nanti -->
    </div>
  </div>
</div>

</div>

<script>
const roleSelect = document.getElementById("roleSelect");
const menuButtons = document.getElementById("menuButtons");
const accessContainer = document.getElementById("accessContainer");
const accessList = document.getElementById("accessList");
const accessTitle = document.getElementById("accessTitle");

const accessByPage = {
  home: ["Manage User", "View Dashboard"],
  goods: ["Request Goods", "View Goods", "Track Delivery"],
  service: ["Request Service", "Approve Service", "Service History"],
  saving: ["View Saving Dashboard", "Download Report", "Set Saving Event"],
  user: ["Add User", "Edit Role", "Delete User", "Reset Password"]
};

// Tampilkan menu buttons saat role dipilih
roleSelect.addEventListener("change", () => {
  menuButtons.style.display = "flex";
  accessContainer.style.display = "none";
});

// Gabungkan semua event klik button di sini
document.querySelectorAll(".menu-button").forEach(button => {
  button.addEventListener("click", function () {
    const page = this.getAttribute("data-page");
    const accessItems = accessByPage[page] || [];

    // Toggle tombol aktif
    document.querySelectorAll(".menu-button").forEach(btn => btn.classList.remove("active"));
    this.classList.add("active");

    // Set judul akses
    accessTitle.textContent = `Access List for ${capitalize(page)} Page`;

    // Kosongkan daftar akses
    accessList.innerHTML = "";

    // Tambahkan checkbox akses
    accessItems.forEach(label => {
      const col = document.createElement("div");
      col.innerHTML = `
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="${page}-${label}">
          <label class="form-check-label" for="${page}-${label}">${label}</label>
        </div>
      `;
      accessList.appendChild(col);
    });

    // Tampilkan access container
    accessContainer.style.display = "block";
  });
});

function capitalize(text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
}

</script>



<?php $this->load->view('_partials/footer.php'); ?>