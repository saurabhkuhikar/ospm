$(document).ready(function(){

    // var host =  "http://localhost:8080";

    $('body').on('click', '.save_cylinder_details', function (event) {
        var cylinderDetailsData = $('#formCylinderDetails').serializeArray();
        cylinderDetailsData.push({ name: "CylinderBooking[token]", value: $("#msform").attr('data-token') });    
       
        var cylinderQuantity = $("#cylinderbooking-cylinder_quantity").val();
        var orderDate = $("#cylinderbooking-order_date").val();
        var date = new Date(orderDate);

        $('#cylinderQuantity').html(cylinderQuantity);
        $('#orderDate').html(date.toDateString());

        $.ajax({
            url: '/cylinder-booking/save-cylinder-detail',
            type: 'post',
            dataType: 'json',
            data: cylinderDetailsData,
        }).done(function (cylinderDetailsResponce) {
            if (cylinderDetailsResponce.status == 200) {
                next('save_cylinder_details');
            }

            if (cylinderDetailsResponce.status == 401) {
                $.each(cylinderDetailsResponce.errors, function (index, value) {                    
                    if(index == "order_date"){
                        $('#cylinderbooking-' + index).parent().parent().addClass('has-error');
                        $('#cylinderbooking-' + index).parent().parent().find('.help-block').text(value);
                    }else{
                        $('#cylinderbooking-' + index).parent().addClass('has-error');
                        $('#cylinderbooking-' + index).parent().find('.help-block').text(value);
                    }
                });
            }
        });

    });

    $('body').on('click', '.save_covid_details', function (event) {
        var covidDetailsData = $('#formCovidDetails').serializeArray();
        covidDetailsData.push({ name: "CylinderBooking[token]", value: $("#msform").attr('data-token') });    
    
        $.ajax({
            url: '/cylinder-booking/save-covid-detail',
            type: 'post',
            dataType: 'json',
            data: covidDetailsData,
        }).done(function (covidDetailsResponce) {
            if (covidDetailsResponce.status == 200) {
                next('save_covid_details');
            }
            if (covidDetailsResponce.status == 401) {
                $.each(covidDetailsResponce.errors, function (index, value) {
                    if(index == "covid_test_date"){
                        $('#cylinderbooking-' + index).parent().parent().addClass('has-error');
                        $('#cylinderbooking-' + index).parent().parent().find('.help-block').text(value);
                    }else{
                        $('#cylinderbooking-' + index).parent().addClass('has-error');
                        $('#cylinderbooking-' + index).parent().find('.help-block').text(value);
                    }
                });
            }
        });
    });
    
    $('body').on('click', '.save_cart_details', function (event) {
        var cylinderDetailsData = $('#formCartDetails').serializeArray();
        cylinderDetailsData.push({ name: "CylinderBooking[token]", value: $("#msform").attr('data-token') });    
        
        $.ajax({
            url: '/cylinder-booking/save-cart-detail',
            type: 'post',
            dataType: 'json',
            data: cylinderDetailsData,
        }).done(function (cylinderDetailsResponce) {
            if (cylinderDetailsResponce.status == 200) {
                next('save_cart_details');
            }
            if (cylinderDetailsResponce.status == 401) {                
                
            }
        });
    });
    
    $('body').on('click', '.save_payment_information', function (event) {
        var cylinderDetailsData = $('#formPaymentInformation').serializeArray();
        cylinderDetailsData.push({ name: "CylinderBooking[token]", value: $("#msform").attr('data-token') });    
        
        $.ajax({
            url: '/cylinder-booking/save-payment-information',
            type: 'post',
            dataType: 'json',
            data: cylinderDetailsData,
        }).done(function (cylinderDetailsResponce) {
            if (cylinderDetailsResponce.status == 200) {
                // next('save_payment_information');
            }

            if (cylinderDetailsResponce.status == 401) {
                $.each(cylinderDetailsResponce.errors, function (index, value) { 
                console.log(index);
                    $('#cylinderbooking-' + index).parent().parent().addClass('has-error');
                    $('#cylinderbooking-' + index).parent().find('.help-block').text(value);
                    
                });
            }
        });
    });
    

    $(".previous").click(function(){     
    });  

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

function next(param){
    current_fs = $("."+param).parent();
    next_fs = $("."+param).parent().parent().eq(0).next();
    // console.log(current_fs);
    console.log(next_fs);
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

function prev(param){
    current_fs = $("."+param).parent();
    previous_fs = $("."+param).parent().parent().eq(0).prev();
    
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
                    $("#cylinderbooking-total-amount").html(new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(response.totalAmount));
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