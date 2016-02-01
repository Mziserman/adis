jQuery(document).ready(function() {

  var formItself = $('.depose form');

  $(formItself).submit(function(e){

    e.preventDefault();

    var date        = $('.date input').val(),
        contrat     = $('.contrat input').val(),
        poste       = $('.poste select').val(),
        entreprise  = $('.entreprise select').val(),
        lieu        = $('.lieu select').val(),
        duree       = $('.duree input').val(),
        salaire     = $('.salaire input').val(),
        description = $('.description textarea').val(),
        mail        = $('.mail input').val();

    data    = { action : 'formulaire', date : date, contrat: contrat, poste: poste, entreprise : entreprise, lieu : lieu, duree : duree, salaire : salaire, description : description, mail : mail};
    ajaxurl	= '../wp-admin/admin-ajax.php';
    
    jQuery.post(
      ajaxurl,
      data,
      function(response){
        $('.state').text(response)        
        $('.state').fadeIn();
        $('.state').delay(2000).fadeOut();
      }
    );

  });


  var add = $('button');

  $(add).on('click', function(e){

    e.preventDefault();

    var valueToAdd   = $(this).prev().val(),
        ParentSelect = $(this).parent().parent();

    if(valueToAdd != '')
      $(ParentSelect).children('select').append('<option value="'+ valueToAdd +'" selected>'+ valueToAdd +'</option>');

  });

});
