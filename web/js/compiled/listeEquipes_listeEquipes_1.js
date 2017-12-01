$(document).ready(function() {
    var datatableDefaults = getDatatableDefaults();
    $('#listeEquipes_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_equipes_liste'),
        "columns": [
            {"data": "nom"},
            {"data": "slogan"},
            {"data": "capitaine"},
            {"data": "nbJoueurs"},
        ]
    }));

    $('#listeEquipes_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var id = $(this).parent().attr("id").split("_")[1];
        if(!admin) {
            openDetailsModal(Routing.generate('lcs_equipes_details',{'id':id}));    
        }
        else {
            openEditModal(Routing.generate('lcs_equipes_edit',{'id':id}));
        }
    });

    openAddModal(Routing.generate('lcs_equipes_edit'),{'id': null});
});