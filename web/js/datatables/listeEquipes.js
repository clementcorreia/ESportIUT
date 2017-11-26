$(document).ready(function() {
    $('#listeEquipes_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_equipes_liste'),
        "columns": [
            {"data": "nom"},
            {"data": "slogan"},
        ]
    }));

    $('#listeEquipes_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var nom = $(this).parent().attr("id").split("_")[1];
        openDetailsModal(Routing.generate('lcs_equipes_details',{'nom':nom}));
    });
});