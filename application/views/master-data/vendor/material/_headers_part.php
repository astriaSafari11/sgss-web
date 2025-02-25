<a href="<?= site_url('master_data/vendor_detail/'._encrypt($vendor_detail->id));?>" class="btn btn-sm btn-outline-primary position-relative" style="font-weight: 600; border-radius: 50px; white-space:nowrap;">
                <i class="fa-solid fa-arrow-left" style="margin-right:5px; margin-left: 5px;"></i>
                  Back
                </a> 
                <button
                        type="button"
                        class="btn btn-sm btn-outline-primary dropdown-toggle"
                        style="font-weight: 600; border-radius: 50px; white-space:nowrap;width:150px"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        Material Menu
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('master_data/edit_vendor_material/'._encrypt($material->id));?>">
                            <i class="fa-solid fa-address-card" style="margin-right:5px; margin-left: 5px;"></i>
                            General Information                           
                        </a></li>                        
                        <li><a class="dropdown-item" href="<?= site_url('master_data/item_movement/'._encrypt($material->id));?>">
                            <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                             Item Movement                          
                        </a></li>                        
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?= site_url('master_data/item_movement/'._encrypt($material->id));?>">
                            <i class="fa-solid fa-boxes-packing" style="margin-right:5px; margin-left: 5px;"></i>
                             Logs                         
                        </a></li>
                      </ul>