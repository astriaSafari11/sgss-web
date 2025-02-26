   
                <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-sm btn-outline-primary dropdown-toggle"
                        style="font-weight: 600; border-radius: 50px; white-space:nowrap;width:150px"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        Master Data
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('master_data/uom');?>">
                            <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
                            UoM                           
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('master_data/category');?>">
                            <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
                            Category                    
                        </a></li>                        
                        <li><a class="dropdown-item" href="<?= site_url('master_data/factory');?>">
                            <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
                            Factory                   
                        </a></li>                        
                        <li><a class="dropdown-item" href="<?= site_url('master_data/vendor_list');?>">
                            <i class="fa-solid fa-address-card" style="margin-right:5px; margin-left: 5px;"></i>
                            Vendor                           
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('master_data/material_list');?>">
                            <i class="fa-solid fa-box-archive" style="margin-right:5px; margin-left: 5px;"></i>
                            Material                    
                        </a></li>                        
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?= site_url('master_data');?>">
                            <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                            Material by Vendor                            
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('master_data/material');?>">
                            <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                            Material by Factory                            
                        </a></li>
                      </ul>
</div >         
<a type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px; width: 150px;">
                        <i class="fa-solid fa-file-export"></i>
                        Export
                      </a>                       
                      <a type="button" class="btn btn-sm btn-outline-danger position-relative" style="font-weight: 600; border-radius: 50px;width: 150px;">
                      <i class="fa-solid fa-file-import"></i>
                        Import
                      </a>     
                