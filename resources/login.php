<html>
<head>
    <title>Login page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90%;
        }

        div.form {
            text-align: left;
            border: 2px solid salmon;
            padding: 12px;
        }
    </style>
</head>
<body>

<div class="form">
    <form action="/login" method="POST">
        <h1>Sign in</h1>
        <div class="form-label">
            <label>Username:</label> <input type="text" placeholder="Enter username" name="name" required>
        </div>
        <div class="form-label">
            <label>Password:</label> <input type="password" placeholder="Enter password"
                                            name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
