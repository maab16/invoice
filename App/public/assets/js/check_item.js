$.fn.itemChecker = function(options){

	var deafults = {

			action : false

		}

	var settings = $.extend({},deafults,options);

	return this.each(function(){

		var interval;
		
		$(this).on('keydown',function(){

			var self = $(this),
				parentItem=self.data('parent'),
				selfType=self.data('type'),
				selfValue,
				feedback = $('.check-exists-feedback[data-type=' + selfType + ']');

			if (interval===undefined) {

				interval = setInterval(function(){

					if (selfValue !== self.val()) {

						selfValue = self.val();

						//if (selfValue.length>1) {

							$.ajax({

								url 		: 'App/public/assets/ajax/check_item.php',
								type 		: 'get',
								dataType 	: 'json',
								data 		: {

										parent : parentItem,
										name : selfType,
										value : selfValue
								},

								success	: function(data){

									if (data.exists !== undefined) {

										if (data.exists===true) {

											self.parent().find('.item_list_container').html(data.html);
											

										}else if (data.exists===false){

										}

						
									}
									
								},
								error	: function(data){

									console.log(data);

								}
							});
						//}
					}
				},500);
			}
		});
	});
};