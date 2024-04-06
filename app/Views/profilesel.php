<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Profile</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
    }
    .profile-info {
        margin-bottom: 20px;
    }
    .profile-info label {
        font-weight: bold;
    }
</style>
</head>
<body>
<form id="sellerForm" class="" novalidate action="<?= base_url('home/aksi_eprofilesel/')?>" method="POST">
<div class="container">
    <h1>Profile Information</h1>
    <div class="profile-info">
        <label for="name">Nama:</label>
       <input name="nama" type="text" class="form-control" id="nama" value="<?= $user->nama_penjual?>">
    </div>
    <div class="profile-info">
        <label for="nis">No Telepon:</label>
        <input name="nohp" type="text" class="form-control" id="nama" value="<?= $user->nohp_penjual?>">
        <input name="id" type="hidden" class="form-control" id="nama" value="<?= $user->id_penjual?>">
    </div>
    
    
<td>

    <button class="btn btn-warning btn-sm round">Save Edit</button>

</td>
</div>
</form>
</body>
</html>


