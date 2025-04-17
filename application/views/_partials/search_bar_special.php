<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container--bootstrap-5 {
        width: 100% !important;
    }
    
    .select2-container--bootstrap-5 .select2-selection {
        min-height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-family: inherit;
        font-size: 0.875rem;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
    
    /* Multiple select styles */
    .select2-container--bootstrap-5 .select2-selection--multiple {
        padding: 0.25rem 0.5rem;
    }
    
    /* Placeholder style */
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered {
        display: block !important;
    }
    
    .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__placeholder {
        color: #6c757d;
        margin-left: 5px;
    }
    
    /* Checkbox styles */
    .select2-container--bootstrap-5 .select2-results__option {
        position: relative;
        padding-left: 30px !important;
    }
    
    .select2-container--bootstrap-5 .select2-results__option:before {
        content: "";
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        border: 1px solid #adb5bd;
        background: white;
        box-sizing: border-box;
    }
    
    .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"]:before {
        background-color: #0d6efd;
        border-color: #0d6efd;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center;
    }
    
    /* Hide selected tags */
    /* .select2-selection__choice {
        display: none !important;
    } */

    /* .select2-selection__rendered {
        white-space: normal !important;
        word-break: break-word;
    } */
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

        <div class="col-auto col-sm-8 custom-" style="width: 20%;" id="wrapperFilterItem">
            <label for="filterItem" class="small">Item:</label>
            <select id="filterItem" class="form-select js-states form-control" name="item[]" multiple="multiple">
                <option value="">-- All Item --</option>
                <?php foreach ($item_list as $k => $v) {
                $s = isset ($param_search['item']) && in_array($v->id, (array)$param_search['item']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $v->id; ?>" <?php echo $s; ?>><?php echo $v->item_name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterArea" class="small">Area:</label>
            <select id="filterArea" class="form-select" name="area" id="filterArea">
                <option value="">-- All Area --</option>
                <?php foreach ($area_list as $k => $v) {
                $s = isset ($param_search['area']) && $param_search['area'] == $v->area_code ? 'selected' : '';
                ?>
                    <option value="<?php echo $v->area_code; ?>" <?php echo $s; ?>><?php echo $v->area_name; ?></option>
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
            <button class="btn btn-outline-primary w-100" type="submit" name="search" id="search"
                data-bs-toggle="tooltip" data-bs-placement="top" title="Search All">
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
    var URL_AJAX = '<?php echo base_url(); ?>index.php/ajax';
    $(document).ready(function() {
        $('#filterItem').select2({
    theme: "bootstrap-5",
    placeholder: "-- All Item --",
    allowClear: true,
    closeOnSelect: false,
    width: '100%',
    dropdownParent: $('#wrapperFilterItem'),
    templateSelection: function(data, container) {
        if (data.id === '') return data.text;
        var selected = $('#filterItem').select2('data');
        if (selected.length === 0) return "-- All Item --";
        return selected.length + ' selected';
    },
    templateResult: function (data) {
        if (!data.id) {
            return data.text;
        }

        var $checkbox = $('<span><input type="checkbox" style="margin-right: 6px;" /> ' + data.text + '</span>');

        const selected = $('#filterItem').val() || [];
        if (selected.includes(data.id)) {
            $checkbox.find('input').prop('checked', true);
        }

        return $checkbox;
    }
});

        $('#filterItem').on('select2:unselect', function(e) {
            if ($('#filterItem').val() === null || $('#filterItem').val().length === 0) {
                $(this).val('').trigger('change');
            }
        });

        $('#filterArea, #filterStatus, #filterTransactions').select2({
            theme: "bootstrap-5",
            width: '100%',
            dropdownParent: $('#searchContainer')
        });
    });

    $('#yourSelect').on('change', function () {
        let selected = $(this).select2('data').map(e => e.text).join(', ');
        $('.select2-selection__rendered').html(selected);
    });

    
</script>