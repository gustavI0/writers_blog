//Modals de suppression de billet et commentaire

// Modal de suppression de billet
$(document).ready(function(){
	$('#delete-comment').on('show.bs.modal', function(e) {
	    $(this).find('.btn_ok').attr('href', $(e.relatedTarget).data('href'));
	});
});

// Modal de suppression de commentaire
$(document).ready(function(){
	$('#delete-post').on('show.bs.modal', function(e) {
	    $(this).find('.btn_ok').attr('href', $(e.relatedTarget).data('href'));
	});
});