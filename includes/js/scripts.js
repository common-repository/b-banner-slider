jQuery.noConflict();
(function($) {
	$(document).ready(function(){
		$('#add_banner_table').hide();
		$('.add_banner_btn').click(function(){
			$('#add_banner_table').slideDown('slow');
		});
		$('#add_banner_table .close').click(function(){
			$('#add_banner_table').slideUp('slow');
		});
	});
})(jQuery);