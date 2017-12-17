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
                openEditModal(Routing.generate('lcs_competitions_edit',{'id':id}), 'competition');
            }
        });

        openAddModal(Routing.generate('lcs_competitions_edit'),{'id': 0}, 'competition');
    }
    else {
        $(".editModal-group").on('click', function() {
            var poule_id = $(this).data('id');
            openEditModal(Routing.generate('lcs_poules_edit', {'idCompetition': competition_id, 'id': poule_id}), 'group');
        });
        openAddModal(Routing.generate('lcs_competitions_edit', {'id': competition_id}), 'competition');
        openAddModal(Routing.generate('lcs_poules_edit', {'idCompetition': competition_id, 'id': 0}), 'group');
        openAddModal(Routing.generate('lcs_matchs_generateGroupMathes', {'id': competition_id}), 'generateGM');
    }

});