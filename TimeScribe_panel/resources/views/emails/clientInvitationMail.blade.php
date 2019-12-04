<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client invitation</title>
</head>
<body>

    <h1>Hello {{$name}}</h1>
    <h2>I have something to tell you,</h2>
    <p>The user <strong>{{$adminName}}</strong> has invited you to to see the summary of the project <strong>{{$projectName}}</strong></p>
    <p>Use the following link to accept the invitation <a href="{{$link}}">See {{$projectName}}</a></p>
    <p>Greetings from the TimeScribe team :) </p>
        
</body>
</html>

