<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Marbill Technologies</title>
</head>

<body>
    Dear {{ $customer->full_name }} !
    {{$content}}
    Thank You,
    <br />
    {{ env('MAIL_FROM_ADDRESS', 'hello@example.com') }}

    <br />
    {{ env('COMPANY_NAME', 'Marbill Technologies') }}
</body>

</html>
