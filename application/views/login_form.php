<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>UNILEVER | SGSS</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="UNILEVER | SGSS" />
    <meta name="author" content="astria.safari@ivs.co.id" />
    <!--end::Primary Meta Tags-->
    <style>
      @import url('https://fonts.cdnfonts.com/css/poppins');

      body, html {
      height: 100%;
      margin: 0;
      overflow: hidden; /* Nonaktifkan scroll pada halaman */
      }

      body {
      background-color:rgb(230, 234, 255)
      }

      .login-box {
        position: relative;
        z-index: 1;
        border-radius: 10px;
      }

      .circle1, .circle2 {
      position: absolute;
      z-index: 0;
      }

      .circle1 {
      width: 370px;
      height: 370px;
      top: -80px;
      left: -70px;
      }

      .circle2 {
      width: 200px;
      height: 200px;
      bottom:-30px;
      right:-100px;
      }
      </style>    
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/dist/images/logos/favicon.ico');?>" />    
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
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.css');?>"/>
    <!--end::Required Plugin(AdminLTE)-->    
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img
              src="<?= base_url('assets/dist/images/logos/unilever-logo.png');?>"
              alt="Unilever Logo"
              class=""
              width="35"
            />
            <h4 class="mb-0 text-primary" style="font-family: GaretBold;">SSGS Login</h4>
        </div>
        <div class="card-body login-card-body">
          <form action="<?= site_url('auth/login');?>" method="post">
            <div class="input-group mb-2">
              <div class="form-floating">
                <input id="loginEmail" type="text" class="form-control" name="username" value="" placeholder="" />
                <label for="loginEmail" class="fw-bold text-primary fs-7">NIP</label>
              </div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="loginPassword" type="password" class="form-control" name="password" placeholder="" />
                <label for="loginPassword" class="fw-bold text-primary fs-7">Password</label>
              </div>
            </div>
            <a href="#" class="text-primary text-left text-decoration-none fw-bold mb-3 d-block">Forgot Password?</a>
            <!--begin::Row-->
            <?php if($this->session->flashdata('message_login_error')): ?>
              <div class="alert alert-danger" role="alert">
                <small><b>Login Failed !</b> Wrong credentials, please try again.</small> 
              </div>        
            <?php endif ?>	            
            <div class="row">
              <div class="col-12 mt-2">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                        Sign In
                    </button>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
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
    <script src="<?= base_url('assets/dist/js/adminlte.js');?>"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
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
    <img src="<?= base_url('assets/dist/images/backgrounds/circle_asset1.png');?>" class="circle1" />
    <img src="<?= base_url('assets/dist/images/backgrounds/circle_asset2.png');?>" class="circle2" />

  </body>
  <!--end::Body-->
</html>
