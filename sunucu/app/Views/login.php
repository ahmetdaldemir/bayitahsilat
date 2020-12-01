<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahsilat</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/styles/css/themes/lite-purple.css">
</head>

<body class="text-left">
    <div class="auth-layout-wrap" style="background-image: url(<?=base_url()?>/public/assets/images/photo-wide-4.jpg)">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-12">
                        <div class="p-4">
                            <div class="text-center mb-4">
                                <img src="<?=base_url()?>/public/assets/images/logo.png" alt="">
                            </div>
                            <h1 class="mb-3 text-18">Giriş Yap</h1>
                            <form method="post" action="<?=base_url()?>/login/process">
                                <div class="form-group">
                                    <label for="email">EPosta</label>
                                    <input id="email" class="form-control form-control-rounded" type="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Şifre</label>
                                    <input id="password" class="form-control form-control-rounded" type="password" name="password"> 
                                </div>
                                <button class="btn btn-rounded btn-primary btn-block mt-2">Giriş Yap</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>/public/assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?=base_url()?>/public/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/public/assets/js/es5/script.min.js"></script>
</body>

</html>