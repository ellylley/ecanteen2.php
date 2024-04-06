 <div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Produk</h3>
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                       
                    </ol>
                </nav>
            </div>
        </div>

    </div>


 <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/aksi_tproduk')?>" method="POST" enctype="multipart/form-data">
                            <form class="form">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Produk</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Nama Produk"
                                                name="nproduk">
                                        </div>
                                    </div>

                                    <input type="hidden" id="ide" class="form-control" name="npen" value="<?= session()->get('id')?>">


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Foto</label>
                                            <input type="file" id="foto" class="form-control" name="foto">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Harga</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder="Harga"
                                                name="hrg">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Deskripsi</label>
                                            <input type="text" id="city-column" class="form-control" placeholder="Deskripsi" name="desk">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Kategori</label>
                                            <select type="text" class="form-control" name="kat">
                        echo "<option>Pilih</option>";

                      <?php
                        foreach($kater as $gou){
                          ?>
                          <option value="<?=$gou->id_kategori?>"><?=$gou->
                          nama_kategori?></option>
                        <?php }?>
                        </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Penjual</label>
                                            <select type="text" class="form-control" name="npen">
                        echo "<option>Pilih</option>";

                      <?php
                        foreach($penj as $gou){
                          ?>
                          <option value="<?=$gou->id_penjual?>"><?=$gou->
                          nama_penjual?></option>
                        <?php }?>
                        </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Stok</label>
                                            <input type="text" id="email-id-column" class="form-control" name="stok"
                                                placeholder="Stok">
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class='form-check'>
                                            <div class="checkbox">
                                               
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                       
                                    </div>
                                </div>
                            </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>