(function() {
  var tabMenu = document.querySelectorAll('.deroule');
  var tabD = document.querySelectorAll('ul ul');
  function deroule(e){
    e.stopPropagation(); 
    obj = this.querySelector('ul');
    if(!this.open){
      tabMenu.forEach(ferme);
      obj.style.display = "block";
      this.open = true;
    }else{
      obj.style.display = "none";
      this.open = false;
    }
  }
  var ferme = function(obj,i){
    tabD[i].style.display = "none";
    obj.open = false;
  }
  var init = function(obj){
    obj.addEventListener("click",deroule);
    obj.open = false;
  }
  tabMenu.forEach(init);
  window.addEventListener("click",function(){
    tabMenu.forEach(ferme);
  });
  window.addEventListener("scroll",function(){
    tabMenu.forEach(ferme);
  });
})();