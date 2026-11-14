<?php
session_start();
require_once 'include/connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login_master WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['isLogin'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $row['usertype'];

        echo "<script>alert('You have logged in successfully');location.href='home.php'</script>";
    } else {
        echo "<script>alert('Invalid email or password')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Blind Voting System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #171268 0%, #764ba2 100%);
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 480px;
            backdrop-filter: blur(10px);
        }

        h1 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 50px;
            height: 4px;
            background: #764ba2;
            margin: 10px auto;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 500;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus {
            outline: none;
            border-color: #764ba2;
            box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.2);
        }

        .voting-options {
            margin-top: 2rem;
            display: none;
        }

        .option {
            background: white;
            padding: 1.2rem;
            margin-bottom: 1rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: none;
            border: 2px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #764ba2;
        }

        .option.selected {
            background: #764ba2;
            color: white;
            border-color: #764ba2;
        }

        .option::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .option.selected::before {
            background: white;
            border-color: white;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #171268 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        button:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            transform: none;
        }

        .message {
            margin-top: 1rem;
            text-align: center;
            color: #4a5568;
            font-size: 0.95rem;
            padding: 0.8rem;
            border-radius: 8px;
            background: #f7fafc;
        }

        .error {
            color: #e53e3e;
            background: #fff5f5;
            border: 1px solid #fed7d7;
        }

        .success {
            color: #2f855a;
            background: #f0fff4;
            border: 1px solid #c6f6d5;
        }

        /* Progress indicator */
        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #171268 0%, #764ba2 100%);
            width: 0;
            transition: width 0.3s ease;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .option {
            animation: fadeIn 0.5s ease forwards;
        }

        .password-field {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 65%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 5px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            background: transparent;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            user-select: none;
        }

        .toggle-password:hover {
            transform: translateY(-50%) scale(1.1);
            background-color: rgba(118, 75, 162, 0.1);
        }

        button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #171268 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        p {
            text-align: center;
            margin-top: 1rem;
        }

        a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .toggle-password {
                width: 44px;
                height: 44px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="" method="POST">
            <div id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your E-mail" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                </div>
                <button type="submit" name="login">Login</button>
            </div><br>
            <p class="mt-3">Don't have an account? <a href="registration.php">Register</a></p>
        </form>
    </div>
    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            const toggle = field.nextElementSibling;
            if (field.type === 'password') {
                field.type = 'text';
                toggle.textContent = '🔓';  // Unlocked emoji when password is visible
            } else {
                field.type = 'password';
                toggle.textContent = '👁️';  // Eye emoji when password is hidden
            }
        }
    </script>
</body>
</html>