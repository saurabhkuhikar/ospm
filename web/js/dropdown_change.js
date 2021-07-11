$(document).ready(function(){
    
    $("#suppliersignupform-state").on('change',function(){
        var citylist =  $("#suppliersignupform-state").val();
        //    console.log(cityValue);suppliersignupform-city
        $.ajax({
            url: '/account/get-city-list',		
            type: 'post',
            dataType: 'json',
            data: {'citylist': citylist},
            success: function(data) {
                return data;
            },
        }).done(function (response) {
            if (response.status == 200 ) {
                $("#suppliersignupform-city").val(response.citylist);
                $("#suppliersignupform-city").html(data); 
            }
        });	
    }); 
});