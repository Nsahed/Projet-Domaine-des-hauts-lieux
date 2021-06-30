(function($) {
	'use strict';

	$('document').ready(function(){
		if($("body").hasClass("toplevel_page_bbsm-all-scenes") || $("body").hasClass("scroll-magic_page_bbsm-add-scene") || $("body").hasClass("scroll-magic_page_bbsm-options")){
            $('html.wp-toolbar').addClass('wpsg_active');
            var html = '<div class="wpsg_raiting">Enjoyed <b>Scroll Magic Wordpress</b>? Please leave us a <div class="wpsg_content_star">';
                html += ' <a href="mailto:bestbugteam@gmail.com" class="wpsg_star_1 fa fa-star" title = "Really bad"></a> ';
                html += ' <a href="mailto:bestbugteam@gmail.com" class="wpsg_star_2 fa fa-star" title ="Bad"></a>';
                html += ' <a href="mailto:bestbugteam@gmail.com" class="wpsg_star_3 fa fa-star" title = "Okay"></a>';
                html += ' <a href="https://1.envato.market/19418234" target="_blank" class="wpsg_star_4 fa fa-star" title = "Good"></a>';
                html += ' <a href="https://1.envato.market/19418234" target="_blank" class="wpsg_star_5 fa fa-star" title = "Very good"></a>';
                html += '</div> rating. We really appreciate your support!</div>';
            $('#footer-left').html(html);
            $('.wpsg_star_4').on('click',function(){
                setTimeout(function(){   
                    window.location.href = "mailto:bestbugteam@gmail.com";
                }, 1000);
            });
            $(".notice-warning").css("display","none");
            $(".settings-error").css("display","none");
            $(".notice.is-dismissible").css("display","none");
        }
		$('.bbsm-button-delete').live('click', function(){
            var $self = $(this),
                id = $self.attr('data-id'),
                $table = $self.closest('table').DataTable(),
                $row = $self.closest('tr');
                
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this scene!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function(willDelete){
                
                if (willDelete) {
                    $('.bb-ajax-loading').css({display: 'flex'});
                    $.post(ajaxurl, { 'action': 'bbsm_delete_scene', id: id }, function(response) {
                        
                        response = JSON.parse(response);
                        if(typeof response.status != 'undefined') {
                            $.growl({ title: response.title, message: response.message, location: 'br', style: response.status });
                            
                            if(response.status == 'notice') {
                                $table.row($row).remove();
                                $table.draw();
                            }
                        }
                        
                        $('.bb-ajax-loading').css({display: 'none'});
                        
                    });
                }
            });
            
            return;
            
        });
		
		$('.bbsm-button-duplicate').live('click', function(){
            var $self = $(this),
				id = $self.attr('data-id'),
                base_url = $self.attr('data-base-url'),
                $table = $self.closest('table').DataTable(),
                $row = $self.closest('tr');
                
            swal({
                title: "Are you sure?",
                text: "Copy this scene!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function(willDuplicate){
                
                if (willDuplicate) {
                    $('.bb-ajax-loading').css({display: 'flex'});
                    $.post(ajaxurl, { 'action': 'bbsm_duplicate_scene', id: id }, function(response) {
                        
                        response = JSON.parse(response);
                        if(typeof response.status != 'undefined') {
                            $.growl({ title: response.title, message: response.message, location: 'br', style: response.status });
                            
                            if(response.status == 'notice') {
								
								var row = '<tr>'+
									'<td><strong>'+response.row.id+'</strong></td>'+
									'<td>'+response.row.title+'</td>'+
									'<td>'+response.row.name+'</td>'+
									'<td style="text-align: right">'+
										'<a class="button success bbhelp--top" bbhelp-label="Edit" title="Edit" href="'+base_url+response.row.id+'">'+
											'<span class="dashicons dashicons-edit"></span>'+
										'</a>'+'\n'+
										'<button data-base-url="'+base_url+'" class="bbsm-button-duplicate button primary bbhelp--top" bbhelp-label="Duplicate" data-id="'+response.row.id+'">'+
											'<span class="dashicons dashicons-admin-page"></span></button>'+'\n'+
										'<button class="bbsm-button-delete button danger bbhelp--top" bbhelp-label="Delete" data-id="'+response.row.id+'">'+
											'<span class="dashicons dashicons-trash"></span></button>'+'\n'+
									'</td>'+
								'</tr>';
									
                                $table.row.add($(row)).draw(false);
                            }
                        }
                        
                        $('.bb-ajax-loading').css({display: 'none'});
                        
                    });
                }
            });
            
            return;
            
        });
    
	});
}(window.jQuery));
