$(document).ready(function() {
    $('#listeJoueurs_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_joueurs_liste'),
        "columns": [
            {"data": "pseudo"},
            {"data": "prenom"},
            {"data": "nom"},
            {"data": "poste"},
        ]
    }));

    $('#listeJoueurs_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var pseudo = $(this).parent().attr("id").split("_")[1];
        openDetailsModal(Routing.generate('lcs_joueurs_details',{'pseudo':pseudo}));
    });
});