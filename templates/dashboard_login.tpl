<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{$basehref}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <link rel="icon" type="image/png" href="images/icon.png">
    <link rel='stylesheet' type='text/css' media='screen' href='css/dashboard_login.css'>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</head>

<body>

    <div class="d-flex justify-content-center custom">

        <form class="login-form container shadow rounded p-4 text-white col-4" method="POST" action="verify">
            <h2 class="text-center">Login</h2>
            <div class="mb-3">
            <label class="form-label">Username</label>    
                <div class="input-group">
                    <span class="input-group-text translucent"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control translucent" name="username">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text translucent"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control translucent" name="password">
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login <i class="fa-solid fa-right-to-bracket"></i></button>
            </div>
        </form>

    </div>

</body>
<html>