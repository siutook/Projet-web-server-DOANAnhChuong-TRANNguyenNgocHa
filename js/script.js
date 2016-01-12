  <!-- JAVASCRIPT CODE -->

  $(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  // Add smooth scrolling to all links in navbar + footr link
  /*$("#clickNews").on('click',function(event){
    var v= $("#clickNews").attr('href');
    window.location.href = v;
  });

/*
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  // Prevent default anchor click behavior
  event.preventDefault();

  // Store hash
  var hash = this.hash;

  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
  $('html, body').animate({
    scrollTop: 100
  }, 500, function(){
    //console.log($(hash).offset());
  // Add hash (#) to URL when done scrolling (default click behavior)
  window.location.hash = hash;
});

});
*/

  var placeholder = null;
  $('input[type=text]').focus(function(){
    placeholder = $(this).attr("placeholder");
    $(this).attr("placeholder","");
  });
  $('input[type=text]').blur(function(){
    $(this).attr("placeholder", placeholder);
  });
})
