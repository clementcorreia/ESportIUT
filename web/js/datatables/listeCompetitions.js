$(document).ready(function() {
    $('#listeCompetitions_table').DataTable($.extend({}, datatableDefaults, {
        "ajax": Routing.generate('lcs_competitions_liste'),
        "columns": [
            {"data": "nom"},
            {"data": "dateDebut"},
            {"data": "dateFin"},
            {"data": "equipes"}
        ]
    }));

    $('#listeCompetitions_table tbody').on('click', 'td:not(.select-checkbox,.control,.link)', function () {
        var nom = $(this).parent().attr("id").split("_")[1];
        openDetailsModal(Routing.generate('lcs_competitions_details',{'nom':nom}));
    });
});