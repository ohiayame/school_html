<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <!-- Error 등 메시지 표시 -->
    <?php
        if(isset($_SESSION['error'])){
            echo "<P style='color:red'>" . htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }else{
            if(isset($_SESSION['success'])){
                echo "<P style='color:green'>" . htmlspecialchars($_SESSION['success'])."</p>";
                unset($_SESSION['success']);
            }
        }
    ?>
    
    <form action="login_p.php" method="post">
        <fieldset>
            <legend>User status</legend>
            <label>ID : 
                <input type="text" name="username" require>
            </label>
            <br>
            <label>PassWord : 
                <input type="password" name="password" require>
            </label>
            <br>
            <input type="submit" value="Login">
        </fieldset>
    </form>
</body>
</html>