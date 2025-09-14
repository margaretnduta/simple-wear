<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5; color: #111;">
    <h2>New Contact Message</h2>
    <p><strong>From:</strong> {{ $fromName }} ({{ $fromEmail }})</p>
    <p><strong>Message:</strong></p>
    <pre style="white-space: pre-wrap; font-family: inherit;">{{ $body }}</pre>
</body>
</html>
