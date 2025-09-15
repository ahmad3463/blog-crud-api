<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 2rem 2rem 0rem 2rem;
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            /* margin-bottom: 1rem; */
            color: #333;
            font-weight: 700;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #2575fc;
        }

        .btn-primary {
            background-color: #2575fc;
            border: none;
        }

        .btn-primary:hover {
            background-color: #6a11cb;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2 class="text-center">Login</h2>
        <form id="loginForm" action="Ajaxlogin.php" method="POST">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email" name="useremail"
                    required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password"
                    name="userpass" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <p class="text-center my-2   ">sign up <a href="index.php" class="fw-bold">Signup</a></p>
        </form>
        <p id="loginMsg" class="text-center fs-6"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $("#loginForm").on("submit", function (e) {
            e.preventDefault();

            $("#loginMsg").html('<span class="text-info">Processing...</span>')

            let formData = {
                useremail: $("#loginEmail").val(),
                userpass: $("#loginPassword").val()
            };

            $.ajax({
                url: 'http://localhost/PHP-projects/blog-crud-api/Ajaxlogin.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        $("#loginMsg").html('<span class="text-success">' + response.message + '</span>');

                        // Redirect after 2 seconds
                        setTimeout(function () {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            } else {
                                window.location.href = "dashboard.html";
                            }
                        }, 1000);

                    } else {
                        $("#loginMsg").html('<span class="text-danger">' + response.message + '</span>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr, status, error);
                }
            });
        });


    </script>
</body>

</html>