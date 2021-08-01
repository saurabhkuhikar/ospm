$(document).ready(function(e){
    $('#login-btn').on('click',function(e){        
        // getUrlRequest();
    })
    $('body').on('click','#cylinder-booking',function (event) {
        var bookBtn = $(this).attr('href'); 
    });

});

function getUrlRequest(){    
    
    $.ajax({
        url: '/account/check-booking-button',		
        type: 'post',
        dataType: 'json',
        data: {'bookBtn':bookBtn},   
        success:function (response) {
            if (response.status == 200 ) {
            }               
        }
    });	
}