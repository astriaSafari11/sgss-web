<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('master_data/vendor_list');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a> 
              </div>
              <div class="col-sm-6">
                <div class="d-flex justify-content-end">
                  <a href="<?= site_url('master_data/edit_vendor/'._encrypt($vendor->id));?>" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                  </a>                       
                  <a type="button" class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px;width: 150px;">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                  </a>    
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-sm-3">
                <a href="<?= site_url('master_data/vendor_list');?>" class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                  General Information
                </a> 
              </div>
            </div>            
            <!--begin::Row-->
            <div class="row">
              <div class="col-12 mb-4">
                <!-- Default box -->
                <div class="card">                 
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <div class="row">
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->vendor_code;?>" disabled>
                              <label for="floatingInput">Vendor Code</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->vendor_name;?>" disabled>
                              <label for="floatingInput">Vendor Name</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->est_lead_time;?>" disabled>
                              <label for="floatingInput">Est. Lead Time</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->category;?>" disabled>
                              <label for="floatingInput">Category</label>
                            </div>
                          </div>
                          <!--end::Col-->    
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->rating;?>" disabled>
                              <label for="floatingInput">Rating</label>
                            </div>
                          </div>
                          <!--end::Col-->                                                             
                        </div>                    
                      </div>
                      <div class="col-4">
                        <div class="row">                                                            
                          <!--begin::Col-->
                          <div class="col-12">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myDate($vendor->time_add);?>" disabled>
                              <label for="floatingInput">Created At</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myDate($vendor->time_update);?>" disabled>
                              <label for="floatingInput">Updated At</label>
                            </div>
                          </div>
                                                    <!--end::Col-->
                        </div>                    
                      </div>           
                    </div>                     
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>          
            <div class="row mb-2">
              <div class="col-sm-3">
                <a href="<?= site_url('master_data/vendor_list');?>" class="btn btn-primary position-relative" style="font-weight: 600; white-space:nowrap;">
                  Item List
                </a> 
              </div>
            </div>            
            <!--begin::Row-->            
            <div class="row">
              <div class="col-12 mb-4">
              <table id="table-item" class="table table-bordered" width="100%">
                      <thead  style="text-align: center;white-space:nowrap;">
                          <tr >
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Item</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">UoM</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Price / UoM</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">MoQ</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Total Price</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Total Price If Qty = MoQ</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Price MoQ/MoQ</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Saving</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Place To Buy</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Link</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody style="text-align: center;white-space:nowrap;vertical-align:center;">                       
                      </tbody>
                    </table> 
              </div>
            </div>                          
          </div>
          <script>
      $(document).ready(function() {
          $('#table-item').DataTable({
              scrollX: true,
              "processing": true, 
              "serverSide": true, 
              "ordering": false,
              "ajax": {
                "url": "<?= site_url('master_data/get_material_list_by_vendor?vendor_code='._encrypt($vendor->vendor_code));?>",
                "type": "POST"
              },
              "order": [],        
              "columnDefs": [
                {
                    targets: '_all',
                    createdCell: function(cell) {
                      $(cell).css('vertical-align', 'middle');
                    }
                }
            ],
          });      
      });
</script>