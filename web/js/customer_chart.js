$( document ).ready(function(){
    
    cylinder_status();
});
function cylinder_status(){
    $.ajax({
        url: '/customer/show-booking-status',		
        type: 'post',
        dataType: 'json',        
        data:  {_csrf: yii.getCsrfToken()},                   
    }).done(function (response) {
        if (response.status == 200){
            console.log(response.bookingStatus);
            var ctx = document.getElementById('booking_status').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Pending','Process','Delivered'],
                datasets: [{
                    label: 'Booking status',
                    data: response.bookingStatus,
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
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Cylinder Quantity',
                                color:'Blue',
                                
                                font: {size: 15,}
                            },
                            ticks: {
                                padding: 10,
                            }
                        },
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Cylinder Status',
                                color:'Blue',
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