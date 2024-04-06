<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Produk</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                       
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('home/tambahproduk') ?>">
                <button class="btn btn-success round">Tambah</button>
                </a>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Penjual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php

    $no=1;
    foreach($elly as $gou){
        ?>
        <tr>
    <td><?= $no++ ?></td>
    <td><?=$gou->nama_produk?></td> 
    <td>
    <img src="<?php echo base_url('images/'.$gou->foto)?>" style="width: 120px; height: auto;">
</td>
    <td><?=$gou->harga?></td>
    <td><?=$gou->deskripsi?></td>
    <td><?=$gou->nama_kategori?></td>
    <td><?=$gou->nama_penjual?></td>
    <td><?=$gou->stok?></td>
    
    <td>
    <a href="<?= base_url('home/editproduk/'.$gou->id_produk)?>">
    <button class="btn btn-warning btn-sm round">Edit</button>
</a>
    <a href="<?= base_url('home/hapusproduk/'.$gou->id_produk)?>">
    <button class="btn btn-danger btn-sm round">Hapus</button>

    </a>
    </td>
    </tr>
    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>