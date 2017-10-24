<!--Reserv.js-->
(function() {
    var data = $("script[src*='addReserv.js']").attr('src').split('?')[1];
    $.ajax({
        crossDomain: true,
        url: 'https://reserv-app.herokuapp.com/getmeta_json.php?' + data,
        dataType: "jsonp",
        header: {
            "Access-Control-Allow-Origin": "*"
        },
        success: function(response) {
            console.log(response['data']);
            var data = response['data'];
			var getnewdata = data.split('==');
			var getMerchantID = getnewdata[0];
			data = getnewdata[1];
            data = data.split(',');
            $.each(data, function(index, value) {
                var values = value.split(':');
                value = values[0];
                var classes = values[1];
                var url = window.location.href;
                if (url.indexOf('/products/') > -1 && value == 'product_page') {
                    if ($('.' + classes).length) {
                        if (window.location.href.indexOf('?variant=') > -1) {
                            var product_url = window.location.href.split('?variant=');
                            product_url = product_url[0] + '.json';
                        } else {
                            var product_url = window.location.href + '.json';
                        }
                        console.log(product_url);
                        $.ajax({
                            type: 'get',
                            url: product_url,
                            dataType: "jsonp",
                            header: {
                                "Access-Control-Allow-Origin": "*"
                            },
                            success: function(response) {
                                var product = response.product;
                                var product_id = product.id;
                                var product_name = product.title;
                                var desc = product.body_html;
                                var id = product.variants[0].id;
                                var price = product.variants[0].price;
                                var variant_image_id = product.variants[0].image_id;
                                var variant_title = product.variants[0].title;
								var name = "";
                                if(variant_title == "Default Title"){
                                    name = product_name;
                                } else {
                                    name = product_name+' - '+variant_title;
                                }
								var image = "";
                                if (variant_image_id != null) {
                                    $.each(product.images, function(index){
                                      if(product.images[index].id == variant_image_id){
                                        image = product.images[index].src;
                                      }
                                    });
                                } else {
                                    image = product.image.src;
                                }
                                var link = 'https://create.myreserv.com/#login?merchant='+getMerchantID+'&id='+id+'&product_id='+product_id+'&productname='+name+'&image='+image+'&description='+desc+'&price='+price;
                                $('.'+classes).after('<a href="'+link+'" class="reserv_button"><img src="https://reserv-app.herokuapp.com/images/ReservButton.png" alt="reservbtn" /></a>');
                                $('body').on('click','.reserv_button',function(e){
									e.preventDefault();
									var _this = $(this);
									var variantid = $('select[name="id"]').val();
									$.each(product.variants, function(index){
									   if(product.variants[index].id == variantid){
										var newid = product.variants[index].id;
										var newprice = product.variants[index].price;
										var v_imgid = product.variants[index].image_id;
										var v_title = product.variants[index].title;
										if(v_title == "Default Title"){
											name = product_name;
										} else {
											name = product_name+' - '+v_title;
										}
										if (v_imgid != null) {
											$.each(product.images, function(index){
											  if(product.images[index].id == v_imgid){
												image = product.images[index].src;
											  }
											});
										} else {
											var image = product.image.src;
										}
										var newlink = 'https://create.myreserv.com/#login?merchant='+getMerchantID+'&id='+id+'&product_id='+product_id+'&productname='+name+'&image='+image+'&description='+desc+'&price='+newprice;
										_this.attr('href',newlink);
										window.location.href = newlink;
									   }
									});
                                });
                            }
                        });
                    }
                } else if (url.indexOf('/collections/') > -1 && url.indexOf('/products/') === -1 && value == 'catalog_page') {
                    if ($('.' + classes).length) {
                        var current_page = 1;
                        var limit = 0;
                        if (url.indexOf('?page=') > -1) {
                            var urlArray = url.split('?page=');
                            var current_page = urlArray[1];
                            if(current_page == 1){
                                limit = $('body .'+classes).length;
                                $.cookie('limit', limit);
                            } else {
                                limit = $.cookie('limit');
                            }
                            var main_url = urlArray[0];
                        } else {
                            var main_url = url;
                            var current_page = 1;
                            limit = $('body .'+classes).length;
                            $.cookie('limit', limit);
                        }
                        var collection_url = main_url+'/products.json?limit='+limit+'&page='+current_page;
                        console.log(collection_url);
                        $.ajax({
                            crossDomain: true,
                            url: collection_url,
                            async: false,
                            dataType: "jsonp",
                            header: {
                                "Access-Control-Allow-Origin": "*"
                            },
                            success: function(response) {
                                var product = response.products;
                                var proarray = [];
                                $.each(product, function(index) {
                                    var product_id = product[index].id;
                                    var product_name = product[index].title;
                                    var desc = product[index].body_html;
                                    var id = product[index].variants[0].id;
                                    var price = product[index].variants[0].price;
                                    var variant_featured_image = product[index].variants[0].featured_image;
                                    var variant_title = product[index].variants[0].title;
									var name = "";
                                    if(variant_title == "Default Title"){
                                        name = product_name;
                                    } else {
                                        name = product_name+' - '+variant_title;
                                    }
                                    var image = "";
                                    if (variant_featured_image != null) {
                                        image = product[index].variants[0].featured_image.src;
                                    } else {
                                        if (product[index].images.length) {
                                           image = product[index].images[0].src;
                                        }
                                    }
                                    var link = 'https://create.myreserv.com/#login?merchant='+getMerchantID+'&id='+id+'&product_id='+product_id+'&productname='+name+'&image='+image+'&description='+desc+'&price='+price;
                                    proarray.push(link);
                                });
                                $('body .'+classes).each(function(index) {
                                    $(this).after('<a href="'+proarray[index]+'" class="reserv_button"><img src="https://reserv-app.herokuapp.com/images/ReservButton.png" alt="reservbtn" /></a>');
                                });
								$('body').on('click','.reserv_button',function(e){
									e.preventDefault();
									var _this = $(this);
									console.log(_this);
									var variantid = $(this).parents('form').find('[name="id"]').val();
									$.each(product, function(i) {
										var product_id = product[i].id;
										var desc = product[i].body_html;
										var product_name = product[i].title;
										var name = "";
										$.each(product[i].variants, function(index){
										   if(product[i].variants[index].id == variantid){
											var id = variantid;
											var newprice = product[i].variants[index].price;
											var v_featured_image = product[i].variants[index].featured_image;
											var v_title = product[i].variants[index].title;
											if(v_title == "Default Title"){
												name = product_name;
											} else {
												name = product_name+' - '+v_title;
											}
											var image = "";
											if (v_featured_image != null) {
												image = product[i].variants[index].featured_image.src;
											} else {
												if (product[i].images.length) {
												   image = product[i].images[0].src;
												}
											}
											var newlink = 'https://create.myreserv.com/#login?merchant='+getMerchantID+'&id='+id+'&product_id='+product_id+'&productname='+name+'&image='+image+'&description='+desc+'&price='+newprice;
											_this.attr('href',newlink);
											window.location.href = newlink;
										   }
										});
									});
								});
							}
                        });
                    }
                } else if (url.indexOf('/cart') > -1 && value == 'cart_page') {
                    if ($('.' + classes).length) {
                        var cart_url = window.location.href + '.json';
                        $.ajax({
                            type: 'get',
                            url: cart_url,
                            dataType: "jsonp",
                            header: {
                                "Access-Control-Allow-Origin": "*"
                            },
                            success: function(response) {
                                var items = response.items;
                                var itemsarray = [];
                                $.each(items, function(index) {
                                    var id = items[index].id;
                                    var product_id = items[index].product_id;
                                    var name = items[index].title;
                                    var desc = items[index].product_description;
                                    var price = items[index].price;
                                    var image = items[index].image;
                                    var link = 'https://create.myreserv.com/#login?merchant='+getMerchantID+'&id='+id+'&product_id='+product_id+'&productname='+name+'&image='+image+'&description='+desc+'&price='+price;
                                    itemsarray.push(link);
                                });
                                var Allitems = itemsarray.join("|");
                                $('.'+classes).after('<a href="'+Allitems+'" class="reserv_button"><img src="https://reserv-app.herokuapp.com/images/ReservButton.png" alt="reservbtn" /></a>');
                            }
                        });
                    }
                }
            });
		}
    });
})();
