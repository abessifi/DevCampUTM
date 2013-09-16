jQuery(function($) {
    $('.themeple_container').option_pages();
    $('.themeple_main_section').themeple_generate_nav();
    $('.radio-image-wrapper input').live('change', function(){
		$(this).parent().parent().parent().find(".check-list").removeClass("check-list");
		$(this).parent().find('label').find("#check-list").addClass("check-list");
		$(this).parent().parent().parent().find('input').removeAttr('checked');
		$(this).attr('checked', 'checked');
	});	
	
	

	$('.switch-button-wrapper').live('click', function(){
					var $check = $(this).find('label .ckeck-switch');
					if($check.hasClass('checked-switch-yes')){
						$check.removeClass('checked-switch-yes').addClass('checked-switch-no');
						$(this).find('input').val('no').change();
						
					}else if($check.hasClass('checked-switch-no') ){
						$check.removeClass('checked-switch-no').addClass('checked-switch-yes');
						$(this).find('input').val('yes').change();
						
					}
				});
	
    	
  });
(function($)
{
	$.fn.themeple_generate_nav = function() 
	{
		return this.each(function()
		{
			if(!$('.themeple_main_section').length) return;
		
			var container = $(this),
				headContainer = $('.themeple_header_nav',container),
				sidebar = $('.themeple_navigation ul'),
				urlHash = window.location.hash.replace(/^\#goto_/,"themeple-"),
                
				hashActive = $('.themeple_section', container).filter('[id='+urlHash+']');	
			    
			headContainer.each(function()
			{
				var heading = $(this),
					subContainer = heading.parent('.themeple_section');
					
					if($(subContainer).hasClass('sub_section')){
						heading.addClass('sub_section');
					}

					if(hashActive.length)
					{
						if(subContainer.is('#'+urlHash))
						{
							heading.addClass('active');
							$('.themeple_section').removeClass('active_section');
							subContainer.addClass('active_section');
						}
					}
					else
					{
						if(subContainer.is(':visible'))
						{
							heading.addClass('active');
						}
					}
					
					
					heading.clone(false)
						   .appendTo(sidebar)
						   .css({display:'block'})
						   .click(function()
						   {
						   		if(!subContainer.is(':visible'))
						   		{
						   			$('.themeple_section').removeClass('active_section');
						   			subContainer.addClass('active_section');
						   			$('.themeple_header_nav.active').removeClass('active');
						   			$(this).addClass('active');
						   		}
						   });
				});
				

		});
		
		
		
	}
})(jQuery);	


(function($)
{
	$.fn.option_pages = function() 
	{
		return this.each(function()
		{
			var container = $(this);
			if(container.length != 1) return;
			
			var saveButtons = $('.save_button', this),
				change_skin = $('.change_skin', this),
				dummyDataButton = $('.themeple_dummy_data', this),
				hiddenDataContainer = $('#themeple_js_data', this),
				saveData = {
								container: 		$(this),
								ajaxUrl :		$('input[name=admin_ajax_url]', hiddenDataContainer).val(),
								prefix :		$('input[name=db_options_prefix]', hiddenDataContainer).val(),
								optionSlug :	$('input[name=page_slug]', hiddenDataContainer).val(),
								action :		$('input[name=action]', hiddenDataContainer).val(),
								ref	   :		$('input[name=_wp_http_referer]', hiddenDataContainer).val(),
								first_call:		$('input[name=first_call]', hiddenDataContainer),
                                nonceImport  :	$('input[name=themeple-nonce-dummy]', container).val(),
                                nonce:          $('input[name=nonce_save_data]', hiddenDataContainer).val(),
								saveButtons: 	saveButtons
							 };

			saveButtons.bind('click', {set: saveData}, methods.save); 		//saves the current form
			
			dummyDataButton.bind('click', {set: saveData}, methods.insert_dummy_data);

			change_skin.bind('click', {set: saveData}, methods.change_skin);
			
			saveButtons.removeClass('themeple_btn_inaction').addClass('themeple_btn_active');
			
			
		});
	};
	
	var	methods = {

 
		save: function(passed, hiddensave)
		{
			if(typeof hiddensave == 'undefined') hiddensave = false;
			
			var me = hiddensave == true ? passed : passed.data.set,
				buttonClicked = $(this),
				elements_input	= $('input:text','.themeple_box'),
				elements_select	= $('select','.themeple_box'),
				elements_textarea	= $('textarea','.themeple_box'),
				elements_radio	= $('input:checked','.themeple_box'),
				elements_hidden	= $('input[type=hidden]','.themeple_box'),
				dataString = "";	
			
			
			
			 
			elements_input.each(function()
			{
                
				var currentElement = $(this),		
					value = currentElement.val(),		
					name = currentElement.attr('name');		
				
				if(name != '')
				{	
					dataString  += "&" + name + "=" + encodeURIComponent(value);
				}
			});


			elements_select.each(function()
			{
                
				var currentElement = $(this),		
					value = currentElement.val(),		
					name = currentElement.attr('name');		
				
				if(name != '')
				{	
					dataString  += "&" + name + "=" + encodeURIComponent(value);
				}
			});
			
			elements_textarea.each(function()
			{
                
				var currentElement = $(this),		
					value = currentElement.val(),		
					name = currentElement.attr('name');		
				
				if(name != '')
				{	
					dataString  += "&" + name + "=" + encodeURIComponent(value);
				}
			});
			elements_radio.each(function()
			{
                
				var currentElement = $(this),		
					value = currentElement.val(),		
					name = currentElement.attr('name');		
					
				if(name != '')
				{	
					dataString  += "&" + name + "=" + encodeURIComponent(value);
				}
			});

			elements_hidden.each(function()
			{
                
				var currentElement = $(this),		
					value = currentElement.val(),		
					name = currentElement.attr('name');		
				
				if(name != '')
				{	
					dataString  += "&" + name + "=" + encodeURIComponent(value);
				}
			});
			
			dataString = dataString.substr(1);
			
			var dynamicOrder = "",
				dynamicElements = $('.themeple_box, .themeple_set').not('.themeple_single_set .themeple_box'),
				id_order_string = "";
				
			if(dynamicElements.length && $('.themeple_row').length)
			{
				
				dynamicElements.each(function()
				{
				    
					id_order_string = this.id.replace(/^themeple_/,'').replace(/-__-0$/,'');
					dynamicOrder += id_order_string + '-__-';
                    
				});
			}

			$.ajax({
					type: "POST",
					url: me.ajaxUrl,
					data: 
					{
						action: me.action,
						_wpnonce: me.nonce,
						_wp_http_referer: me.ref,
						prefix: me.prefix,
						slug: me.optionSlug,
                        dynamicOrder: dynamicOrder,
						data: dataString
						
					},
                    beforeSend: function(){
                        $('.loading', me.container).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});  
                    },
					error: function()
					{
						
                        if(hiddensave) return;
					    alert("error");
					},
					success: function(response)
					{
						
                        alert("Saved with success.");	
                        if(hiddensave) return;
                        
					},
                    complete: function(response){
                        $('.loading', me.container).fadeOut();
                    }
                    
                    
				});
			
			return false;
		},
        insert_dummy_data: function(passed){
            var button = $(this),
				me = passed.data.set,
				answer = "";
    
			$.ajax({
						type: "POST",
						url: me.ajaxUrl,
						data: 
						{
							action: 'themeple_ajax_dummy_data',
							_wpnonce: me.nonceImport,
							_wp_http_referer: me.ref
						},
                        beforeSend: function(){
                          $('.loading', me.container).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});   
                        },
						error: function()
						{
							alert("error");
							
						},
						success: function(response)
						{
							if(response.match('themeple_dummy'))
							{
								response = response.replace('themeple_dummy','');
								alert("Imported with Success :)");
								setTimeout(function(){
								    window.location.hash = "#wpwrap";
						 			window.location.reload(true);
								
                                }, 3000);
							}
							else
							{
								alert("Error. please try again");
							}
						},
                        complete: function(response){
                            $('.loading', me.container).fadeOut();
                        }
					});
					
			return false;
        },
        change_skin: function(passed){
            var button = $(this),
				me = passed.data.set,
				answer = "";
    
			$.ajax({
						type: "POST",
						url: me.ajaxUrl,
						data: 
						{
							action: 'themeple_ajax_change_skin',
							_wpnonce: me.nonce,
							_wp_http_referer: me.ref,
							prefix: me.prefix,
							slug: me.optionSlug,
							color: button.attr("id")
						},
                        beforeSend: function(){
                          $('.loading', me.container).css({opacity:0, display:"block", visibility:'visible'}).animate({opacity:1});   
                        },
						error: function()
						{
							alert("error");
							
						},
						success: function(response)
						{
							if(response.match('themeple_changed_skin'))
							{
								response = response.replace('themeple_changed_skin','');
								alert("Changed with success :)");
								setTimeout(function(){
								    window.location.hash = "#wpwrap";
						 			window.location.reload(true);
								
                                }, 3000);
							}
							else
							{
								alert("Error. please try again");
							}
						},
                        complete: function(response){
                            $('.loading', me.container).fadeOut();
                        }
					});
					
			return false;
        }

	};
	
	
})(jQuery);


(function($)
{
	$.fn.themeple_event_binding = function(variables) 
	{		
		return this.each(function()
		{		
			if(window.parent && window.parent.document && variables != 'skip')
			{
				parent.jQuery(window.parent.document.body).trigger('themeple_event_binding',[this]);
				return;
			}
			
			var container = $(this);
			
			if($.fn.themeple_generate_sets) 		container.themeple_generate_sets();
			if($.fn.themeple_form_requirement) 			$('.themeple_required_container', container).not('.themeple_delay_required .themeple_required_container').themeple_form_requirement();
			
		});
	};
})(jQuery);	


(function($)
{
	$.fn.themeple_generate_sets = function(variables) 
	{
		return this.each(function()
		{

			var container = $(this);
			
			if(container.length != 1) return;
			var hiddenDataContainer = $('#themeple_js_data'),
				saveData = {
							container    : 	container,
							createButton : 	$('.themeple_clone', this),
							removeButton : 	$('.themeple_remove', this),
							nonce:          $('input[name=nonce_save_data]', hiddenDataContainer).val(),
							ajaxUrl :		$('input[name=admin_ajax_url]', hiddenDataContainer).val(),
							ref	   :		$('input[name=_wp_http_referer]', hiddenDataContainer).val(),
							prefix :		$('input[name=db_options_prefix]', hiddenDataContainer).val(),
							meta_active:	$('input[name=meta_active]', hiddenDataContainer)
							};
            
			
            saveData.createButton.unbind('click').bind('click', {set: saveData}, methods.add); 
			saveData.removeButton.unbind('click').bind('click', {set: saveData}, methods.remove); 
			
			
		});
	};
	
	var currentlyModifying = false,
	 	methods = {
	

 
		add: function(passed)
		{
			
			if(currentlyModifying) return false;
			currentlyModifying = true;
		

			var data = passed.data.set,
				currentButton = $(this),
				
				cloneContainer = currentButton.parents('.themeple_set:eq(0)'),
				parentCloneContainer = currentButton.parents('.themeple_set:eq(1)'),
				elementSlug = cloneContainer.attr('id');
			
			if(parentCloneContainer.length == 1)
			{
				var removeString = parentCloneContainer.attr('id');
				
				elementSlug = elementSlug.replace(removeString+'-__-','').replace(/-__-\d+/,'');
			}
			else
			{
				elementSlug = elementSlug.replace('themeple_','').replace(/-__-\d+/,'');
			}

			var page_context = 'admin_page';
			if(data.meta_active.length) page_context = 'metabox';
	
			$.ajax({
					type: "POST",
					url: data.ajaxUrl,
					data: 
					{
						action: 'themeple_ajax_modify_table',
						method: 'add',
						elementSlug: elementSlug,
						context: page_context
						
					},
					beforeSend: function()
					{
						
					},
					error: function()
					{
						alert('error');
					},
					success: function(response)
					{
						var save_result = response.match(/\{themeple_ajax_element\}(.+|\s+)\{\/themeple_ajax_element\}/);
						
						if(save_result != null)
						{	

							var newSet = $(save_result[1]).css('display','none');
							
							methods.setBlank(newSet);
							newSet.insertAfter(cloneContainer).slideDown(400, function()
							{

								data.currentSet = newSet;
								methods.recalcIds(data);

								newSet.themeple_event_binding();
							});

							if(save_result[0] != response)
							{
								response = response.replace(save_result[0],'');
								alert(response);	
							}
							
						}

					},
					complete: function(response)
					{	
						
						currentlyModifying = false;
					}
				});		

			return false;
		},
		
		remove: function(passed)
		{
            
			if(currentlyModifying) return false;
			currentlyModifying = true;
            
			var data = passed.data.set,
				currentButton = $(this),
				singleSet = currentButton.parents('.themeple_set:eq(0)'),
				id = singleSet.attr('id').replace(/-__-\d+$/,'-__-');
				
				data.setsToCount = singleSet.siblings('.themeple_set').filter('[id*='+id+']');

				if(data.setsToCount.length || data.removeButton.is('.remove_all_allowed'))
				{
					data.currentSet = data.setsToCount.filter(':eq(0)');
					
					singleSet.slideUp(400, function()
					{
						singleSet.remove();
						methods.recalcIds(data);
						currentlyModifying = false;	
					});
				
				}
				else
				{
					methods.setBlank(singleSet);
					data.setsToCount = false;
					currentlyModifying = false;	
					
				}
					
			return false;
		},

		setBlank: function(container)
		{
			$('input:text, input:hidden, textarea, input:radio', container).not('.themeple_upload_insert_label, .themeple_required').val('').trigger('change');						
			$('input:checkbox, input:radio, select, input:radio', container).removeAttr("checked").removeAttr("selected").trigger('change');
			$('.themeple_preview_pic, .themeple_color_picker_div', container).html("").css({backgroundColor:'transparent'});
		},


		recalcIds: function(data)
		{
			themeple_recalcIds(data);
		}
		

	};

	
	    
	    themeple_recalcIds = function(data)
		{	
					if(!data.setsToCount)
			{					
				var id = data.container.attr('id').replace(/-__-\d+$/,'-__-');
				data.setsToCount = data.currentSet.siblings('.themeple_set').filter('[id*='+id+']').add(data.currentSet);

			var parentGroup = data.currentSet.parents('.themeple_set:eq(0)'),
				newId = "";

			
			if(parentGroup.length == 1)
			{
				newId = data.currentSet.attr('id').replace('themeple_','');
				newId = parentGroup.attr('id') +'-__-'+ newId.replace(/\d+$/,'');
			}
			else
			{	
				if(data.currentSet.attr('id'))
				{
					newId = data.currentSet.attr('id').replace(/\d+$/,'');
				}
			}
			

 
			data.setsToCount.each(function(i)
			{
				var currentSet = $(this),
					elements = $('[id*=-__-], [name*=-__-]', this),
					setId = newId + i;
				
				this.id = setId;

				elements.each(function()
				{
					
					var element = $(this),
						el_attr = this.id,
						parentSet = element.parents('.themeple_set:eq(0)'),
						replacementString = parentSet[0].id.replace('themeple_','');
							
						var match = el_attr.match(/[a-z0-9](-__-[-_a-zA-Z0-9]+-__-\d+)$/);
						
						if(match == null)
						{
							var myRegexp = /.+-__-([-_a-zA-Z0-9]+)$/;
							match = myRegexp.exec(el_attr);
							
							id_string = replacementString + '-__-' + match[1];
							
							if(this.name)
							{
								this.name = id_string;
							}
							else
							{
								id_string = 'themeple_' +id_string;
							}
							this.id = id_string;
							
						}
						else 
						{
							el_attr_array = match[1];
							this.id = 'themeple_' + replacementString + el_attr_array;
						}
					
				});
			});

			data.setsToCount = "";
			
			
			return;			
		}
        } 

	
})(jQuery);	


(function($)
{
	$.fn.themeple_event_listener = function(variables) 
	{	
		this.bind('themeple_event_binding', function(event, element)
		{
			parent.jQuery(element).themeple_event_binding('skip');
		});
	};
})(jQuery);