$(document).ready(function(){
document.addEventListener("turbolinks:load", function() {
$('.demoDiv').ekScrollable();
$(".anu").ayoshare({
        counter: true,
        button: {
          google : true,
          facebook : true,
          pinterest : false,
          linkedin : true,
          twitter : true,
          flipboard : false,
          email : true,
          whatsapp : true,
          telegram : false,
          line : false,
          bbm : false,
          viber : false,
          sms : false,
          stumbleupon : false,
          bufferapp : false,
          reddit : false,
          vk : false,
          pocket : false,
          digg : false
          
        }
      });
      

//save product function
var site_location = $('#js-site-location').attr('value');
var file_location = $('#js-file-location').attr('value');

$('#comment-form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();
var url = site_location+'read/addcomment';

$.ajax({
  type: 'post',
  url: url,
  data : data,
  beforeSend: function () 
{
$(".notification").html('Saving comment...');
},

success: function (o){

var myObj   = JSON.parse(o);
      var status  = myObj.status;
      var sms     = myObj.message;
      var name    = myObj.name;
      var content = myObj.content;
      var date    = myObj.date;

 if (status == 'success') 
  {


var html = '<div class="row comment-item"><div class="col-lg-2">'+
'<div class="autho-logo"><span class="fa fa-user"></span></div>'+
'</div><div class="col-lg-10 "><label class="text-white gotham-medium">'+name+'</label>'+
'<p class="text-white gotham-thin">'+date+'</p><p class="text-white gotham-light">'+content+'</p></div></div>';

$('.notification').html(sms);
$('.comment-hidden').prepend(html);

  }
  else
  {
  $('.notification').html(sms);    

  }

}
});

});
// End of function

});

});



