<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
</head>
<body>
    <h1>Daftar Siswa</h1>
    <ul>
        @foreach($student as $student)
        <li>{{$student}}</li>
        @endforeach
    </ul>
</body>
</html>