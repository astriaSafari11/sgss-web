<form action="<?= site_url('master_data/save_service');?>" method="post" class="needs-validation" novalidate>
<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('service_management/master_data');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a>       
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Master Data</li>
                  <li class="breadcrumb-item active" aria-current="page">Add Service</li>
                </ol>
              </div>
            </div>  
<div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">
                  <div class="card-body">
                    <div class="row">                      
                      <!--begin::Col-->
                      <div class="col-3">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="material Code" name="item_code" value ="auto filled" disabled>
                          <label for="floatingInput" class="fw-bold text-primary">Service Code</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-3">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="item_name" required>
                          <label for="floatingInput" class="fw-bold text-primary">Service Name</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="service_type" style="height: 56px;" name="service_type" required>
                                <option value="" disabled>-- Select Service Type --</option>
                                <option value="cleaning">Cleaning</option>
                                <option value="testing">Testing</option>
                                <option value="qc">QC</option>
                            </select>
                            <label for="uom" class="fw-bold text-primary">Service Type</label>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                      
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="service_recurring" style="height: 56px;" name="service_recurring" required>
                                <option value="" disabled>-- Select Service Recurring --</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="biweekly">Biweekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="bimonthly">Bimonthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annualy">Annualy</option>
                            </select>
                          <label for="floatingInput" class="fw-bold text-primary">Service Recurring</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-3">
                         <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="service_due_date" required>
                          <label for="floatingInput" class="fw-bold text-primary">Due date every xxx month</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>  
                      <div class="col-3">
                         <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="service_urgent_if" required>
                          <label for="floatingInput" class="fw-bold text-primary">Urgent If</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>    
                    </div>                                                  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="submit" name="submit" 
                        class="btn btn-outline-primary" style="font-weight: 600; border-radius: 50px;width: 150px;">Submit</button>
                    </div>                    
                  </div>
                  <!-- /.card-footer-->
                </div>
                <!-- /.card -->
              </div>
            </div>          
</form> 
<script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (() => {
                      'use strict';

                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      const forms = document.querySelectorAll('.needs-validation');

                      // Loop over them and prevent submission
                      Array.from(forms).forEach((form) => {
                        form.addEventListener(
                          'submit',
                          (event) => {
                            if (!form.checkValidity()) {
                              event.preventDefault();
                              event.stopPropagation();
                            }

                            form.classList.add('was-validated');
                          },
                          false,
                        );
                      });
                    })();
                  </script>
<script>
  var URL_AJAX = '<?php echo base_url();?>index.php/ajax';
  $(document).ready(function(){
    get_uom();
    get_factory();
  });

  function get_uom(id){
      $.post(URL_AJAX+"/get_uom",{id},function(o){
        $('#uom').html(o);
      });
  }  

  function get_factory(id){
      $.post(URL_AJAX+"/get_factory",{id},function(o){
        $('#factory').html(o);
      });
  }   
</script>