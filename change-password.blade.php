
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | KPMB Student Hub</title>
</head>
<body>
    <h1>Change Password</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="current_password">Current Password</label><br>
            <input
                type="password"
                id="current_password"
                name="current_password"
                required
                autocomplete="current-password"
            >
        </div>

        <br>

        <div>
            <label for="password">New Password</label><br>
            <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                required
                autocomplete="new-password"
            >
        </div>

        <br>

        <div>
            <label for="password_confirmation">
                Confirm New Password
            </label><br>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                minlength="8"
                required
                autocomplete="new-password"
            >
        </div>

        <br>

        <button type="submit">Update Password</button>
    </form>

    <br>

    <a href="{{ url()->previous() }}">Go Back</a>
</body>
</html>
