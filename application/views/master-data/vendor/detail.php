<div class="row mb-2">
              <div class="col-sm-6">
                <a href="<?= site_url('master_data/vendor_list');?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a> 
              </div>
              <div class="col-sm-6">
                <div class="d-flex justify-content-end">
                 <button type="button" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;" data-bs-toggle="modal" data-bs-target="#modal-add-material">
                    <i class="fa-solid fa-plus"></i>
                    Add Material to Vendor
                  </button>                      
                  <a href="<?= site_url('master_data/edit_vendor/'._encrypt($vendor->id));?>" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px; width: 150px;margin-right:5px;">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                  </a>                       
                  <button type="button" class="btn btn-sm btn-outline-danger" style="font-weight: 600; border-radius: 50px;width: 150px;" data-bs-toggle="modal" data-bs-target="#modal-delete">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                  </button>    
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
                              <label for="floatingInput" class="fw-bold text-primary">Vendor Code</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->vendor_name;?>" disabled>
                              <label for="floatingInput" class="fw-bold text-primary">Vendor Name</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->est_lead_time;?>" disabled>
                              <label for="floatingInput" class="fw-bold text-primary">Est. Lead Time</label>
                            </div>
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->category;?>" disabled>
                              <label for="floatingInput" class="fw-bold text-primary">Category</label>
                            </div>
                          </div>
                          <!--end::Col-->    
                          <!--begin::Col-->
                          <div class="col-6">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo $vendor->rating;?>" disabled>
                              <label for="floatingInput" class="fw-bold text-primary">Rating</label>
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
                              <label for="floatingInput" class="fw-bold text-primary">Created At</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-floating mb-3">
                              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value ="<?php echo myDate($vendor->time_update);?>" disabled>
                              <label for="floatingInput" class="fw-bold text-primary">Updated At</label>
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
                              <th style="color: #fff;background-color:#001F82;text-align: center;">No.</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Item Code</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Item Name</th>
                              <th style="color: #fff;background-color:#001F82;text-align: center;">Factory</th>
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
          <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Delete Vendor</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  You are going to delete vendor <?php echo $vendor->vendor_name;?> - <?php echo $vendor->vendor_code;?>, all data related with this vendor will be deleted. Are you sure?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">No, Cancel Delete.</button>
                  <a href="<?= site_url('master_data/delete_vendor?id='._encrypt($vendor->id));?>" type="button" class="btn btn-outline-danger">Yes, Delete Data.</a>
                </div>
              </div>
            </div>
          </div>      
          <div class="modal fade" id="modal-add-material" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" class="text-primary" style="color: #001F82;font-weight:600;">Add Material</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="exampleDataList" class="form-label">Please choose material you want to add.</label>
                    <input class="form-control" list="materialOptions" id="selectMaterial" placeholder="Type item code / material code to search...">
                      <datalist id="materialOptions"></datalist>
                    
                    <div style="margin-top: 10px;" id="selectedMaterial"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-outline-primary" id="submitMat" onclick="submit_material()">Add Material</button>
                </div>
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
                "url": "<?= site_url('master_data/get_material_list_by_vendor?id='._encrypt($vendor->vendor_code));?>",
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
<script>
  var URL_AJAX = '<?php echo site_url();?>/ajax';
  var selectedItem = [];

  $(document).ready(function(){
    get_material();
    $('#selectMaterial').on('change', function() {
      var value = $(this).val();
      selectedItem.push(value);
      showHtml(selectedItem)
      $(this).val('');
    });

  });

  function showHtml(item){
    if(item.length > 0){
      var showHtml = '';
      var data;
      for(var i = 0; i < item.length; i++){
        data = '<button type="button" class="btn btn-sm btn-outline-primary" style="font-weight: 600; border-radius: 50px;margin-right:5px;" onclick=remove_selected("'+item[i]+'")> '+ item[i] +' <i class="fa-solid fa-xmark"></i></button>';
        showHtml = showHtml + data;
      }      
      $('#selectedMaterial').html(showHtml);
    }else{
      $('#selectedMaterial').html('');
    }
  }

  function submit_material(){
    $('#submitMat').attr('disabled', true);
    $('#submitMat').text('Processing...');

    var values = {
      "item_code" : selectedItem,
      "vendor_code" : <?php echo $vendor->vendor_code;?>
    };

    $.ajax({
        url: URL_AJAX+"/add_material_to_vendor",
        type: "post",
        data: values ,
        success: function (response) {
           if(response == 1){
              location.reload();
           }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
  }

  function remove_selected(id){
      var newItem = selectedItem.filter(item => String(item) != String(id));
      selectedItem = newItem;

      showHtml(selectedItem);
  }

  function get_material(id){
      $.post(URL_AJAX+"/get_material",{id},function(o){
        $('#materialOptions').html(o);
      });
  } 

  function get_material(id){
      $.post(URL_AJAX+"/get_material",{id},function(o){
        $('#materialOptions').html(o);
      });
  }    

   
</script>