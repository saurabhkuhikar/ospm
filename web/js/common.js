$(document).ready(function(){
	$("#cylinderbooking-cylinder_quantity").keyup(function(){
		console.log('Hello'+$(this).val());

	 	if($(this).val().length > 1){
	        alert("error message");
	        return false;
	    }
	});
});