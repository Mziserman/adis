
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