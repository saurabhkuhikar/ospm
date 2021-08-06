<!-- Successful Page of booking  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>  
  <div class="container mt-50">
    <div class="row">
      <div class="jumbotron">
        <div class="successfull-icon">
          <h1 ><i class = "fa fa-check-circle"></i> Successful!</h1>
        </div>
        <h2 class="text-center">YOUR ORDER HAS BEEN RECEIVED</h2>
        <h3 class="text-center">Thank you for your payment, it’s processing</h3>
        
        <p class="text-center">Your order id is : <?= $order_id ?></p>
        <p class="text-center">You will receive an order confirmation email with details of your order and a link to track your process.</p>
        <div class="btn-group">
          <a href="/site/index" class="btn btn-primary btn-lg mt-60"><span class="glyphicon glyphicon-home"></span> Back To Home </a>
          <a href="#" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>