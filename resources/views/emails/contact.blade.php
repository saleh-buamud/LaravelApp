<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact message</title>
</head>

<body>
    <h2>New contact message</h2>
    <p><strong>Name:</strong> {{ $data['name'] ?? '' }}</p>
    <p><strong>Email:</strong> {{ $data['email'] ?? '' }}</p>
    <p><strong>Message:</strong></p>
    <div>{{ $data['message'] ?? '' }}</div>
</body>

</html>