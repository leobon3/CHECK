<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .custom-form {
            max-width: 400px;
            border: 2px solid #000;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="center-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="custom-form">
                        <h1>Forgot Password</h1>

                        <form method="post" action="send-password-reset.php" class="mt-4">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name="user_email" id="user_email" placeholder="example@gmail.com">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
    
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
