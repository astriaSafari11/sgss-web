<div class="col-12">
    <form action="<?php echo site_url('goods_management/item_movement'); ?>" method="post">
        <div class="mb-2 d-flex align-items-center">
            <label for="searchInput" class="small me-2" style="width: 60px;">Search:</label>
            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Input transactions number / item code / desc / area to search" name="keyword" value="<?php echo isset($param_search['keyword']) ? $param_search['keyword'] : ''; ?>">
        </div>
        
        <div class="row g-2 align-items-end mb-2" id="searchContainer">
            <div class="col-auto col-sm-8" style="width: 20%;">
                <label for="filterTransactions" class="small">Transactions:</label>
                <select id="filterTransactions" class="form-select form-select-sm" name="column_search">
                    <option value="all">-- All Transactions --</option>
                </select>
            </div>
            <div class="col-auto col-sm-8" style="width: 20%;">
                <label for="filterItem" class="small">Item:</label>
                <select id="filterItem" class="form-select form-select-sm" name="column_search">
                    <option value="all">-- All Item --</option>
                </select>
            </div>
            <div class="col-auto col-sm-8" style="width: 20%;">
                <label for="filterArea" class="small">Area:</label>
                <select id="filterArea" class="form-select form-select-sm" name="column_search">
                    <option value="all">-- All Area --</option>
                </select>
            </div>
            <div class="col-auto col-sm-8" style="width: 20%;">
                <label for="filterStatus" class="small">Status:</label>
                <select id="filterStatus" class="form-select form-select-sm" name="column_search">
                    <option value="all">-- All Status --</option>
                </select>
            </div>
            <div class="col-auto col-sm-2 d-flex align-items-center gap-2" style="width: 20%;">
                <button class="btn btn-outline-primary btn-sm w-100" type="submit" name="search" data-bs-toggle="tooltip" data-bs-placement="top" title="Search All">
                    <i class="fas fa-search"></i>
                    Search
                </button>
                <button class="btn btn-outline-danger btn-sm w-100" type="submit" name="reset" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset All">
                    <i class="fas fa-sync-alt"></i>
                    Reset
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>




<!-- <div class="col-md-12 col-sm-12 col-12">
        <form action="<?php echo site_url ('goods_management/item_movement'); ?>" method="post">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label for="filterBy1" class="small" style="width: 60px;">Search :</label>
                <input type="text" id="searchInput" class="form-control form-control-sm w-full"
                    style="margin-left: 10px;"
                    placeholder="Input transactions number / item code / desc / area to search" name="keyword"
                    value="<?php echo isset ($param_search['keyword']) ? $param_search['keyword'] : ''; ?>">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div id="searchContainer">
                    <div class="d-flex align-items-center gap-2 search-row mb-1">
                        <label for="filterBy1" class="small" style="width: 100px;">Transactions :</label>
                        <select id="filterBy1" class="form-select form-select-sm" name="column_search"
                            style="width: 250px;">
                            <option value="all">-- All Transactions --</option>
                        </select>

                        <label for="filterBy1" class="small">Item :</label>
                        <select id="filterBy1" class="form-select form-select-sm" name="column_search"
                            style="width: 250px;">
                            <option value="all">-- All Item --</option>
                        </select>
                        <label for="filterBy1" class="small">Area :</label>
                        <select id="filterBy1" class="form-select form-select-sm" name="column_search"
                            style="width: 250px;">
                            <option value="all">-- All Area --</option>
                        </select>
                        <label for="filterBy1" class="small">Status :</label>
                        <select id="filterBy1" class="form-select form-select-sm" name="column_search"
                            style="width: 250px;">
                            <option value="all">-- All Status --</option>
                        </select>
                        <button class="btn btn-outline-primary btn-sm" type="submit" name="search"
                            style="width: 100px;">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                        <button class="btn btn-outline-primary btn-sm" type="submit" name="reset" style="width: 100px;">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div> -->