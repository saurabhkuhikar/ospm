$(document).ready(function(e){
    $("#search-state-name").on('change',function(){
        var state_name = $('#search-state-name').val();
    //    alert('state :'+state_name);
       $.ajax({
            url: '/state-city-search/index',		
            type: 'post',
            dataType: 'php',
            data: {'state_name': state_name}
        })
    }); 

    $('body').on('click','#cylinder-booking',function (event) {
        var bookBtn = $('#cylinder-booking').attr("href"); 
        alert('bookBtn'+bookBtn);
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