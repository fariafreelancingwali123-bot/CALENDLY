<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Smart Scheduler</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f6f9;
        }

        .header {
            background-color: #0077b6;
            color: white;
            padding: 30px 0;
            text-align: center;
            border-bottom: 5px solid #023e8a;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .container h2 {
            color: #023e8a;
        }

        .container p {
            color: #555;
            line-height: 1.6;
            font-size: 18px;
        }

        .btn {
            display: inline-block;
            margin: 20px 10px 0;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            transition: background 0.3s ease;
        }

        .book-btn {
            background-color: #00b4d8;
        }

        .book-btn:hover {
            background-color: #0096c7;
        }

        .login-btn {
            background-color: #4caf50;
        }

        .login-btn:hover {
            background-color: #388e3c;
        }

        .signup-btn {
            background-color: #f39c12;
        }

        .signup-btn:hover {
            background-color: #e67e22;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 25px;
            }

            .btn {
                margin-top: 10px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Smart Scheduler</h1>
        <p>Make booking meetings simple and stress-free!</p>
    </div>

    <div class="container">
        <h2>Welcome to Your Personal Scheduling Assistant</h2>
        <p>
            Smart Scheduler allows you to set your availability, let others book time with you, 
            and manage your meetings with ease. Say goodbye to back-and-forth emails and enjoy 
            automated, smooth scheduling!
        </p>

        <a href="book.php" class="btn book-btn">Book a Meeting</a>
        <a href="login.php" class="btn login-btn">Login</a>
        <a href="signup.php" class="btn signup-btn">Signup</a>
    </div>

</body>
</html>
