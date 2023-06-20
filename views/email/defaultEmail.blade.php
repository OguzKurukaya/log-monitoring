<html>
<head>
    <title>{{ $details['type'] }}</title>
</head>
<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ json_decode($details['body']) }}</p>

<p>Thank you</p>
</body>
</html>
