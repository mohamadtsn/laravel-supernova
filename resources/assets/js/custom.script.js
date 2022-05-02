var KTDatatables = function() {
    var admin_list = function() {
        var table = $('#datatable_admin_list');

        // begin first table
        table.DataTable({
            responsive: true,

            // DOM Layout settings
            dom: `<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            lengthMenu: [5, 10, 25, 50, 100],
            pageLength: 10,
            language: {
                'lengthMenu': 'Display _MENU_',
            }
        });
    };
    return {
        init: function() {
            admin_list();
        }
    };
}();
jQuery(document).ready(function() {
    KTDatatables.init();
});


function sweetAlert(id, text, icon, target, confirmText = "بله اطمینان دارم", confirmColor = '#d31', cancelText = "خیر", cancelColor = 'rgb(48, 133, 214)', outside = false) {
    Swal.fire({
        title: "آیا اطمینان دارید؟",
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        reverseButtons: true,
        allowOutsideClick: outside,
        confirmButtonColor: confirmColor,
        cancelButtonColor: cancelColor,
    }).then(function (result) {
        if (result.value) {
            $('#' + target + id).submit();
        }
    });
}


$(document).ready(function () {
    $('.delete-admin').on('click', function () {
        let item_id = $(this).data('delete');
        let text = "مدیریت قابل بازگشت نیست";
        let icon = "warning";
        let target = "deleteAdmin";
        sweetAlert(item_id, text, icon, target);
    });
});
