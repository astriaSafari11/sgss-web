<form action="<?= site_url('master_data/update_material');?>" method="post" class="needs-validation" novalidate>
<input type="hidden" name="id" value="<?php echo $material->id;?>">
<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('master_data/material_list');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a>       
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Master Data</li>
                  <li class="breadcrumb-item active" aria-current="page">Update Material</li>
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
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="material Code" name="item_code" value="<?php echo $material->item_code;?>" required readonly>
                          <label for="floatingInput" class="fw-bold text-primary">Material Code</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="item_name" value="<?php echo $material->item_name;?>" required>
                          <label for="floatingInput" class="fw-bold text-primary">Material Name</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="uom" style="height: 56px;" name="uom" required>
                            <option value="" disabled>-- Select UoM --</option>
                            </select>
                            <label for="uom" class="fw-bold text-primary">UoM</label>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="factory" style="height: 56px;" name="factory" required>
                            <option value="" disabled>-- Select Factory --</option>
                            </select>
                            <label for="factory" class="fw-bold text-primary">Factory</label>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                                                     
                      <!--end::Col-->                      
                      <!--begin::Col-->                 
                      <!--end::Col-->    
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
    get_uom('<?php if(isset($material->uom)){echo $material->uom;}?>');
    get_factory('<?php if(isset($material->factory)){echo $material->factory;}?>');
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