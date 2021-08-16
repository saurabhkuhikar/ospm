$(document).ready(function(e){
    $('body').on('click','#cylinderBookOrderStatus',function (event) {
        $("#orderStatusModal").modal('show');
    });
    
    $('#export_btn').on('click',function(e){         
        var cylinderOrderDate = $('#orderDate').val();
        if(cylinderOrderDate == ""){
            $(".error-message").html("Order Date should not be blank").show();      
            $(".error-message").delay(2000).fadeOut(400);          
            return false;
        }

        setTimeout(function(e){
            $("#orderStatusModal").modal('hide'); 
        },2000);
        
    });
})