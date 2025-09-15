
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        .signup-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .signup-card h2 {
            margin-bottom: 1.5rem;
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

    <div class="signup-card">
        <h2 class="text-center">Sign Up</h2>
        <form id="signupForm" action="Ajaxsignup.php" method="POST">
            <div class="mb-3">
                <label for="signupName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="signupName" placeholder="Enter your full name"
                    name="username" required>
            </div>
            <div class="mb-3">
                <label for="signupEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="signupEmail" name="useremail"
                    placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="userpass"
                    placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            <div id="signupMessage" class="mt-3 text-center"></div>
        </form>
        <p class="text-center mt-3">
    Already have an account? 
    <a href="login.php" class="text-primary fw-bold">Login here</a>

</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
   $("#signupForm").on("submit", function(e){
    e.preventDefault();

    $("#signupMessage").html('<span class="text-info">Processing...</span>');
    $.ajax({
        url: "http://localhost/PHP-projects/blog-crud-api/Ajaxsignup.php",
        type: "POST",
        data: {
            username: $("#signupName").val(),
            useremail: $("#signupEmail").val(),
            userpass: $("#signupPassword").val()
        },
        dataType: "json",
        success: function(res) {
            if(res.status){
                $("#signupMessage").html(
                    '<span class="text-success">' + res.message + '</span>'
                );
                if(res.redirect){
                    setTimeout(function(){
                        window.location.href = res.redirect;
                    }, 1000); // redirect after 1s
                }
            } else {
                $("#signupMessage").html(
                    '<span class="text-danger">' + res.message + '</span>'
                );
            }
        },
        error: function(xhr, status, error){
            $("#signupMessage").html(
                '<span class="text-danger">AJAX Error: ' + error + '</span>'
            );
        }
    });
});


    </script>
</body>

</html>

