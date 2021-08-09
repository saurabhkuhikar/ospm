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
                        barThickness: 50,
                        maxBarThickness: 50,
                        data: response.cylinder_quantity,                                                      
                        label: 'Cylinder Quantity',
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(153, 102, 255, 0.2)',                        
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(201, 203, 207)',
                        ],
                        borderWidth: 1,                      
                        }
                    ]
                },
                options: {   
                    responsive: true,
                    maintainAspectRatio:true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Cylinder Quantity',
                                font: {size: 15 }
                            },
                            ticks: {
                                padding: 10,
                            }
                        },
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Cylinder Types',
                                font: { size: 15 }
                            },
                            ticks: {
                                padding: 10,
                                
                            }
                        }
                    },
                    plugins: {
                        legend: {display:false},
                    }
                }
            }); 
        }
    });
    
}