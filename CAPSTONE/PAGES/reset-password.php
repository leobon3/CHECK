 <?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$conn = require __DIR__ . "/config.php";

// $sql = "SELECT * FROM user_form
//         WHERE reset_token_hash = ?";
$sql = "SELECT * FROM user_form WHERE reset_token_hash = ? AND reset_token_expires_at > date('Y-m-d H:i:s')";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();
$checkTokenSql= "";

if ($user === null) {
    die("Token not found Or Expired");
}

// if (strtotime($user["reset_token_expires_at"]) <= time()) {
//     die("token has expired");
// }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1; /* Adding a light background color */
            color: black; /* Setting text color to black */
        }
        .form-container {
            max-width: 400px;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            background-color: #fff; /* Adding a white background color */
        }
        form {
            margin-top: 20px;
        }
        h1{
            color:#000;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Reset Password</h1>

        <form method="post" action="process-reset-password.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Repeat password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

</body>
</html>
