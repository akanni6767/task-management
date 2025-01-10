<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <title>AUTHENTICATION :: LOGIN</title>
    <link rel="stylesheet" href="<?= base_url('css/src/login.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="login_wrapper">
        <section>
            <header>Login</header>
            <form id="auth_login" action="<?= url_to('verify_login') ?>" method="post">
                <div class="form_group">
                    <div class="input_form">
                        <label for="email">Email</label>
                        <div class="input_icon">
                            <span class="material-symbols-outlined">person</span>
                            <input autocapitalize="off" value="" placeholder="Type your email" type="email" name="email" id="email">
                        </div>
                    </div>
                    <span class="hint_info">Email is required</span>
                </div>
                <div class="form_group">
                    <div class="input_form">
                        <label for="password">Password</label>
                        <div class="input_icon">
                            <span class="material-symbols-outlined">lock</span>
                            <input autocapitalize="off" value="admin" placeholder="Type your password" type="password" name="password" id="password">
                        </div>
                    </div>
                    <span class="hint_info">Password must be at least 6 characters</span>
                </div>
                <div class="forget_password">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit">Login</button>
            </form>
        </section>
    </div>
    <script>
        var root = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('js/auth.js') ?>"></script>
</body>
</html>