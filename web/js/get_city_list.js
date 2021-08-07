$(document).ready(function(){    
    $("#suppliersignupform-state").on('change',function(){
        $("#suppliersignupform-city").removeAttr('disabled');
        supplierSignupFormCityList();
    });     
    
    $("#supplier-profile-state-list").on('change',function(){
        $("#supplier-profile-city-list").removeAttr('disabled');
        getSupplierProfileCityList();
    });   

    $("#customer-profile-state-list").on('change',function(){
        $("#customer-profile-city-list").removeAttr('disabled');
        getCustomerProfileCityList();
    });     

});


/* supplier signupForm city list */
function supplierSignupFormCityList(){
    var getStateName =  $("#suppliersignupform-state").val();
    $.ajax({
        url: '/account/get-city-list',		
        type: 'post',
        dataType: 'json',
        data: {'getStateName': getStateName},            
    }).done(function (response) {
        if (response.status == 200 && response.cityLists!== "") {
            var cityList = '';
            $(response.cityLists).each(function(index,value){
                cityList += '<option value ="'+value.city_name+'">'+value.city_name+'</option>'
            });
            $("#suppliersignupform-city").html(cityList);   
        }
    });	
}

/* supplier profile cityList */
function getSupplierProfileCityList(){
    var getStateName =  $("#supplier-profile-state-list").val();
    $.ajax({
        url: '/supplier/get-city-list',		
        type: 'post',
        dataType: 'json',
        data: {'getStateName': getStateName},            
    }).done(function (response) {
        if (response.status == 200 && response.cityLists !== "") {
            var cityList = '';
            $(response.cityLists).each(function(index,value){
                cityList += '<option value ="'+value.city_name+'">'+value.city_name+'</option>'
            });
            $("#supplier-profile-city-list").html(cityList); 
        }
    });	
}

/* Customer profile */
function getCustomerProfileCityList(){
    var getStateName =  $("#customer-profile-state-list").val();
    $.ajax({
        url: '/customer/get-city-list',		
        type: 'post',
        dataType: 'json',
        data: {'getStateName': getStateName},            
    }).done(function (response) {
        if (response.status == 200 && response.cityLists!== "" ) {
            var cityList = '';
            $(response.cityLists).each(function(index,value){
                cityList += '<option value ="'+value.city_name+'">'+value.city_name+'</option>'
            });
            $("#customer-profile-city-list").html(cityList); 
        }
    });	
}

