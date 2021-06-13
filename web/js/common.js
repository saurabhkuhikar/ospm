$(document).ready(function(){
	$("#cylinderbooking-cylinder_quantity").keyup(function(){
		var cylinderQuantity = $(this).val();
		var cylinderType = $("#cylinderbooking-cylinder_type").val();
		var token = $("#cylinderbooking-token").val();

	 	if(cylinderQuantity < 6){
	 		$.ajax({
	            url: '/cylinder-booking/bill-amount',
	            type: 'post',
	            dataType: 'json',
	            data: {'cylinderQuantity': cylinderQuantity, 'cylinderType': cylinderType, 'token': token}
	        }).done(function (response) {
	            if (response.status == 200) {
	                $("#cylinderbooking-total_amount").val(response.totalAmount);
	            }
	        });
	    }else{
	    	$(this).val(cylinderQuantity.substring(0, 1));
	    }
	});
});