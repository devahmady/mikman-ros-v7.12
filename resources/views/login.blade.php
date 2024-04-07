<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:title" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:description" content="Zenix - Crypto Admin Dashboard">
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <title>Zenix - Crypto Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{ asset('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('assets') }}/images/mikman.png" alt=""
                                            class="img-fluid" width="200">
                                    </div>
                                    <form action="{{ route('login.page') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Ip address</strong></label>
                                            <input type="text" class="form-control" id="ip" name="ip">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" id="user" name="user">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="submitBtnLogin" class="btn btn-info w-100"
                                                onclick="showLoading()">Login</button>
                                            <div id="loadinglogin" class="d-none text-center mt-3">
                                                <div class="spinner-border text-info" role="status">
                                                </div>
                                                <span class="visually-hidden"></span>
                                            </div>
                                        </div>
                                        <script>
                                            function showLoading() {
                                                document.getElementById('submitBtnLogin').style.display = 'none';
                                                document.getElementById('loadinglogin').classList.remove('d-none');
                                            }
                                        </script>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>version 2.3 rev2.2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets') }}/vendor/global/global.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('assets') }}/js/custom.min.js"></script>
    <script src="{{ asset('assets') }}/js/deznav-init.js"></script>
    <script src="{{ asset('assets') }}/js/demo.js"></script>
    <script src="{{ asset('assets') }}/js/styleSwitcher.js"></script>
</body>

</html>
