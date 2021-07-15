$(document).ready(function(){    
    $("#suppliersignupform-state").on('change',function(){
        supplierSignupFormCityList();
    }); 
    $("#suppliersignupform-city").on('change',function(){
        supplierSignupFormStateList();
    }); 
    
    $("#profile-state").on('change',function(){
        supplierProfileCityList();
    });

    // $("#profile-city").on('change',function(){
    //     supplierProfileState();
    // });


    
    $("#profile-state").on('change',function(){
        customerProfileCityList();
    }); 

});


/* supplier signupForm city list */
function supplierSignupFormCityList(){
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
}

/* supplier signupForm state list */
function supplierSignupFormStateList(){
    var getCityId =  $("#suppliersignupform-city").val();
    $.ajax({
        url: '/account/get-state-list',		
        type: 'post',
        dataType: 'json',
        data: {'getCityId': getCityId},            
    }).done(function (response) {
        if (response.status == 200 ) {
            var stateList = '';
            $(response.stateLists).each(function(index,value){
                stateList += '<option value ='+value.state_name+'>'+value.state_name+'</option>'
            });
            $("#suppliersignupform-state").html(stateList); 
        }
    });	
}

/* supplier profile cityList */
function supplierProfileCityList(){
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
}


/* supplier profile state List */
// function supplierProfileState(){
//     var getCityId =  $("#profile-city").val();
//     $.ajax({
//         url: '/supplier/get-state-list',		
//         type: 'post',
//         dataType: 'json',
//         data: {'getCityId': getCityId},            
//     }).done(function (response) {
//         if (response.status == 200 ) {
//             var stateList = '';
//             $(response.stateLists).each(function(index,value){
//                 stateList += '<option value ='+value.state_name+'>'+value.state_name+'</option>'
//             });
//             $("#profile-state").html(stateList); 
//         }
//     });	
// }


/* Customer profile */
function customerProfileCityList(){
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
}