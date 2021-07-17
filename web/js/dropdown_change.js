$(document).ready(function(){    
    $("#suppliersignupform-state").on('change',function(){
        supplierSignupFormCityList();
    }); 
    // $("#suppliersignupform-city").on('change',function(){
    //     supplierSignupFormStateList();
    // }); 
    
    $("#supplier-profile-state-list").on('change',function(){
        getSupplierProfileCityList();
    });

    // $("#supplier-profile-city-list").on('change',function(){
    //     getSupplierProfileStateList();
    // });

    $("#customer-profile-state-list").on('change',function(){
        getCustomerProfileCityList();
    }); 

    // $("#customer-profile-city-list").on('change',function(){
    //     getCustomerProfileStateList();
    // }); 

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

/* supplier signupForm state list */
function supplierSignupFormStateList(){
    var getCityName =  $("#suppliersignupform-city").val();
    $.ajax({
        url: '/account/get-state-list',		
        type: 'post',
        dataType: 'json',
        data: {'getCityName': getCityName},            
    }).done(function (response) {
        if (response.status == 200 && response.stateLists !== "") {
            var stateList = '';
            $(response.stateLists).each(function(index,value){
                stateList += '<option value ="'+value.state_name+'">'+value.state_name+'</option>'
            });
            $("#suppliersignupform-state").html(stateList); 
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
                cityList += '<option value ='+value.city_name+'>'+value.city_name+'</option>'
            });
            $("#supplier-profile-city-list").html(cityList); 
        }
    });	
}


/* supplier profile state List */
function getSupplierProfileStateList(){
    var getCityName =  $("#supplier-profile-city-list").val();
    $.ajax({
        url: '/supplier/get-state-list',		
        type: 'post',
        dataType: 'json',
        data: {'getCityName': getCityName},            
    }).done(function (response) {
        if (response.status == 200 && response.stateLists !=="") {
            var stateList = '';
            $(response.stateLists).each(function(index,value){
                stateList += "<option value = "+value.state_name+">"+value.state_name+"</option>"
            });

            $("#supplier-profile-state-list").html(stateList).val(); 
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
                cityList += '<option value ='+value.city_name+'>'+value.city_name+'</option>'
            });
            $("#customer-profile-city-list").html(cityList); 
        }
    });	
}

/* Customer profile state List */
function getCustomerProfileStateList(){
    var getCityName =  $("#customer-profile-city-list").val();
    $.ajax({
        url: '/customer/get-state-list',		
        type: 'post',
        dataType: 'json',
        data: {'getCityName': getCityName},            
    }).done(function (response) {
        if (response.status == 200 && response.stateLists !== "" ) {
            var stateList = "";
            $(response.stateLists).each(function(index,value){
                stateList += '<option value ='+value.state_name+'>'+value.state_name+'</option>'
            });           
            $("#customer-profile-state-list").html(stateList); 
        }
    });	
}