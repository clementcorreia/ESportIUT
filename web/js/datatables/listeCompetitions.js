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
        var id = $(this).parent().attr("id").split("_")[1];
        if(!admin) {
            window.location.replace(Routing.generate('lcs_competitions_details',{'id':id}));    
        }
        else {
            openEditModal(Routing.generate('lcs_competitions_edit',{'id':id}));
        }
    });

    openAddModal(Routing.generate('lcs_competitions_edit'),{'id': 0});
});