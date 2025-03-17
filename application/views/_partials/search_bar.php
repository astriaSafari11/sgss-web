<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Start Dropdown Show X Entries -->
    <div class="d-flex align-items-center">
        <label for="entriesSelect" class="me-2 fs-7">Show</label>
        <select id="entriesSelect" class="form-select form-select-sm w-auto fs-7">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ms-2 fs-7">entries</span>
    </div>
    <!-- End Dropdown Show X Entries -->

    <!-- Start Search + Filter -->
    <div class="d-flex align-items-center gap-2">
    <!-- Filter 1 -->
    <label for="filterBy1" class="small">Column Search:</label>
    <select id="filterBy1" class="form-select form-select-sm w-auto" name="column_search">
        <option value="all">All</option>
        <?php foreach($column_search as $k => $v){ 
            $s = isset($param_search['column_search']) && $param_search['column_search'] == $v ? 'selected' : '';
        ?>
        <option value="<?php echo $v;?>" <?php echo $s;?>><?php echo str_replace('_', ' ', $v);?></option>
        <?php } ?>
    </select>

    <!-- Filter 2 -->
    <label for="filterBy2" class="small">Filter 2:</label>
    <select id="filterBy2" class="form-select form-select-sm w-auto" name="column_filter">
        <option value="like" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == 'like' ? 'selected' : '';?> >Contain</option>
        <option value="=" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '=' ? 'selected' : '';?> >Is</option>
        <option value="!=" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '!=' ? 'selected' : '';?>>Not</option>
        <option value=">" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '>' ? 'selected' : '';?>>Greater Than</option>
        <option value="<" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '<' ? 'selected' : '';?>>Less Than</option>
        <option value="=" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '=' ? 'selected' : '';?>>Equal</option>
        <option value=">=" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '>=' ? 'selected' : '';?>>Greater Than Equal</option>
        <option value="<=" <?php echo isset($param_search['column_filter']) && $param_search['column_filter'] == '<=' ? 'selected' : '';?>>Less Than Equal</option>
    </select>

    <!-- Filter 3 -->
    <label for="filterBy3" class="small">Keyword:</label>
    <input type="text" id="searchInput" class="form-control form-control-sm w-auto" placeholder="Search" name="keyword" value="<?php echo isset($param_search['keyword']) ? $param_search['keyword'] : '';?>">


    <!-- Search Button -->
    <button class="btn btn-outline-primary btn-sm" type="submit" name="search" id="searchBtn">
        <i class="fas fa-search"></i>
    </button>
    <button class="btn btn-outline-primary btn-sm" type="submit" name="reset" id="searchBtn">
        Reset
    </button>
</div>
  <!--End Search Bar-->
    </div>