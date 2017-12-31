function autocollapse() {
    var navbar = $('.navbar.navbar-collapse');
    navbar.removeClass('collapsed');
    if(navbar.innerHeight() > 50) {
        navbar.addClass('collapsed');
    }
}
$(document).on('ready', autocollapse);
$(window).on('resize', autocollapse);

function getDatatableDefaults() {
    var locale = $("#locale").data('locale');
    if(locale == 'fr') { 
        var datatableDefaults = {
            "language": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]]
        };
    }
    else {
        var datatableDefaults = {
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        };
    }
    return datatableDefaults;
}

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-euro-pre": function ( a ) {
        var x;
 
        if ( $.trim(a) !== '' ) {
            var frDatea = $.trim(a).split(' ');
            var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [00,00,00];
            var frDatea2 = frDatea[0].split('/');
            x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + ((undefined != frTimea[2]) ? frTimea[2] : 0)) * 1;
        }
        else {
            x = Infinity;
        }
 
        return x;
    },
 
    "date-euro-asc": function ( a, b ) {
        return a - b;
    },
 
    "date-euro-desc": function ( a, b ) {
        return b - a;
    }
} );

$(document).ready(function() {
    mbs.init.datePicker();
});

// -------------------------------------------------------------------------
// Fonction/Variables communes
// gérant l'ouverture, la gestion des popups
// ----------------------------------------------------------------------------

/*unction openAddModal(url) {
    $('#addModal').on('click', function() {
        openEditModal(url);
    });
}*/

function openAddModal(url, id_modal) {
    $('#addModal-' + id_modal).on('click', function() {
        openEditModal(url, id_modal);
    });
    $('#editModal-' + id_modal).on('click', function() {
        openEditModal(url, id_modal);
    });
}

function openEditModal(url, id_modal) {
    $("#edit_form_container_" + id_modal).load(url + ' #edit_form_container_' + id_modal + ' > *', function (html) {
        $('#edit-modal-' + id_modal).modal('show');
        $('#edit-modal-' + id_modal + ' #titleContainer').empty();
        $('#edit-modal-' + id_modal + ' .modal-body h4').appendTo('#edit-modal-' + id_modal + ' #titleContainer');
        mbs.init.form(id_modal);
    });
}

/*function openAddModal2(url) {
    $('#addModal2').on('click', function() {
        openEditModal(url, 1);
    });
}   

function openEditModal(url, option = 0) {
    if (!option) {
        $("#edit_form_container").load(url + ' #edit_form_container > *', function (html) {
            $('#edit-modal').modal('show');
            $('#edit-modal #titleContainer').empty();
            $('#edit-modal .modal-body h4').appendTo('#edit-modal #titleContainer');
            mbs.init.form();
        });
    }
    else {
        $("#edit_form_container2").load(url + ' #edit_form_container2 > *', function (html) {
            $('#edit-modal2').modal('show');
            $('#edit-modal2 #titleContainer').empty();
            $('#edit-modal2 .modal-body h4').appendTo('#edit-modal2 #titleContainer');
            mbs.init.form();
        });
    }
}*/

function openContentModal(html) {
    $('#edit-modal .modal-body').html(html);
    $('#edit-modal').modal('show');
    $('#edit-modal #titleContainer').empty();
    $('#edit-modal .modal-body h4').appendTo('#edit-modal #titleContainer');
    mbs.init.form();
}

function array_search (needle, haystack, argStrict) {
  //  discuss at: http://phpjs.org/functions/array_search/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Brett Zamir (http://brett-zamir.me)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //  depends on: array
  //        test: skip
  //   example 1: array_search('zonneveld', {firstname: 'kevin', middle: 'van', surname: 'zonneveld'});
  //   returns 1: 'surname'
  //   example 2: ini_set('phpjs.return_phpjs_arrays', 'on');
  //   example 2: var ordered_arr = array({3:'value'}, {2:'value'}, {'a':'value'}, {'b':'value'});
  //   example 2: var key = array_search(/val/g, ordered_arr); // or var key = ordered_arr.search(/val/g);
  //   returns 2: '3'

  var strict = !!argStrict,
    key = ''

  if (haystack && typeof haystack === 'object' && haystack.change_key_case) {
    // Duck-type check for our own array()-created PHPJS_Array
    return haystack.search(needle, argStrict)
  }
  if (typeof needle === 'object' && needle.exec) {
    // Duck-type for RegExp
    if (!strict) {
      // Let's consider case sensitive searches as strict
      var flags = 'i' + (needle.global ? 'g' : '') +
        (needle.multiline ? 'm' : '') +
        // sticky is FF only
        (needle.sticky ? 'y' : '')
      needle = new RegExp(needle.source, flags)
    }
    for (key in haystack) {
      if (haystack.hasOwnProperty(key)) {
        if (needle.test(haystack[key])) {
          return key
        }
      }
    }
    return false;
  }

  for (key in haystack) {
    if (haystack.hasOwnProperty(key)) {
      if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
        return key
      }
    }
  }

  return false ;
}

var mbs = {
    init: {
        datePicker: function (id_modal) {
            jQuery.datetimepicker.setLocale('fr');
            var i=1;
            $('input.date').each(function () {
                var tmpinput = $(this);
                if(tmpinput.data('format')===undefined){
                    tmpinput.data('format','d/m/Y');
                }
                $('#datepicker'+i).remove();
                tmpinput.data('dtp','#datepicker'+i);
                tmpinput.datetimepicker({
                    timepicker:tmpinput.hasClass("withtime"),
                    format: tmpinput.data('format'),
                    dayOfWeekStart: 1,
                    id:'datepicker'+i,
                    scrollInput: false
                });

                $('#edit-modal' + id_modal).on('scroll',function() {
                    if ($(tmpinput.data('dtp')).css('display')!=='none'){
                        tmpinput.datetimepicker('hide');
                        tmpinput.datetimepicker('show');
                    }
                });

                $(window).resize(function() {
                    if($(tmpinput.data('dtp')).css('display')!=='none'){
                        tmpinput.datetimepicker('hide');
                        tmpinput.datetimepicker('show');
                    }
                });

                i++;
            });

            $('input.dateTime').each(function() {
                $(this).datetimepicker({
                    datepicker:false,
                    format:'H:i',
                    step: 15
                });
            });

        },

        submitButton: function (id_modal) {
            $('#edit_form_container_' + id_modal + ' form:first').on('submit', function () {
                var form = $('#edit_form_container_' + id_modal + ' form');
                if (!form.validator('validate').data('bs.validator').hasErrors()) {
                    $.post(form.attr('action'), form.serialize()).done(function (data) {
                        // Si validation serveur OK
                        if (data.res === true) {                            
                            form.trigger('ajaxdone');
                            // Affiche message ok
                            toastr.success($('#' + data.confirmation_message_id).text());
                            var updateTable = function () {
                                setTimeout(function(){ $('#edit-modal-' + id_modal).modal('hide'); }, 200);
                                $('#id_' + data.id).addClass('highlight');
                            };
                            if (typeof window.oTable != 'undefined') {                                
                                window.oTable.ajax.reload(updateTable);

                            } else {                                
                                $('#main_table, .datatable_table').DataTable().ajax.reload(updateTable);
                            }
                            if(data.closeModal === true) {                             
                                setTimeout(function(){ $('#edit-modal-' + id_modal).modal('hide'); }, 200);
                            }
                            if(data.type === 'competition') {
                                var url = Routing.generate('lcs_competitions_details', {'id': data.id});
                                window.location.replace(url);
                            }
                            if(data.type === 'generateGM') {
                                openEditModal(Routing.generate('lcs_matchs_setTourFromMatches', {'id': competition_id}), 'setTourGM');
                            }
                        }
                        // Si validation serveur NOK
                        else if (data.res === false) {
                            if(data.confirmation_message_id)
                            {
                                toastr.error($('#' + data.confirmation_message_id).text());
                            }
                            else{
                            // Boucle sur chaque erreurs
                                $.each(data.errors, function (key, value) {
                                    // Si child existe (password), on boucle sur les childs
                                    if ($.isPlainObject(data.errors[key])) {
                                        $.each(data.errors[key], function (childkey, childvalue) {
                                            if($.isPlainObject(childvalue)){
                                                $.each(data.errors[key][childkey], function (childrenkey, childrenvalue) {
                                                    $('#' + data.form_name + '_' + key + '_' + childkey+'_'+childrenkey).parent().addClass("has-error");
                                                    $('#' + data.form_name + '_' + key + '_' + childkey+'_'+childrenkey).parent().find('.help-block').text(childrenvalue);
                                                });
                                            }
                                            else{
                                                $('#' + data.form_name + '_' + key + '_' + childkey).parent().addClass("has-error");
                                                $('#' + data.form_name + '_' + key + '_' + childkey).parent().find('.help-block').text(childvalue);
                                            }
                                        });

                                    } 
                                    else {
                                        $('#' + data.form_name + '_' + key).parent().addClass("has-error");
                                        $('#' + data.form_name + '_' + key).parent().find('.help-block').text(value);
                                    }
                                });
                            }
                        }
                    });
                    return false;
                }
            });
            /*$('#edit_form_container2 form:first').on('submit', function () {
                var form = $('#edit_form_container2 form');
                if (!form.validator('validate').data('bs.validator').hasErrors()) {
                    $.post(form.attr('action'), form.serialize()).done(function (data) {
                        // Si validation serveur OK
                        if (data.res === true) {                            
                            form.trigger('ajaxdone');
                            // Affiche message ok
                            toastr.success($('#' + data.confirmation_message_id).text());

                            var updateTable = function () {
                                setTimeout(function(){ $('#edit-modal2').modal('hide'); }, 200);
                                $('#' + data.type + '_' + data.id).effect("highlight", {color: '#A9E2F3'}, 2500);
                            };
                            if (typeof window.oTable != 'undefined') {                                
                                window.oTable.ajax.reload(updateTable);

                            } else {                                
                                $('#main_table, .datatable_table').DataTable().ajax.reload(updateTable);
                            }
                            if(data.closeModal === true) {                                
                                setTimeout(function(){ $('#edit-modal2').modal('hide'); }, 200);
                            }
                            if(data.type === 'fournisseur') {
                                var url = Routing.generate('cem_fournisseurs_details', {'id': data.id});
                                window.location.replace(url);
                            }
                            if(data.type === 'sousCommande') {
                                var url = Routing.generate('cem_souscommandes_details', {'id': data.id});
                                window.location.replace(url);
                            }
                        }

                        // Si validation serveur NOK
                        else if (data.res === false) {
                            if(data.confirmation_message_id)
                            {
                                toastr.error($('#' + data.confirmation_message_id).text());
                            }
                            else{
                            // Boucle sur chaque erreurs
                                $.each(data.errors, function (key, value) {
                                    // Si child existe (password), on boucle sur les childs
                                    if ($.isPlainObject(data.errors[key])) {
                                        $.each(data.errors[key], function (childkey, childvalue) {
                                            if($.isPlainObject(childvalue)){
                                                $.each(data.errors[key][childkey], function (childrenkey, childrenvalue) {
                                                    $('#' + data.form_name + '_' + key + '_' + childkey+'_'+childrenkey).parent().addClass("has-error");
                                                    $('#' + data.form_name + '_' + key + '_' + childkey+'_'+childrenkey).parent().find('.help-block').text(childrenvalue);
                                                });
                                            }
                                            else{
                                                $('#' + data.form_name + '_' + key + '_' + childkey).parent().addClass("has-error");
                                                $('#' + data.form_name + '_' + key + '_' + childkey).parent().find('.help-block').text(childvalue);
                                            }
                                        });

                                    } 
                                    else {
                                        $('#' + data.form_name + '_' + key).parent().addClass("has-error");
                                        $('#' + data.form_name + '_' + key).parent().find('.help-block').text(value);
                                    }
                                });
                            }
                        }
                    });
                    return false;
                }
            });*/
        },

        /*deleteButton: function () {
            $('#edit-modal button[data-action=delete]').off('click');
            $('#edit-modal button[data-action=delete]').on('click', function () {
                var form = $('#frm-edit');
                var action = form.attr('action').replace("nosuchpage", "delete");
                $.post(action).done(function (data) {
                    $('#main_table, .datatable_table').DataTable().ajax.reload(function() {
                        $('#edit-modal').modal('hide');
                    });
                });
            });
            $('#edit-modal2 button[data-action=delete]').off('click');
            $('#edit-modal2 button[data-action=delete]').on('click', function () {
                var form = $('#frm-edit');
                var action = form.attr('action').replace("nosuchpage", "delete");
                $.post(action).done(function (data) {
                    $('#main_table, .datatable_table').DataTable().ajax.reload(function() {
                        $('#edit-modal2').modal('hide');
                    });
                });
            });
        },*/

        // Déplacement de la listbox "Affiche n elements" à droite du bouton
        /*modalButton: function() {
            $("#modal-btn").detach().prependTo('#main_table_length');
        },*/

        modal: function() {
            $('#edit-modal').on('shown.bs.modal', function () {
                $("#edit_form_container form input").parent().find('h4').focus();
            });
            /*$('#edit-modal2').on('shown.bs.modal', function () {
                $("#edit_form_container2 form input").parent().find('h4').focus();
            });*/
        },

        /*chevron:function(){
            function toggleChevron(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find("i.indicator")
                    .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
            }
            if($('.panel-group').length>0){
                $('.panel-group').each(function(){
                    $(this).on('hidden.bs.collapse', toggleChevron);
                    $(this).on('shown.bs.collapse', toggleChevron);
                });
            }
        },*/

        form: function (id_modal) {
            // Initialise la validation client (bootstrap validator)
            $('#edit_form_container_' + id_modal + ' form').validator();
            //$('#edit_form_container2 form').validator();

            mbs.init.datePicker(id_modal);
            mbs.init.submitButton(id_modal);
            //mbs.init.deleteButton();
            //mbs.init.chevron();
        }
    },

    dataTableRender: {
        date: function (data, type, full, meta) {
            if (!data) return null;
            if (m = data.match(/(\d{4})-(\d{2})-(\d{2})/)) {
                // var dt = new Date(m[1], m[2], m[3]);
                return m[3] + '/' + m[2] + '/' + m[1];
            } else {
                return data;
            }
        }
    },

    loader: {
        load: function(parent,texte) {
            if(texte === undefined) {
                texte = false;
            }
            if (!parent) parent = 'body';
            if(texte){
                $(parent).append('<div id="mbs-loader"><span class="loader-text">'+texte+'</span><span class="loader-quart"></span></div>');
            }
            else{
                $(parent).append('<div id="mbs-loader"><span class="loader-quart"></span></div>');
            }
        },

        unload: function() {
            $('#mbs-loader').remove();
        }
    }
};