<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="website-logo">
        <h1>Calculator</h1>
    </header>
    <form method="post">
        <input type="number" name="number1" placeholder="Enter a number">
        <input type="number" name="number2" placeholder="Enter a number"><br>
        <button type="submit" name="op" value="+">+</button>
        <button type="submit" name="op" value="-">-</button>
        <button type="submit" name="op" value="*">*</button>
        <button type="submit" name="op" value="/">/</button>
        <button type="submit" name="clear">Clear</button><br>
    </form>
    <div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['clear'])) {
                echo "Result: ";
            } else {
                $num1 = $_POST['number1'];
                $num2 = $_POST['number2'];
                $op = $_POST['op'];

                switch ($op) {
                    case '+':
                        $result = $num1 + $num2;
                        break;
                    case '-':
                        $result = $num1 - $num2;
                        break;
                    case '*':
                        $result = $num1 * $num2;
                        break;
                    case '/':
                        if ($num2 != 0) {
                            $result = $num1 / $num2;
                        } else {
                            $result = "Cannot divide by zero!";
                        }
                        break;
                    default:
                        $result = "Invalid operator!";
                        break;
                }
                echo "Result: " . $result;
            }
        }
        ?>
    </div>
    <div class="centered-button">
        <a href="userprofile.php">
            <button class="calc-button">
                Back to User Profile
            </button>
        </a>
    </div>
</body>

</html>