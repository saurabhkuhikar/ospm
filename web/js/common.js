$(document).ready(function(){
	$("#cylinderbooking-cylinder_type").change(function(){
		calculateTotalAmount();
	});
	
	$("#cylinderbooking-cylinder_quantity").bind('keyup mouseup',function(){
		calculateTotalAmount();
	});

	$("#list").click(function(){
		getCylinderListId();
	});
	
});

function calculateTotalAmount(){
	var cylinderQuantity = $("#cylinderbooking-cylinder_quantity").val();
	var cylinderType = $("#cylinderbooking-cylinder_type").val();		
	var token = $("#cylinderbooking-token").val();
	if(cylinderQuantity != "" && cylinderType != ""){
		if(cylinderQuantity < 6 ){
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
	}	
}

function getCylinderListId(){
	var buttonId = $("#list").val();
	// console.log(buttonId);
	$.ajax({
		url: '/site/get-table',		
		type: 'post',
		dataType: 'json',
		data: {'buttonId': buttonId}
	}).done(function (response) {
		if (response.status == 200) {
			$("#list").val(response);
		}
	});	
}
