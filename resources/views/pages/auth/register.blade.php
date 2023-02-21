<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    
    <form action="/register" method="POST">
        @csrf
        <label for="">Username</label>
        <input type="text" name="name">
        <br>
        <label for="">Email</label>
        <input type="email" name="email">
        @error('email')
            {{ $errors->first('email') }}
        @enderror
        <br>
        <label for="">Password</label>
        <input type="password" name="password">
        @error('password')
            {{ $errors->first('password') }}
        @enderror
        <br>
        <label for="">Password Confirmation</label>
        <input type="password" name="password_confirmation">
        @error('password_confirmation')
            {{ $errors->first('password_confirmation') }}
        @enderror
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>