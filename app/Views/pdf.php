<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        table{
            font-family: arial;
            color: #232323;
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td{
            border: 1px solid #999;
            padding: 8px 20px;
        }
        th:nth-child(1) { /* Mengatur lebar kolom No */
            width: 5%;
        }
        h3 {
            text-align: center; /* Mengatur header agar berada di tengah */
        }
    </style>
</head>
<body>

<script type="text/javascript">
    window.print();
</script>

<br><br>

<table border="1">
    <caption><h3>LAPORAN TRANSAKSI E-CANTEEN</h3></caption> <!-- Penambahan caption -->
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pembeli</th>
            <th scope="col">Pesanan</th>
            <th scope="col">Total Transaksi</th>
            <th scope="col">Tanggal Transaksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $grouped_transactions = array(); // Menyimpan transaksi yang telah digabungkan

            // Menggabungkan transaksi dengan kode pesanan yang sama
            foreach($elly as $gou) {
                $kode_pesanan = $gou->kode_pesanan;
                if (!isset($grouped_transactions[$kode_pesanan])) {
                    $grouped_transactions[$kode_pesanan] = array(
                        'nama' => $gou->nama,
                        'pesanan' => array(),
                        'total_harga' => 0,
                        'tanggal_pesanan' => $gou->tanggal_pesanan
                    );
                }

                // Memasukkan nama_produk dan jumlah ke dalam transaksi yang sama
                $grouped_transactions[$kode_pesanan]['pesanan'][] = $gou->nama_produk . " " . $gou->jumlah;
                $grouped_transactions[$kode_pesanan]['total_harga'] += $gou->total_harga;
            }

            // Menampilkan hasil penggabungan
            foreach($grouped_transactions as $kode_pesanan => $transaction) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $transaction['nama'] ?></td> 
                    <td><?= implode(", ", $transaction['pesanan']) ?></td>
                    <td><?= $transaction['total_harga'] ?></td>
                    <td><?= $transaction['tanggal_pesanan'] ?></td>
                </tr>
                <?php 
            }
        ?>
    </tbody>
</table>
</body>
</html>
