<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <!-- Add your CSS styles here -->
    <style>
        .success-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50; /* Green background color */
            color: #fff; /* White text color */
            padding: 20px;
            border-radius: 5px;
            z-index: 9999;
        }
        .out-of-stock-label {
        color: red; /* Merubah warna font menjadi merah */
        
    }
    </style>
    <script>
        function calculateTotal() {
            let totalPrice = 0;

            document.querySelectorAll('.form-control').forEach(input => {
                const price = parseFloat(input.previousElementSibling.textContent);
                const quantity = parseInt(input.value) || 0;
                totalPrice += price * quantity;
            });

            document.getElementById('total').textContent = 'Total Harga Pemesanan: ' + totalPrice;
        }

        function showSuccessPopup() {
            const popup = document.createElement('div');
            popup.className = 'success-popup';
            popup.textContent = 'Pesanan berhasil!';

            document.body.appendChild(popup);

            setTimeout(function() {
                popup.remove();
            }, 60000); // Remove popup after 3 seconds
        }

        function validateOrder(event) {
            event.preventDefault(); // Prevent form submission
            let canSubmit = true;

            document.querySelectorAll('.form-control').forEach(input => {
                const quantity = parseInt(input.value) || 0;
                const maxQuantity = parseInt(input.max); // Get the maximum allowed quantity from HTML attribute

                if (quantity > maxQuantity) {
                    canSubmit = false;
                    alert('Maaf, stok tidak cukup untuk produk ini.');
                }
            });

            if (canSubmit) {
                // If all quantities are within stock limits, proceed with form submission
                showSuccessPopup();
                event.target.submit();
            }
        }
    </script>
</head>
<body>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Order</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                            <!-- Breadcrumb items here -->
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form action="<?= base_url('home/aksi_tpesanan')?>" method="POST" enctype="multipart/form-data" class="form form-vertical" onsubmit="validateOrder(event)">
                                    <div class="form-body">
                                        <div class="row">
                                            <?php 
                                            $availableProducts = [];
                                            $outOfStockProducts = [];
                                            foreach ($elly as $gou) {
                                                if ($gou->stok > 0) {
                                                    $availableProducts[] = $gou;
                                                } else {
                                                    $outOfStockProducts[] = $gou;
                                                }
                                            }
                                            ?>
                                            <?php foreach ($availableProducts as $gou) { ?>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical"><?= $gou->nama_produk ?></label>
                                                        <div>
                                                            <label for="first-name-vertical"><?= $gou->harga ?></label>
                                                        </div>
                                                        <input type="number" name="jumlahs[]" class="form-control"
                                                               placeholder="Jumlah" min="0" max="<?= $gou->stok ?>" oninput="calculateTotal()">
                                                        <input type="hidden" name="produk[]" value="<?= $gou->id_produk ?>">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($outOfStockProducts)) { ?>
                                            <hr> <!-- Garis pembatas -->
                                            <div class="row">
                                                <?php foreach ($outOfStockProducts as $gou) { ?>
                                                    <div class="col-12">
                                                        <div class="form-group out-of-stock">
                                                            <label for="first-name-vertical"><?= $gou->nama_produk ?></label>
                                                            <div>
                                                                <label for="first-name-vertical"><?= $gou->harga ?></label>
                                                            </div>
                                                            <span class="out-of-stock-label">Habis</span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <hr> <!-- Garis pembatas -->
                                        <p id="total">Total Harga Pemesanan: 0</p>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" name="submit_order" class="btn btn-primary me-1 mb-1">Pesan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
