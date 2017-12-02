$(document).ready(function() {    
    if(liste) {
        var datatableDefaults = getDatatableDefaults();
        $('#listeCompetitions_table').DataTable($.extend({}, datatableDefaults, {
            "ajax": Routing.generate('lcs_competitions_liste'),
            "columns": [
                {"data": "nom"},
                {"data": "dates"},
                {"data": "equipes"},
                {"data": "limiteInscriptions"}
            ],
            "columnDefs": [
                { className: "link", "targets": [0]},
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
    }
    else {
        openAddModal(Routing.generate('lcs_competitions_edit', {'id': competition_id}));
    }

});