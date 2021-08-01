$(document).ready(function(){

    var host =  "http://localhost:8080";

    $('body').on('click', '.save_cylinder_details', function (event) {
        
        // var this = $(this);
        var cylinderDetailsData = $('#formCylinderDetails').serializeArray();
        //cylinderDetailsData.push({ name: "Scenario[scenarioCalculator]", value: scenarioCalc });    
        
        $.ajax({
            url: host + '/cylinder-booking/save-cylinder-detail',
            type: 'post',
            dataType: 'json',
            data: cylinderDetailsData,
        }).done(function (cylinderDetailsResponce) {
            if (cylinderDetailsResponce.status == 200) {
                //next(this);
            }

            if (cylinderDetailsResponce.status == 401) {
                $.each(cylinderDetailsResponce.errors, function (index, value) {
                    $('.cylinderbooking-' + index).addClass('has-error');
                    $('.cylinderbooking-' + index).find('.help-block').text(value);
                });
            }
        });
    });
    

    // $(".previous").click(function(){     
    // });  

    /* find total amount */

    $("#cylinderbooking-cylinder_type").change(function(){
        calculateTotalAmount();
    });
    
    $("#cylinderbooking-cylinder_quantity").bind('keyup mouseup',function(){
        calculateTotalAmount();
    });    
});

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

function next(){
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();      
        
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        },
        duration: 700
    });
}

function prev(){
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        },
        duration: 600
    });
}
    
function calculateTotalAmount(){
    var cylinderQuantity = $("#cylinderbooking-cylinder_quantity").val();
    var cylinderType = $("#cylinderbooking-cylinder_type_id").val();		
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
                    
                    $("#GST_value").html(new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.gstAmount));
                    $("#SGST_value").html(new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.sgstAmount));
                    $("#CGST_value").html(new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.cgstAmount));
                    $('#cylinderType').html(response.cylinderType);
                    
                    $("#cylinderbooking-total_amount").html(new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.totalAmount));
                }
            });
        }
    }	
}

/* cart details show*/
// $(document).ready(function(){
//     $(".next").click(function(){       
//         var cylinderQuantity = $("#cylinderbooking-cylinder_quantity").val();
//         var orderDate = $("#cylinderbooking-order_date").val();
//         var date = new Date(orderDate);

//         console.log(date);
//         $('#cylinderQuantity').html(cylinderQuantity);
//         $('#orderDate').html(date.toDateString());		
// 	});
// });