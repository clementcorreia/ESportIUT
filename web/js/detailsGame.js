$(document).ready(function() {
   openAddModal(Routing.generate('lcs_matchs_addGame', {'id': match_id}), 'addGame', true); 
   $(".addModal-addStatJoueur").on('click', function() {
        var manche_id = $(this).data('id');
        openEditModal(Routing.generate('lcs_matchs_addStatJoueur', {'id': manche_id}), 'addStatJoueur', true);
    });
});