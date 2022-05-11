const Configurations = {
    init: function () {
        this.AdminList.init();
        this.Roles.init();
    },
    Default: {
        init: function () {
            this.index();
        },

        index: function () {
            const table_id = 'default_datatable';
            const table = $('#'.concat(table_id));
            table.DataTable({
                responsive: true,
            });
        },
    },
    AdminList: {
        init: function () {
            this.index();
        },

        index: function () {
            const table_id = 'datatable_admin_list';
            const table = $(`#${table_id}`);
            table.DataTable({
                responsive: true,
            });
        }
    },
    Roles: {
        init: function () {
            this.index();
        },

        index: function () {
            const table_id = 'datatable_roles';
            const table = $(`#${table_id}`);
            table.DataTable({
                responsive: true,
            });
        }
    }
}

$(function () {
    Configurations.init();
});
