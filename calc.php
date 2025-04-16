<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body class="bg-light">
    <header class="bg-primary text-white text-center py-3 d-flex justify-content-center align-items-center gap-3">
        <h1 class="h3 mb-0">Calculator</h1>
        <img src="images/mydigitalprofile-logo.png" alt="My Digital Profile Logo" class="img-fluid rounded-circle" style="max-width: 50px;">
    </header>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post" class="text-center">
                    <div class="mb-3">
                        <input type="number" name="number1" class="form-control" placeholder="Enter a number">
                    </div>
                    <div class="mb-3">
                        <input type="number" name="number2" class="form-control" placeholder="Enter a number">
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" name="op" value="+" class="btn btn-primary">+</button>
                        <button type="submit" name="op" value="-" class="btn btn-primary">-</button>
                        <button type="submit" name="op" value="*" class="btn btn-primary">*</button>
                        <button type="submit" name="op" value="/" class="btn btn-primary">/</button>
                        <button type="submit" name="clear" class="btn btn-secondary">Clear</button>
                    </div>
                </form>
                <div class="mt-3 text-center">
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
                <div class="text-center mt-4">
                    <a href="userprofile.php" class="btn btn-secondary">Back to User Profile</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>