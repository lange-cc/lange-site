 $(document).ready(function(){
document.addEventListener("turbolinks:load", function() {
            $('.customer-logos').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                dots: false,
                    pauseOnHover: true,
                    responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
    
$('.embed-video').embedVideo();

$('.slide-bottom-btn').on('click',function(){
$('html, body').animate({
        scrollTop: $('#project').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
    }, 'slow');

});

$('.service-bottom-btn').on('click',function(){
$('html, body').animate({
        scrollTop: $('#service').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
    }, 'slow');

});

// Contact form
 $('#main-contact-form').on('submit', function(event){
event.preventDefault();
var form = $('#main-contact-form');
    var form_status = $('<div class="form_status"></div>');
    $.ajax({
      url: $(this).attr('action'),
      type: 'post',
            data: $(this).serialize(),
      beforeSend: function(){
        document.getElementById("send").disabled = true;
        form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>') );
      },
      success: function(data){
      form_status.html('<p class="text-success">'+data+'</p>').delay(3000).fadeOut();
    }
    });
  });
  // end of function


$('#Event-Form').on('submit',function(e){
e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: 'post',
            data: $(this).serialize(),
      beforeSend: function(){
        document.getElementById("send1").disabled = true;
        $('#notfication').html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>');
      },
      success: function(data){
      $('#notfication').html('<p class="text-success">'+data+'</p>').delay(10000).fadeOut();
    }
    });
 
});



}) });
