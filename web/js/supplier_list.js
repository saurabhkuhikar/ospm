$(document).ready(function(e){
    $("#clear-btn").on('click',function(){
        $('#search-state-name').val(null).trigger('change');
        $('#search-city-name').val(null).trigger('change');
        $('#search-search_input').val(""); 
        window.location('/site/index?page=1');   
    }); 

    // $('body').on('click','#cylinder-booking',function (event) {
    //     var bookBtn = $('#cylinder-booking').attr("href"); 
    //     alert('bookBtn'+bookBtn);
    // });

    $("#search-state-name").on('change',function(){
        $("#search-city-name").removeAttr('disabled');
        getCityList();
    });  

    $('body').on('click','#supplierInfo',function (event) {
        var supplierInfo = $(this).attr("supplier-data");
        $("#supplier-state").text($(this).attr("state-name"));
        $("#cityName").text($(this).attr("city-name"));
        $("#company-name").text($(this).attr("data-company"));
        
        $.ajax({
            url: '/site/get-cylinder-list-detail',		
            type: 'post',
            dataType: 'json',
            data: {'supplierInfo': supplierInfo}
        }).done(function (response) {
            if (response.status == 200 && response.cylinders != "") {
                var cylinderDetails = '';
                $(response.cylinders).each(function(index,value){
                    cylinderDetails += '<tr class="center-txt">';
                    cylinderDetails += '<td>'+value.cylinder_type+'</td>';
                    cylinderDetails += '<td>'+value.cylinder_quantity+'</td>';
                    cylinderDetails += '<td>'+new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR' }).format(value.cylinder_price)+'</td>';
                    cylinderDetails += '</tr>';
                });
                $("#cylinders").html(cylinderDetails);
                $("#supplierModal").modal('show');
            }
        });	
        
    })
});

/* city list */
function getCityList(){
    var getStateName =  $("#search-state-name").val();
    $.ajax({
        url: '/site/get-city-list',		
        type: 'post',
        dataType: 'json',
        data: {'getStateName': getStateName},            
    }).done(function (response) {
        if (response.status == 200 && response.cityLists!== "") {
            var cityList = '';
            $(response.cityLists).each(function(index,value){
                cityList += '<option value ="'+value.city_name+'">'+value.city_name+'</option>'
            });
            $("#search-city-name").html(cityList); 
        }
    });	
}