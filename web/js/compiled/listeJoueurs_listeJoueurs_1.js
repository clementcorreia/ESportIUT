$(document).ready(function() {
    var datatableDefaults = getDatatableDefaults();
    $('#listeJoueurs_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_joueurs_liste'),
        "columns": [
            {"data": "pseudo"},
            {"data": "prenom"},
            {"data": "nom"},
            {"data": "poste"},
            {"data": "rang"},
        ]
    }));

    $('#listeJoueurs_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var id = $(this).parent().attr("id").split("_")[1];
        openDetailsModal(Routing.generate('lcs_joueurs_details',{'id':id}));
    });
});