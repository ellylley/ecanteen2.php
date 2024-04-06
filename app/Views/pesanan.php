<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Pesanan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb"></ol>
                </nav>
            </div> 
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <table class='table mb-0' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Waktu Pemesanan</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $previous_kode_pesanan = '';
                        foreach ($elly as $gou) {
                            if ($previous_kode_pesanan != $gou->kode_pesanan) {
                                echo '<tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $gou->nama . '</td>
                                    <td>' . $gou->tanggal_pesanan . '</td>
                                    <td>
                                        <input type="checkbox" class="checkbox" data-kode-pesanan="' . $gou->kode_pesanan . '">
                                    </td>
                                    <td>
                                        <button class="btn btn-info round detail-btn">Detail</button>
                                    </td>
                                </tr>';
                            }
                            ?>
                            <tr class="additional-details" style="display: none;" data-kode-pesanan="<?= $gou->kode_pesanan ?>">
                                <td colspan="5">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Kelas</td>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Jumlah</td>
                                                <td>Harga Total</td>
                                            </tr>
                                            <?php
                                            $total_harga_pesanan = 0; // Menyimpan total harga pesanan
                                            foreach ($elly as $gou_detail) {
                                                if ($gou_detail->kode_pesanan == $gou->kode_pesanan) {
                                                    // Hitung total harga per item
                                                    $total_harga_per_item = $gou_detail->harga * $gou_detail->jumlah;

                                                    // Tambahkan total harga per item ke total harga pesanan
                                                    $total_harga_pesanan += $total_harga_per_item;

                                                    echo '<tr>
                                                        <td>' . $gou_detail->kelas . '</td>
                                                        <td>' . $gou_detail->nama_produk . '</td>
                                                        <td>' . $gou_detail->harga . '</td>
                                                        <td>' . $gou_detail->jumlah . '</td>
                                                        <td>' . $total_harga_per_item . '</td>
                                                    </tr>';
                                                }
                                            }
                                            ?>
                                            <!-- Tampilkan total harga pesanan pada baris terakhir -->
                                            <tr>
                                                <td colspan="4"><strong>Total Harga Pesanan</strong></td>
                                                <td><strong><?php echo $total_harga_pesanan; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php
                            $previous_kode_pesanan = $gou->kode_pesanan;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<style>
    /* CSS untuk mengatur warna latar belakang tabel secara bergantian */

    /* CSS untuk mengatur warna latar belakang tabel dalam detail */
    .table-bordered tbody tr:nth-child(odd) td {
        background-color: #f2f2f2; /* abu */
    }

    .table-bordered tbody tr:nth-child(even) td {
        background-color: #ffffff; /* putih */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('.checkbox');

    checkboxes.forEach((checkbox, index) => {
        const kodePesanan = checkbox.dataset.kodePesanan; // Ambil id_pesanan dari data attribute
        const key = `checkbox${kodePesanan}`; // Gunakan id_pesanan sebagai bagian dari kunci

        const value = localStorage.getItem(key);

        if (value === 'true') {
            checkbox.checked = true;
        }

        checkbox.addEventListener('change', function () {
            localStorage.setItem(key, this.checked);
        });
    });

        const detailButtons = document.querySelectorAll('.detail-btn');

        detailButtons.forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const additionalDetails = row.nextElementSibling;

                if (additionalDetails.style.display === 'none') {
                    additionalDetails.style.display = 'table-row';
                } else {
                    additionalDetails.style.display = 'none';
                }
            });
        });
    });
</script>
