(function($) {
	'use strict';

	$(document).ready(function(){
        
        $('.checked_remove').on('click', function(){
            list_get_ids();
        });

        $('.delete_checked_ids').live('click', function(){

            var ids = $( '#ids_checked_remove' ).val();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover these scenes!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then(function(willDeleteChecked){
                if (willDeleteChecked) {
                    $('.bb-ajax-loading').css({display: 'flex'});
                    $.post(ajaxurl, { 'action': 'bbsm_delete_checked_scene', ids: ids }, function(response) {
                        var ar_ids = ids.split(",");
                        $.each( ar_ids, function( key, value ) {
                            $('#checked_remove-'+value).closest('tr').remove();
                        });
                        $('.bb-ajax-loading').css({display: 'none'});
                        
                        alert('You have successfully deleted! You will not be able to restore!');
                    });
                }
            });
            return;
        });

        $('#checked_all_remove').live('click', function(){
            var listIds = new Array();
            if( $(this).is( ':checked') ){
                $(this).val(1);

                $( '.checked_remove' ).each( function() {
                    listIds.push( $( this ).data( 'id' ) );
                });
                if ( listIds.length > 0 ) {
                    $( ".checked_remove" ).prop( "checked", true );
                    $( '#ids_checked_remove' ).val( listIds.join( ',' ) );
                    $('.delete_checked_ids').show();
                }

            }else{
                $(this).val('');
                $( ".checked_remove" ).prop( "checked", false );
                $( '#ids_checked_remove' ).val( '' );
                $('.delete_checked_ids').hide();
            }
        });

        function list_get_ids() {
            var listId = new Array();
            $( '.checked_remove' ).each( function() {
                if( $(this).is( ':checked') ){
                    $(this).val(1);
                    listId.push( $( this ).data( 'id' ) );
                }else{
                    $(this).val('');
                }
            } );
            if ( listId.length > 0 ) {
                $( '#ids_checked_remove' ).val( listId.join( ',' ) );
                $('.delete_checked_ids').show();
            } else {
                $( '#ids_checked_remove' ).val( '' );
                $('.delete_checked_ids').hide();
            }
        }

	});
	
}(window.jQuery));