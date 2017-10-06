<!--Revise.js-->
(function(){
alert(123);
var data = $("script[src*='addRevise.js']").attr('src').split('?')[1];
$.ajax({
  crossDomain: true,
  url: 'https://revise-app.herokuapp.com/getmetafields.php?'+data,
  //dataType: "jsonp",
  header: {"Access-Control-Allow-Origin": "https://sendd-shipping.myshopify.com"},
  success: function(response){
      alert(response);
      data = response.split(',');
      $.each(data, function(index, value){
        alert(value);
        var url = window.location.href;
        if(url.indexOf('/products/') > -1 ){
          if($('.add_to_cart').length){
            $('.add_to_cart').after('<p>testinggggg</p>');
          }
        }
        if(url.indexOf('/collections/') > -1 && value == 'catalog_page'){
          if($('.add_to_cart').length){
            $('.add_to_cart').after('<p>testinggggg</p>');
          }
        }
      });
  }
});
})();
