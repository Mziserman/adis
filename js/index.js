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


function Connexion(){
  
  this.popin       = $('.popconnexion');
  this.quit        = $('.popconnexion .quit');
  this.connexion   = $('.menu_item.connexion');
  
  this.init();
  
}

Connexion.prototype.init = function(){
  
  this.appear();
  this.disappear();
  
}

Connexion.prototype.disappear = function (){
  
  var selfPop = this.popin;
  
  $(this.quit).on('click', function(){
    
    TweenLite.to(selfPop, 1, {top:'-100%'});
    
  });
  
}

Connexion.prototype.appear = function(){
  
  var selfPop = this.popin;
  
  $(this.connexion).on('click', function(){
        
    TweenLite.to(selfPop, 1, {top:150});
    
  });
  
}

new Connexion();
function Etudiant(){

  this.init();

}

Etudiant.prototype.init = function(){

  this.display();

}

Etudiant.prototype.display = function(){


  $('.update .button button').on('click', function(){

    if($('.update .acf-form').hasClass('hide')){

      $('.update .acf-form').css('display', 'inherit');
      $('.update .acf-form').addClass('display');
      $('.update .acf-form').removeClass('hide');

    } else if($('.update .acf-form').hasClass('display')){

      $('.update .acf-form').css('display', 'none');
      $('.update .acf-form').addClass('hide');
      $('.update .acf-form').removeClass('display');

    }

  });
  
  $('.update .button button').one('click', function(){

      $('.update .acf-form').css('display', 'inherit');
      $('.update .acf-form').addClass('display');

    });

}

new Etudiant();
function filter(){

  this.form = $('.filters form');

  this.init();

}

filter.prototype.init = function(){

  this.toOrange();

}

filter.prototype.toOrange = function() {

  $('.filters form select').on('click', function(){

    var value = $(this).val();

    if(value == ''){
      $(this).css('border-color', 'black');
    }
    else{
      $(this).css('border-color', '#eb8b32');
    }

  });

  $('.filters form div input').blur(function(){
    
    var value = $(this).val();

    if(value == ''){
      $(this).css('border-color', 'black');
    }
    else{
      $(this).css('border-color', '#eb8b32');
    }

  });
  
}

new filter();
function Offre(){

  this.toOrange();

}

Offre.prototype.toOrange = function(){

  $('.depose input, .depose select, .depose textarea').blur(function(){

    var value = $(this).val();

    if(value == ''){
      $(this).css('border-color', 'black');
    }
    else{
      $(this).css('border-color', '#eb8b32');
    };

  });

}

new Offre();