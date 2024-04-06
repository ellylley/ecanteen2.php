<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Sign Up</h3>
                                <p>Please fill the form to register.</p>
                            </div>

                            <!-- Option for Customer or Seller Registration -->
                            <div class="mb-4 text-center">
                                <button id="customerBtn" class="btn btn-primary me-2">Pelanggan</button>
                                <button id="sellerBtn" class="btn btn-primary">Penjual</button>
                            </div>

                            <!-- Form for Customer Registration -->
                            <form id="customerForm" class="row g-3 needs-validation" novalidate action="<?= base_url('home/aksi_registerpelanggan')?>" method="POST">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="customer-first-name">Nama</label>
                                        <input type="text" class="form-control" id="customer-first-name" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">NIS</label>
                                    <input type="text" id="last-name-column" class="form-control"  name="nis">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Nomor Telepon</label>
                                    <input type="text" id="username-column" class="form-control" name="nohp">
                                </div>
                            </div>
                             <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Kelas</label>
                                    <input type="text" id="username-column" class="form-control" name="kelas">
                                </div>
                            </div>

                               <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Password</label>
                                    <input type="password" id="username-column" class="form-control" name="pass">
                                </div>
                            </div>
                            
                                <!-- Add other customer registration fields here -->

                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Register sebagai Pelanggan</button>
                                </div>
                            </form>

                            <!-- Form for Seller Registration -->
                            <form id="sellerForm" class="row g-3 needs-validation mt-4 d-none" novalidate action="<?= base_url('home/aksi_registerpenjual')?>" method="POST">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="seller-first-name">Nama</label>
                                        <input type="text" class="form-control" id="seller-first-name" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Nomor Telepon</label>
                                    <input type="text" id="last-name-column" class="form-control"  name="nohp">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="username-column">Password</label>
                                    <input type="password" id="username-column" class="form-control" name="pass">
                                </div>
                            </div>
                                <!-- Add other seller registration fields here -->

                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Register sebagai Penjual</button>
                                </div>
                            </form>

                            <div class="clearfix mt-4">
                                <a href="<?= base_url('home/login')?>">Have an account? Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Function to toggle between Customer and Seller registration forms
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
