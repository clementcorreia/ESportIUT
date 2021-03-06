$(document).ready(function() {
    var datatableDefaults = getDatatableDefaults();
    $('#listeUtilisateurs_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_users_liste'),
        "columns": [
            {"data": "username"},
            {"data": "mail"},
            {"data": "roles"},
            {"data": "actions"}
        ],
        "columnDefs": [
            { className: "control", "targets": [3], 'orderable': false }
        ]
    }));

    $('#listeUtilisateurs_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var id = $(this).parent().attr("id").split("_")[1];
        openEditModal(Routing.generate('lcs_users_edit',{'id':id}));
    });

    openAddModal(Routing.generate('lcs_users_edit'),{'id': 0});
});