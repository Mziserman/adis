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