<!--Revise.js-->
var url = window.location.href;
if(url.indexOf('/products/') > -1){
  if($('. add_to_cart').length){
    $('. add_to_cart').after('<p>testinggggg</p>');
  }
}
