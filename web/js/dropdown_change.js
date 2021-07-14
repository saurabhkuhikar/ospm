$(document).ready(function(){    
        $("#suppliersignupform-state").on('change',function(){
        var getStateId =  $("#suppliersignupform-state").val();
        $.ajax({
            url: '/account/get-city-list',		
            type: 'post',
            dataType: 'json',
            data: {'getStateId': getStateId},            
        }).done(function (response) {
            if (response.status == 200 ) {
                var cityList = '';
                $(response.cityLists).each(function(index,value){
                    cityList += '<option value ='+value.city_name+'>'+value.city_name+'</option>'
                });
                $("#suppliersignupform-city").html(cityList); 
            }
        });	
    }); 
});

/* supplier profile.php */
$(document).ready(function(){    
    $("#profile-state").on('change',function(){
    var getStateId =  $("#profile-state").val();
        $.ajax({
            url: '/supplier/get-city-list',		
            type: 'post',
            dataType: 'json',
            data: {'getStateId': getStateId},            
        }).done(function (response) {
            if (response.status == 200 ) {
                var cityList = '';
                $(response.cityLists).each(function(index,value){
                    cityList += '<option value ='+value.city_name+'>'+value.city_name+'</option>'
                });
                $("#profile-city").html(cityList); 
            }
        });	
    }); 
});
/* Customer profile.php */
$(document).ready(function(){    
    $("#profile-state").on('change',function(){
    var getStateId =  $("#profile-state").val();
        $.ajax({
            url: '/customer/get-city-list',		
            type: 'post',
            dataType: 'json',
            data: {'getStateId': getStateId},            
        }).done(function (response) {
            if (response.status == 200 ) {
                var cityList = '';
                $(response.cityLists).each(function(index,value){
                    cityList += '<option value ='+value.city_name+'>'+value.city_name+'</option>'
                });
                $("#profile-city").html(cityList); 
            }
        });	
    }); 
});