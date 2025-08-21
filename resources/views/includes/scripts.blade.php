<script>
    function dynamicDataTable(tableId, options) {
        $tbl = $(tableId);
        $tbl.find('thead tr').addClass('bg-primary');
        $tbl.removeClass('table-striped table-hover');
        var defaults = {
            processing: true,
            serverSide: false,
            scrollX: false,
            responsive: true,
            scrollCollapse: true,
            paging: false,
            bInfo: false,
            searching: true,
            ordering: false,
            fixedColumns: false,
            oLanguage: {
                oAria: {
                    sSortAscending: ": activate to sort column ascending",
                    sSortDescending: ": activate to sort column descending"
                },
                oPaginate: {
                    sFirst: "First",
                    sLast: "Last",
                    sNext: "»",
                    sPrevious: "«"
                },
                sEmptyTable: "لا يوجد بيانات",
                sInfo: "عرض من " + "_START_" + " إلى " + "_END_" + " ل " + "_TOTAL_" + " مدخلات ",
                sInfoEmpty: "عرض من 0 إلى 0 ل 0 مدخلات",
                sInfoFiltered: "(تمت تصفيته _MAX_ من إجمالي صفوف )",
                sInfoPostFix: "",
                sDecimal: "",
                sThousands: ",",
                sLengthMenu: "إظهار _MENU_ صفوف ",
                sLoadingRecords: "تحميل...",
                sProcessing: "تحميل...",
                sSearch: "",
                sSearchPlaceholder: "بحث",
                sUrl: "",
                sZeroRecords: "No matching records found"
            },
        };
        options = (options) ? $.extend(true, {}, defaults, options) : $.extend(true, {}, defaults);
        var dt = $tbl.DataTable(options);
        if (options.paging == true) {
            var dd = $(tableId + '_length').parent();
            dd.removeAttr('class');
            dd.addClass('col-sm-12 col-md-3');
        }
        return dt;
    }

    function toastrOptions() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "rtl": true,
            "positionClass": ("{{ isArabicLanguage() }}") ? "toast-top-left" : "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 200,
            "hideDuration": 300,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "linear",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "fadeOut"
        }
    }

    function ShowToastrError(msg) {
        toastrOptions();
        toastr.error(msg);
    }

    function ShowToastrSuccess(msg) {
        toastrOptions();
        toastr.success(msg);
    }

    function ShowSwError(msg) {
        Swal.fire({
            type: 'error',
            title: msg,
            showConfirmButton: false,
            timer: 2000
        });
    }

    function ShowSwSuccess(msg) {
        Swal.fire({
            type: 'success',
            title: msg,
            showConfirmButton: false,
            timer: 1800
        });
    }

    function SwalConfirm(options, confirmCallBack, cancelCallBack) {
        var defaultParams = {
            title: '',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('m.yes') }}",
            cancelButtonText: "{{ trans('m.cancel') }}",
            reverseButtons: true,
            showConfirmButton: true,
            titleText: '',
            text: '',
            html: '',
            footer: '',
            toast: false,
            allowOutsideClick: true,
            allowEscapeKey: true,
            allowEnterKey: true,
            stopKeydownPropagation: true,
            buttonsStyling: true,
            focusConfirm: true,
            focusCancel: false,
            showCloseButton: true,
            closeButtonHtml: '&times;',
            showLoaderOnConfirm: false,
            width: null,
            padding: null,
            background: null,
            input: null,
            inputPlaceholder: '',
            inputValue: '',
            inputOptions: {},
            inputAutoTrim: true,
            inputClass: '',
            inputAttributes: {},
            inputValidator: null,
            validationMessage: null,
            grow: false,
            position: 'center',
            progressSteps: [],
            currentProgressStep: null,
            progressStepsDistance: null,
            onBeforeOpen: null,
            onOpen: null,
            onRender: null,
            onClose: null,
            onAfterClose: null,
            onAfterClose: null,
            scrollbarPadding: true
        };
        var iconTypes = ['success', 'warning', 'info', 'question', 'error'];
        options = $.extend(true, {}, defaultParams, options);
        Swal.fire(options).then((result) => {
            if (result.value) {
                if (confirmCallBack)
                    confirmCallBack();
            } else if (result.dismiss === 'cancel') {
                if (cancelCallBack)
                    cancelCallBack();
            }
        });
    }
</script>

<script type="text/javascript">
    setTimeout(() => {
        var prefix = '{{ getCurrentRoutePrefix() }}';
        var $elm = $('#sidebar-nav li a[r="' + prefix + '"]');
        $elm.addClass('active');
        $elm.parents('li').addClass('menu-open');
        $elm.parents('li').children('a').addClass('active');
    }, 200)
</script>
