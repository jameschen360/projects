$(document).ready(function(){
	$('#update_revision').click(function(){

		var revision = $('#revision_edit').summernote('code');
	
		var revisionSend = new FormData();
		revisionSend.append('revision', revision);
		$.ajax({
			type: "POST",
			url: "./services/revision.php",
			data: revisionSend,
			cache: false,
			contentType: false,
			processData: false,				
			beforeSend: function(){},
			success: function(data){
				document.location.reload(true);
			}
		});						
		

	
	});
});

