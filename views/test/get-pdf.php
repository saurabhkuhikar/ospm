<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>phone_number</th>
            <th>company_name</th>
            <th>account_type</th>
        </tr>
        <tr>
            <th><?=$data['first_name']?></th>
            <th><?=$data['last_name']?></th>
            <th><?=$data['email']?></th>
            <th><?=$data['phone_number']?></th>
            <th><?=$data['company_name']?></th>
            <th><?=$data['account_type']?></th>
        </tr>
    </table>
</body>
</html>