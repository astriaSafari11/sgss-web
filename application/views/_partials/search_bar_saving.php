<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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

    /* khusus untuk multiple dropdown search */

    .custom-multiselect {
        position: relative;
        font-size: 14px;
    }

    .dropdown-arrow {
        position: absolute;
        right: 12px;
        color: rgb(33, 35, 36) !important;
        pointer-events: none;
        font-size: 12px;
        text-shadow: 0 0 1px currentColor;
    }


    .selected-display {
        padding: 8px;
        border: 1px solid #ccc;
        background: #fff;
        cursor: pointer;
        border-radius: 4px;
    }

    .dropdown-options {
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        border: 1px solid #ccc;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        z-index: 99;
        border-radius: 4px;
    }

    .dropdown-options label {
        display: block;
        padding: 8px;
        cursor: pointer;
    }

    .dropdown-options label:hover {
        background: #f0f0f0;
    }

    .custom-multiselect .selected-display {
        display: flex;
        justify-content: space-between;
        border: 1px solid #ced4da;
        border-radius: 0.2rem;
        padding: 0.375rem 0.75rem;
        min-height: 30px;
        cursor: pointer;
        background-color: white;
    }

    .custom-multiselect .dropdown-options {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        z-index: 1000;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        margin-top: 2px;
        padding: 0.5rem;
    }

    .dropdown-search {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
        width: 100%;
        font-size: 14px;
        margin-bottom: 8px;
        transition: box-shadow 0.3s ease;
        /* Tambahkan transisi agar efek shadow halus */
    }

    .dropdown-search:focus {
        outline: none;
        /* Menghilangkan outline default */
        box-shadow: 0 0 8px 2px rgba(137, 194, 255, 0.6);
        /* Efek shadow biru */
    }

    /* .select2-container--bootstrap-5 .select2-results__option {
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
    } */

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
            <label for="filterItemGroup" class="small">Item Group:</label>
            <select id="filterItemGroup" class="form-select" name="item_group" id="filterItemGroup">
                <option value="">-- Item Group --</option>
                
            </select>
        </div>

        <div class="col-auto col-sm-8 custom-multiselect" style="width: 20%;">
            <label for="filterItem" class="fs-7">Item:</label>
            <div class="selected-display" onclick="toggleDropdown()">
                <span class="selected-text">-- All Item --</span>
                <span class="dropdown-arrow"><i class="bi bi-chevron-down"></i></span>
            </div>
            <div class="dropdown-options">
                <input type="text" class="dropdown-search" placeholder="Search item..." onkeyup="filterDropdown(this)"
                    name="item">
                <?php foreach ($item_list as $k => $v) :
                    $checked = isset ($param_search['item']) && in_array ($v->id, (array) $param_search['item']) ? 'checked' : '';
                    ?>
                    <label>
                        <input type="checkbox" value="<?= $v->id ?>" onchange="updateSelection()" <?= $checked ?>
                            name="item[]">
                        <?= htmlspecialchars ($v->item_name) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
        <input type="hidden" name="selected_items" id="selectedItemsInput">


        <div class="col-auto col-sm-8" style="width: 20%;">
            <label for="filterUom" class="small">UoM</label>
            <select id="filterUom" class="form-select" name="uom" id="filterUom">
                <option value="">-- All UoM --</option>
                <?php foreach ($area_list as $k => $v)
                {
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
                <option value="FAST MOVING" <?php echo isset ($param_search['status']) && $param_search['status'] == 'FAST MOVING' ? 'selected' : ''; ?>>FAST MOVING</option>
                <option value="SLOW MOVING" <?php echo isset ($param_search['status']) && $param_search['status'] == 'SLOW MOVING' ? 'selected' : ''; ?>>SLOW MOVING</option>
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
    var URL_AJAX = '<?php echo base_url (); ?>index.php/ajax';
    $(document).ready(function () {
        //         $('#filterItem').select2({
        //     theme: "bootstrap-5",
        //     placeholder: "-- All Item --",
        //     allowClear: true,
        //     closeOnSelect: false,
        //     width: '100%',
        //     dropdownParent: $('#wrapperFilterItem'),
        //     templateSelection: function(data, container) {
        //         if (data.id === '') return data.text;
        //         var selected = $('#filterItem').select2('data');
        //         if (selected.length === 0) return "-- All Item --";
        //         return selected.length + ' selected';
        //     },
        //     templateResult: function (data) {
        //         if (!data.id) {
        //             return data.text;
        //         }

        //         var $checkbox = $('<span><input type="checkbox" style="margin-right: 6px;" /> ' + data.text + '</span>');

        //         const selected = $('#filterItem').val() || [];
        //         if (selected.includes(data.id)) {
        //             $checkbox.find('input').prop('checked', true);
        //         }

        //         return $checkbox;
        //     }
        // });

        // $('#filterItem').on('select2:unselect', function(e) {
        //     if ($('#filterItem').val() === null || $('#filterItem').val().length === 0) {
        //         $(this).val('').trigger('change');
        //     }
        // });

        $('#filterUom, #filterStatus, #filterItemGroup').select2({
            theme: "bootstrap-5",
            width: '100%',
            dropdownParent: $('#searchContainer')
        });
    });

    $('#yourSelect').on('change', function () {
        let selected = $(this).select2('data').map(e => e.text).join(', ');
        $('.select2-selection__rendered').html(selected);
    });

    function toggleDropdown() {
        const dropdown = document.querySelector('.dropdown-options');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    function updateSelection() {
        const checkboxes = document.querySelectorAll('.dropdown-options input[type="checkbox"]');
        const selectedValues = [];
        const selectedLabels = [];

        checkboxes.forEach(cb => {
            if (cb.checked) {
                selectedValues.push(cb.value);
                selectedLabels.push(cb.parentElement.textContent.trim());
            }
        });

        document.getElementById('selectedItemsInput').value = selectedValues.join(',');

        const display = document.querySelector('.selected-display .selected-text');
        if (selectedLabels.length === 0) {
            display.textContent = '-- All Item --';
            display.title = '';
        } else if (selectedLabels.length === 1) {
            const label = selectedLabels[0];
            const truncated = label.length > 20 ? label.slice(0, 17) + '...' : label;
            display.textContent = truncated;
            display.title = label; // tooltip
        } else {
            display.textContent = `${selectedLabels.length} selected`;
            display.title = selectedLabels.join(', ');
        }
    }

    function filterDropdown(input) {
        const filter = input.value.toLowerCase();
        const items = input.parentElement.querySelectorAll('label');

        items.forEach(label => {
            const text = label.textContent.toLowerCase();
            label.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    document.addEventListener('click', function (event) {
        const customSelect = document.querySelector('.custom-multiselect');
        const dropdown = document.querySelector('.dropdown-options');

        if (!customSelect.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });

</script>