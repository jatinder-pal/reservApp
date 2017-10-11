<!--Reserv.js-->
(function(){
var data = $("script[src*='addReserv.js']").attr('src').split('?')[1]; 
$.ajax({
  crossDomain: true,
  url: 'https://reserv-app.herokuapp.com/getmeta_json.php?'+data,
  dataType: "jsonp",
  header: {"Access-Control-Allow-Origin": "*"},
  success: function(response){
      //console.log(response['options']);
      var data = response['options'];
      data = data.split(',');
      $.each(data, function(index, value){
        var values = value.split(':');
	value = values[0];
	var classes = values[1];
        var url = window.location.href;
        if(url.indexOf('/products/') > -1 && value == 'product_page'){
          if($('.'+classes).length){
	    var product_url = window.location.href+'.json';
	    console.log(product_url); 
		$.ajax({
		crossDomain: true,
		url: product_url,
		dataType: "jsonp",
		header: {"Access-Control-Allow-Origin": "*"},
		success: function(response){
			console.log(response);
		}
		});
            $('.'+classes).after('<a href="#" class="reserv_button">RESERV <br/><span>The New Layaway</span></a>');
          }
        } else if(url.indexOf('/collections/') > -1 && url.indexOf('/products/') === -1 && value == 'catalog_page'){
          if($('.'+classes).length){
	    var collection_url = window.location.href+'/products.json';
	    console.log(collection_url);
		$.ajax({
		crossDomain: true,
		url: collection_url,
		dataType: "jsonp",
		header: {"Access-Control-Allow-Origin": "*"},
		success: function(response){
			console.log(response);
		}
		});
            $('.'+classes).after('<a href="#" class="reserv_button">RESERV <br/><span>The New Layaway</span></a>');
          }
        }
        
      });
  }
});
})();
