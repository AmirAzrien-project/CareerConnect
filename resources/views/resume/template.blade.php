<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $data['name'] }}'s Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .section {
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <h1>Resume</h1>
    <div class="section">
        <strong>Name:</strong> {{ $data['name'] }}<br>
        <strong>Email:</strong> {{ $data['email'] }}<br>
        <strong>Phone:</strong> {{ $data['phone'] }}<br>
    </div>
    <div class="section">
        <h2>Education</h2>
        <p>{{ $data['education'] }}</p>
    </div>
    <div class="section">
        <h2>Experience</h2>
        <p>{{ $data['experience'] }}</p>
    </div>
    <div class="section">
        <h2>Skills</h2>
        <p>{{ $data['skills'] }}</p>
    </div>
</body>

</html>