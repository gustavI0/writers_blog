let deleteComment = document.getElementById('#delete_comment');

deleteComment.addEventListener('click', (e)=>{
    e.preventDefault();
	let choice = confirm(this.getAttribute('data-confirm'));

    if (choice) {
        window.location.href = this.getAttribute('href');
    }
});
