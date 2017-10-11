<!--Add CSS Code-->
(function(){
var data = $("script[src*='addCssCode.js']").attr('src').split('?')[1]; 
$.ajax({
  crossDomain: true,
  url: 'https://reserv-app.herokuapp.com/getCss_json.php?'+data,
  dataType: "jsonp",
  header: {"Access-Control-Allow-Origin": "*"},
  success: function(response){
     var csscode = response['options'];
     $('head').append('<style>'+csscode+'</style>');
  }
});
})();
