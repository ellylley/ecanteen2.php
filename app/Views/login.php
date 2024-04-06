<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Sign In</h3>
                                <p>Please sign in to continue to E-Canteen.</p>
                            </div>

                            <!-- Option for Customer or Seller Login -->
                            <div class="mb-4 text-center">
                                <button id="customerBtn" class="btn btn-primary me-2">Pelanggan</button>
                                <button id="sellerBtn" class="btn btn-primary">Penjual</button>
                            </div>

                            <!-- Form for Customer Login -->
                            <form id="customerForm" class="row g-3 needs-validation" novalidate action="<?= base_url('home/aksiloginpelanggan')?>" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">NIS</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="nis" name="nis">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        <!-- <a href="auth-forgot-password.html" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a> -->
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-start">
                                        <!-- <button class="btn btn-primary float-end">Switch</button> -->
                                    </div>
                                    <div class="float-end">
                                        <a href="<?= base_url('home/register')?>">Don't have an account?</a>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Login</button>
                                </div>
                            </form>

                            <!-- Form for Seller Login -->
                            <form id="sellerForm" class="row g-3 needs-validation mt-4 d-none" novalidate action="<?= base_url('home/aksiloginpenjual')?>" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="phone">Nomor HP</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="phone" name="nohp">
                                        <div class="form-control-icon">
                                            <i data-feather="phone"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <label for="seller_password">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="seller_password" name="pass">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                      </div>
                                    </div>
                                </div>
                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-start">
                                        <!-- <button class="btn btn-primary float-end">Switch</button> -->
                                    </div>
                                    <div class="float-end">
                                        <a href="<?= base_url('home/register')?>">Don't have an account?</a>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Login</button>
                                </div>
                            </form>

                            <div class="divider"></div>
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Function to toggle between Customer and Seller login forms
        document.getElementById('customerBtn').addEventListener('click', function() {
            document.getElementById('customerForm').classList.remove('d-none');
            document.getElementById('sellerForm').classList.add('d-none');
        });

        document.getElementById('sellerBtn').addEventListener('click', function() {
            document.getElementById('customerForm').classList.add('d-none');
            document.getElementById('sellerForm').classList.remove('d-none');
        });
    </script>
</body>
