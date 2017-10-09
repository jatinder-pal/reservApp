<!--Add CSS Code-->
(function(){
var data = $("script[src*='addRevise.js']").attr('src').split('?')[1]; 
$.ajax({
  crossDomain: true,
  url: 'https://reserv-app.herokuapp.com/getCss_json.php?'+data,
  dataType: "jsonp",
  header: {"Access-Control-Allow-Origin": "https://sendd-shipping.myshopify.com"},
  success: function(response){
      console.log(response);
  }
});
})();
