<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Nieuwe reactie op uw ticket</h1>
</head>

<body>
    <h1>Beste {{ $ticket->creator->first_name }} {{ $ticket->creator->last_name }},</h1>

    <p>Er is een nieuwe reactie geplaatst op uw ticket <strong>"{{ $ticket->title }}"</strong> door
        {{ $admin->first_name }} {{ $admin->last_name }}.</p>
</body>

</html>
