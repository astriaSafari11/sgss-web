<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container--bootstrap-5 .select2-selection {
        width: 100%;
        min-height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-family: inherit;
        /* font-size: 1rem;
        font-weight: 400; */
        /* line-height: 1.5; */
        color: #212529;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15sease-in-out, box-shadow .15sease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        /* height: 58px; */
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        font-size: 0.875rem;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        /* padding-left: 8px;
      padding-right: 20px; */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-top: 2px;
    }
</style>
<div class="col-12">
    <div class="mb-2 d-flex align-items-center">
        <label for="searchInput" class="small me-2" style="width: 60px;">Search:</label>
        <input type="text" id="searchInput" class="form-control form-control-sm"
            placeholder="Input transactions number / item code / desc / area to search" name="keyword"
            value="<?php echo isset ($param_search['keyword']) ? $param_search['keyword'] : ''; ?>">
    </div>

    <div class="row g-2 align-items-end mb-2" id="searchContainer">
        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterTransactions" class="small">Transactions:</label>
            <select id="filterTransactions" class="form-select" name="transactions" id="filterTransactions">
                <option value="">-- All Transactions --</option>
            </select>
        </div>
        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterItem" class="small">Item:</label>
            <select id="filterItem" class="form-select" name="item">
                <option value="">-- All Item --</option>
                <?php foreach ($item_list as $k => $v)
                {
                $s = isset ($param_search['item']) && $param_search['item'] == $v->id ? 'selected' : '';
                ?>
                    <option value="<?php echo $v->id; ?>" <?php echo $s; ?>><?php echo $v->item_name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterArea" class="small">Area:</label>
            <select id="filterArea" class="form-select" name=" area" id="filterArea">
                <option value="">-- All Area --</option>
                <?php foreach ($area_list as $k => $v)
                {
                $s = isset ($param_search['area']) && $param_search['area'] == $v->area_code ? 'selected' : '';
                ?>
                    <option value="<?php echo $v->area_code; ?>" <?php echo $s; ?>><?php echo $v->area_name; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterStatus" class="small">Status:</label>
            <select id="filterStatus" class="form-select" name="status" id="status">
                <option value="">-- All Status --</option>
                <option value="understock" <?php echo isset ($param_search['status']) && $param_search['status'] == 'understock' ? 'selected' : ''; ?>>UNDERSTOCK</option>
                <option value="overstock" <?php echo isset ($param_search['status']) && $param_search['status'] == 'overstock' ? 'selected' : ''; ?>>OVERSTOCK</option>
                <option value="ok" <?php echo isset ($param_search['status']) && $param_search['status'] == 'ok' ? 'selected' : ''; ?>>OK</option>
            </select>
        </div>
        <div class="col-auto col-sm-2 d-flex align-items-center gap-2" style="width: 20%;">
            <button class="btn btn-outline-primary w-100" type="submit" name="search" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Search All">
                <i class="fas fa-search"></i>
                Search
            </button>
            <button class="btn btn-outline-danger w-100" type="submit" name="reset" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Reset All">
                <i class="fas fa-sync-alt"></i>
                Reset
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<script>
    var URL_AJAX = '<?php echo base_url (); ?>index.php/ajax';
    $(document).ready(function () {
        $('#filterItem').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),

        });

        $('#filterArea').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    });
</script>