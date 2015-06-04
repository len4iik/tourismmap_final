<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password Reset</h2>

<div>
    <br>
    <br>
    To reset your password, complete this forms: {{ URL::to('password/link', array($token, $id)) }}<br/>
</div>
</body>
</html>