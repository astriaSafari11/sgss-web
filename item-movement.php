<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Unilever | SGSS</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Unilever | SGSS" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
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
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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
                <i class="bi bi-list"></i> SGSS
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
                  src="dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline" style="color: #001F82;">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="dist/assets/img/user2-160x160.jpg"
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
              src="dist/assets/img/unilever-logo.png"
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
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-house" style="color: #001F82;"></i>
                  <p>Home</p>
                </a>
              </li>            
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill" style="color: #001F82;"></i>
                  <p>
                    Goods Management
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="gm-performance-dashboard.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Performance Dashboard</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="item-movement.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Stock Card</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../index3.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Transaction Card</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../index3.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Master Data</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-hand-holding-heart" style="color: #001F82;"></i>
                  <p>Service Management</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa-solid fa-hand-holding-dollar" style="color: #001F82;"></i>
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

            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="info-box text-bg-white">
                  <div class="info-box-content" style="color: #001F82;">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-12">
                        <div class="row mb-3">
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="ALL"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lot Size</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Inventory on-hand</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Item Description</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Lead Time</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <button type="button" class="btn btn-primary" style="font-size: 12px; font-weight: 600; border-radius: 10px;width:100%;">Safety Stock</button>
                          </div>
                          <div class="col-sm-2" style="margin:0px;">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="-"/>
                          </div>
                        </div>
                      </div>           
                    </div>  
                    <div class="row">
                      <div class="row mb-3">
                            <div class="col-md-6 col-sm-6 col-12 ">
                                <h3 class="mb-2 text-primary font-bold">MRP - Table</h3>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12" style="justify-content: flex-end;display: flex;">
                                <button type="button" class="btn btn-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:10px;">
                                    Export
                                </button>                       
                                <button type="button" class="btn btn-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                                    Import
                                </button>                       
                            </div>
                        </div>                      
                      <div class="col-md-12 col-sm-12 col-12">
                      <table class="table table-bordered" style="width:100%" id="example">
                        <thead>
                            <tr >
                                <th style="color: #fff;background-color: #001F82;text-align: center;">Month</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;" colspan="4">January</th>
                                <th style="color: #fff;background-color: #001F82;text-align: center;" colspan="4">February</th>
                            </tr>
                            <tr >
                                <th style="color: #000;background-color:rgb(244, 244, 245);text-align: center;"></th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">1</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">2</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">3</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">4</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">1</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">2</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">3</th>
                                <th style="color: #000;background-color: rgb(244, 244, 245);text-align: center;">4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;background-color:#89cff0;">
                                  <a href="item-movement-detail.php" style="font-weight:600;color: #001F82;">Alkohol</a>
                                </td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;background-color:#89cff0;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                             </tr>
                             <tr>
                                <td style="vertical-align: middle;text-align: center;background-color:#89cff0;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;background-color:#89cff0;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;background-color:#89cff0;font-weight:600;">Alkohol</td>
                                <td style="vertical-align: middle;text-align: center;">100</td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                                <td style="vertical-align: middle;text-align: center;"></td>
                            </tr>
                        </tbody>  
                        </table>  
                      </div>           
                    </div>                                       
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>           
            </div>
            <!--end::Row-->            
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">SGSS v1.1 Copyright &copy; 2025&nbsp;</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <a href="#" class="nav-link font-bold" style="font-weight: 800;color: #001F82;">
          <i class="fa-solid fa-circle-arrow-left" style="color: #001F82;"></i>
          Logout
        </a>
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      $(document).ready(function() {
          $('#example').DataTable();         
      });
    </script>    
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
