$(document).ready(function(e){
    $('body').on('click','#supplierInfo',function (event) {
        $("#supplierModal").modal('show');
    });
    
    $('#export_btn').on('click',function(e){         
        var cylinderTypes = $('#export_type_value').val();
        if(cylinderTypes == ""){
            $(".error-message").html("Cylinder Type should not be blank").show();      
            $(".error-message").delay(2000).fadeOut(400);          
            return false;
        }

        setTimeout(function(e){
            $("#supplierModal").modal('hide'); 
        },2000);
        
    });
})