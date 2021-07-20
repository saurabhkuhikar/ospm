$(document).ready(function(e){
    $('#login-btn').on('click',function(e){        
        getUrlRequest();
    })

});

function getUrlRequest(){    
    var url = sessionStorage.getItem("booking");
    $.ajax({
        url: '/account/check-user',		
        type: 'post',
        dataType: 'json',
        data: {'url':url},   
        success:function (response) {
            if (response.status == 200 ) {
                alert("Welcome To OSPM");
                sessionStorage.removeItem("booking");
            }               
        }
    });	
}