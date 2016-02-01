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