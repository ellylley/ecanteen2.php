<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
           
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        
                    </ol>
                </nav>
            </div>
        </div>

    </div>

<div class="row" id="table-contexual">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">MENU</h4>
        <div style="display: flex; justify-content: flex-end;">
    <a href="<?= base_url('home/order') ?>">
        <button class="btn btn-primary round">Order</button>
    </a>
</div>
      </div>
      <div class="card-content">
       
        <!-- table contextual / colored -->
        <div class="table-responsive">
          <table class="table mb-0">
            <thead>
              <tr class="table-active">

                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Foto</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Penjual</th>
                           
              </tr>
            </thead>
            <tbody>

              <?php

    $no=1;
    foreach($elly as $gou){
        ?>
        <tr class="table-primary">
    <td><?= $no++ ?></td>
    <td><?=$gou->nama_produk?></td> 
    <td>
    <img src="<?php echo base_url('images/'.$gou->foto)?>" style="width: 120px; height: auto;">
</td>
    <td><?=$gou->harga?></td>
    <td><?=$gou->deskripsi?></td>
    <td><?=$gou->nama_penjual?></td>
    
    
    
    </tr>
    <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>