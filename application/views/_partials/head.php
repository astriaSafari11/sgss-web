<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Unilever | SGSS</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Unilever | SGSS" />
    <meta name="author" content="astria.safari@ivs.co.id" />
    <meta
      name="description"
      content="UNILEVER SGSS"
    />
    <!--end::Primary Meta Tags-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/dist/images/logos/favicon.ico');?>" />    
    <!--begin::Fonts-->
    <!-- <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <script src="https://kit.fontawesome.com/53a51106e3.js" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.css');?>"/>
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" style="color: #001F82; font-weight: 800; font-size: 24px; margin-bottom: 5px;">
                <i class="bi bi-list"></i> <?php echo $this->session->flashdata('page_title'); ?>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-location-dot" style="color: #001F82;"></i>
                <span class="d-none d-md-inline">Factory HCL</span>
                <!-- <span class="navbar-badge badge text-bg-danger">3</span> -->
              </a>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill" style="color: #001F82;"></i>
                <span class="navbar-badge badge text-bg-warning">1</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <!-- <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li> -->
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="<?= base_url('assets/dist/assets/img/user2-160x160.jpg');?>"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline" style="color: #001F82;">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="<?= base_url('assets/dist/assets/img/user2-160x160.jpg');?>"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-white shadow" data-bs-theme="light">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="home.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="<?= base_url('assets/dist/assets/img/unilever-logo.png');?>"
              alt="Unilever Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text font-bold text-primary" style="font-weight: 800; font-size: 24px; margin-bottom: 5px;">SGSS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="<?= site_url('dashboard');?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-house fa-xl"></i>
                  <p>Home</p>
                </a>
              </li>          
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-dolly fa-xl"></i>
                  <p>
                    Master Data
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url('master_data');?>" class="nav-link">
                      <p>Vendor Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('master_data/material');?>" class="nav-link">
                      <p>Material Data</p>
                    </a>
                  </li>
                </ul>
              </li>                 -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill fa-xl"></i>
                  <p>
                    Goods Management
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= site_url('goods_management');?>" class="nav-link">
                      <i class="nav-icon fa-solid fa-chart-area"></i>
                      <p>Performance Dashboard</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('item_movement');?>" class="nav-link">
                      <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                      <p>Stock Card</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('transactions');?>" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Transaction Card</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= site_url('master_data');?>" class="nav-link">
                      <i class="nav-icon fa-solid fa-dolly fa-xl"></i>
                      <p>Master Data</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('service_management');?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-hand-holding-heart fa-xl"></i>
                  <p>Service Management</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="<?= site_url('saving_simulator');?>" class="nav-link">
                  <i class="nav-icon fa-solid fa-hand-holding-dollar fa-xl"></i>
                  <p>Savings Simulator</p>
                </a>
              </li>                              
            </ul>
            <!--end::Sidebar Menu-->        
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <!-- <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Collapsed Sidebar</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Collapsed Sidebar</li>
                </ol>
              </div>
            </div> -->
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
