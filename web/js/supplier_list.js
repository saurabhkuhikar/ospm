$(document).ready(function(e){
    $('body').on('click','#supplierInfo',function (event) {
        var supplierInfo = $(this).attr("supplier-data");
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