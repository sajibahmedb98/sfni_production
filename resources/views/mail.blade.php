
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <h4>Hello <b>sir</b>,</h4>

    <p>Client Name: <span>{{ $obj->name }}</span><br>
    Client Email: <span>{{ $obj->email }}</span><br>
    Client Subject: <span>{{ $obj->sub }}</span><br>
    Client Message: <span>{{ $obj->message }}</span></p>


    <p>You are receiving this email of the client message from your website.</p>

    <p>Regards,<br>
    SFNI</P>
</body>