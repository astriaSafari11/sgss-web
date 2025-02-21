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
      
      <div class="toast-container position-fixed top-0 end-0 p-3">
        <?php 
            if($this->session->flashdata('toast') && $this->session->flashdata('toast')['show'] == true){
              echo showToast($this->session->flashdata('toast')['type'],$this->session->flashdata('toast')['msg']);
            }
          ?>    
      </div>       
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->

    <script>
      $(document).ready(function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
          return new bootstrap.Toast(toastEl)
        })        

        <?php if($this->session->flashdata('toast') && $this->session->flashdata('toast')['show'] == true): ?>
          toastList.forEach(toast => toast.show())
        <?php endif ?>	 
        <?php $this->session->set_flashdata('toast', '');?>
      });

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