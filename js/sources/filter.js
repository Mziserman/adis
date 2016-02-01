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