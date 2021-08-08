$( document ).ready(function(){
    
    cylinder_stocks();
});
function cylinder_stocks(){
    $.ajax({
        url: '/supplier/show-cylinder-stock-graph',		
        type: 'post',
        dataType: 'json',        
        data:  {_csrf: yii.getCsrfToken()},                   
    }).done(function (response) {
        if (response.status == 200){
            console.log(response.cylinder_quantity);
            var ctx = document.getElementById('cylinder_stocks').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response.label,
                datasets: [{
                    label: 'Cylinder type',
                    data: response.cylinder_quantity,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                    }]
                },
                options: {        
                    responsive: true,
                    legend: {
                        position: 'right',
                    },
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    
                    }
                }
            }); 
        }
    });
    
}