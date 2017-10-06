<!--Revise.js-->
(function(){
var data = $("script[src*='addRevise.js']").attr('src').split('?')[1]; 
$.ajax({
  crossDomain: true,
  url: 'https://revise-app.herokuapp.com/getmeta_json.php?'+data,
  dataType: "jsonp",
  header: {"Access-Control-Allow-Origin": "https://sendd-shipping.myshopify.com"},
  success: function(response){
      console.log(response['options']);
      var data = response['options'];
      data = data.split(',');
      console.log(data);
      /*$.each(data, function(index, value){
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
      });*/
  }
});
})();
