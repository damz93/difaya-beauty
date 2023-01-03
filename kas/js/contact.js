$(document).ready(function(){	
	$("#contactForm").submit(function(event){
		submitForm();
		return false;
	});
});
// function to handle form submit
function submitForm(){
	 $.ajax({
		type: "POST",
		url: "saveContact.php",
		cache:false,
		data: $('form#contactForm').serialize(),
		success: function(response){
			$("#contact").html(response)
			$("#contact-modal").modal('hide');
		},
		error: function(){
			alert("Error");
		}
	});
}