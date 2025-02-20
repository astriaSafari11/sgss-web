<form action="<?= site_url('master_data/save_material');?>" method="post" class="needs-validation" novalidate>
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
                  <li class="breadcrumb-item active" aria-current="page">Add Material</li>
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
                        <select class="form-select" aria-label="Default select example" style="height: 56px;" name="vendor_code" required>
                          <option value="">-- Select Vendor --</option>
                          <option value="530859">Vendor A</option>
                        </select>
                        <div class="invalid-feedback">This field is required.</div>
                      </div>
                      <!--begin::Col-->                        
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="material Code" name="item_code" required>
                          <label for="floatingInput">Material Code</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="item_name" required>
                          <label for="floatingInput">Material Name</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" style="height: 56px;" name="uom" required>
                            <option value="">-- Select UoM --</option>
                            <option value="ml">ml</option>
                            </select>
                            <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <!--end::Col-->
                      <!--begin::Col-->
                      <div class="col-6">
                        <select class="form-select" aria-label="Default select example" style="height: 56px;" name="factory" required>
                          <option value="">-- Select Factory --</option>
                          <option value="liquid">Liquid</option>
                        </select>
                        <div class="invalid-feedback">This field is required.</div>
                      </div>
                      <!--begin::Col-->
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="lt_pr_po" required>
                          <label for="floatingInput">Est. Lead Time PO</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="lot_size" required>
                          <label for="floatingInput">Lot Size</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                      
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="initial_value_stock" required>
                          <label for="floatingInput">Initial Value Stock</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                      
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="order_cycle" required>
                          <label for="floatingInput">Order Cycle</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>            
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="initial_stock" required>
                          <label for="floatingInput">Initial Stock</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="standart_safety_stock" required>
                          <label for="floatingInput">Standart Safety Stock</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>  
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="initial_value_for_to_do" required>
                          <label for="floatingInput">Initial Value (todo list)</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                                                       
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="price_per_uom" required>
                          <label for="floatingInput">Price Per UoM</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                 
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="price_equal_moq" required>
                          <label for="floatingInput">Price Equal UoM</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                 
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="moq" required>
                          <label for="floatingInput">MOQ</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                 
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="place_to_buy" required>
                          <label for="floatingInput">Place To Buy</label>
                          <div class="invalid-feedback">This field is required.</div>
                        </div>
                      </div>                 
                      <div class="col-6">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="link" required>
                          <label for="floatingInput">Link</label>
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