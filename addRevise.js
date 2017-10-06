<!--Revise.js-->
(function(){
alert(123);
var data = $("script[src*='addRevise.js']").attr('src').split('?')[1];
$.ajax({
  url: '/getmetafields.php?'+data,
		success: function(data){
      alert(data);
    }
});
var url = window.location.href;
if(url.indexOf('/products/') > -1){
if($('.add_to_cart').length){
  $('.add_to_cart').after('<p>testinggggg</p>');
}
}
})();
