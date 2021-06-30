

var app = {
  init: function() {

    // scroll magic 
var controller = new ScrollMagic.Controller();

var scene = new ScrollMagic.Scene({

    triggerElement: '.box1',
    reverse: false

})
    .setClassToggle('.box1', 'fade-in')   
    .addTo(controller);

var scene2 = new ScrollMagic.Scene({

    triggerElement: '.box2',
    reverse: false
})
    .setClassToggle('.box2', 'fade-in')  
    .addTo(controller);

var scene3 = new ScrollMagic.Scene({

    triggerElement: '.box3',
    reverse: false
})
    .setClassToggle('.box3', 'fade-in')
    .addTo(controller); 
    // fin scroll magic


 var app = {
  init: function() {
    console.log('init');
  }
};

$(app.init);

    console.log('init');
  }

};

$(app.init);
// Le code suivant va fermer la modal en cliquant en dehors du contenu modal '(et pas seulement en utilisant "x" ou "annuler'")
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

