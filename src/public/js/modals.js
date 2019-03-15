$(document).ready(function(){
	$('#delete-comment').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});

$(document).ready(function(){
	$('#delete-post').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});
});