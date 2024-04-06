<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_canteen;
use CodeIgniter\Session\Session;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Home extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Access the database connection via Dependency Injection
    }

    public function index()
    {
        if (session()->get('level')>0){
        $model= new M_canteen();
        $where=array('id_pelanggan'=>session()->get('id'));
        $data['nama']=$model->getWhere('pelanggan',$where);

        echo view('header');
        echo view ('menu',$data);
        echo view('dashboard');
        echo view ('footer');

        }else{
        return redirect()->to('home/login');

    }
}


    public function produk()
    {   
        if (session()->get('level')>0){
    	$model= new M_canteen();
        // $data['elly'] = $model->tampil('produk','id_produk');
        $data['elly'] = $model->jointiga('produk','penjual','kategori','produk.id_penjual=penjual.id_penjual','produk.id_kategori=kategori.id_kategori','produk.id_produk');
        echo view('header');
        echo view ('menu',$data);
        echo view('produk',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/login');

    }
    }
    public function pesanan()
    {   
        if (session()->get('level')>0){
        $model= new M_canteen();
        // $data['elly'] = $model->tampil('produk','id_produk');
        $data['elly'] = $model->jointiga('pesanan','pelanggan','produk','pesanan.id_pelanggan=pelanggan.id_pelanggan','pesanan.id_produk=produk.id_produk','pesanan.id_pesanan');
        echo view('header');
        echo view ('menu',$data);
        echo view('pesanan',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/login');

    }
    }
    public function mms($kat)
    {
        $model= new M_canteen();
        $where= array('kategori.id_kategori'=>$kat);
        // $data['elly'] = $model->tampil('produk','id_produk');
        $data['elly'] = $model->jointigawhere('produk','penjual','kategori','produk.id_penjual=penjual.id_penjual','produk.id_kategori=kategori.id_kategori','produk.id_produk',$where);
        echo view('header');
        echo view ('menu',$data);
        echo view('mms',$data);
        echo view ('footer');
    }
    public function order()
    {
        // if (session()->get('level')>0){
       $model= new M_canteen();
       $data['elly'] = $model->tampil('produk','id_produk');
        echo view('header');
        echo view ('menu');
        echo view('order',$data);
        echo view ('footer');
      
    }


    //tambah

    public function tambahproduk()
    {
        // if (session()->get('level')>0){
       $model= new M_canteen();
       $data['elly'] = $model->tampil('produk','id_produk');
       $data['kater'] = $model->tampil('kategori','id_kategori');
       $data['penj'] = $model->tampil('penjual','id_penjual');
        echo view('header');
        echo view ('menu');
        echo view('tambahproduk',$data);
        echo view ('footer');
      
    }

    //aksi tambah

    public function aksi_tproduk()
    {


        $id_penjual = session()->get('id'); // Sesuaikan dengan metode autentikasi Anda
        $model = new M_canteen();
        $a = $this->request->getPost('nproduk');
        $b = $this->request->getPost('hrg');
        $c = $this->request->getPost('desk');
        $d = $this->request->getPost('kat');
        $e = $this->request->getPost('npen');
        $f = $this->request->getPost('stok');
        $uploadedFile = $this->request->getFile('foto');
        $foto = $uploadedFile->getName();
       

        $isi = array(
            'nama_produk' => $a,
            'harga' => $b,
            'deskripsi' => $c,
            'id_kategori' => $d,
            'id_penjual' => $e,
            'stok' => $f,
            'foto'=>$foto
            

        );
        $model->upload($uploadedFile);
        $where=array('nproduk'=>$a);
        $model ->tambah('produk', $isi);
        
        return redirect()->to('home/produk');
    }




    //edit

     public function editproduk($id)
    {
        // if (session()->get('level')>0){
        $model= new M_canteen();
        $where= array('id_produk'=>$id);
        $data['satu']=$model->getwhere('produk',$where);
        $data['dua']=$model->joinWhere('produk','kategori','produk.id_kategori=kategori.id_kategori',$where);
        $data['tiga']=$model->joinWhere('produk','penjual','produk.id_penjual=penjual.id_penjual',$where);

        $data['elly'] = $model->tampil('produk','id_produk');
        $data['kater'] = $model->tampil('kategori','id_kategori');
        $data['penj'] = $model->tampil('penjual','id_penjual');
        echo view('header');
        echo view ('menu',$data);
        echo view('editproduk',$data);
        echo view ('footer');

        // }else{
        //     return redirect()->to('Home/login');
        // }
        
    }

    //aksi edit

    public function aksi_eproduk()
    {
        $model = new M_canteen();
        $a = $this->request->getPost('nproduk');
        $b = $this->request->getPost('hrg');
        $c = $this->request->getPost('desk');
        $d = $this->request->getPost('kat');
        $e = $this->request->getPost('npen');
        $f = $this->request->getPost('stok');
        $id = $this->request->getPost('id');

        $where= array('id_produk'=>$id);


        $isi = array(
            'nama_produk' => $a,
            'harga' => $b,
            'deskripsi' => $c,
            'id_kategori' => $d,
            'id_penjual' => $e,
            'stok' => $f
            

        );
        $model->edit('produk', $isi, $where);
        return redirect()->to('home/produk');
    }
    

    //hapus

    public function hapusproduk($id){
        $model= new M_canteen();
        $where= array('id_produk'=>$id);
        $model->hapus('produk',$where);
        return redirect()->to('Home/produk');
    }


//login
    public function login()
        {
           echo view('header');
            echo view('login');
    

}
public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    

}
    public function aksiloginpelanggan()
        {
        
        $u=$this->request->getPost('nis');
        $p=$this->request->getPost('password');

        $model = new M_canteen();
        $where=array(
          'nis'=> $u,
          'password'=> md5($p)
        );
        $cek = $model->getWhere('pelanggan',$where);
        if ($cek>0){
            session()->set('id',$cek->id_pelanggan);
             session()->set('nama',$cek->nama);
            session()->set('nis',$cek->nis);
             session()->set('level','1');
            return redirect()->to('Home');
        }else{
            return redirect()->to('Home/login');
        }
        
}

public function aksiloginpenjual()
        {
        
        $u=$this->request->getPost('nohp');
        $p=$this->request->getPost('pass');

        $model = new M_canteen();
        $where=array(
          'nohp_penjual'=> $u,
          'password'=> md5($p)
        );
        $cek = $model->getWhere('penjual',$where);
        if ($cek>0){
            session()->set('id',$cek->id_penjual);
             session()->set('nama',$cek->nama_penjual);
            session()->set('nohp_penjual',$cek->nohp_penjual);
             session()->set('level','2');
            return redirect()->to('Home');
        }else{
            return redirect()->to('Home/login');
        }
        
}

//register
public function register()
    {
        echo view('header');
        echo view('register');
    }
    public function aksi_registerpenjual()
{
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('nohp');
    $c = md5($this->request->getPost('pass')); // Mengubah password menjadi hash MD5

    $isi = array(
        'nama_penjual' => $a,
        'nohp_penjual' => $b,
        'password' => $c
    );

    $model = new M_canteen();
    $model->tambah('penjual', $isi);

    $login = array(
        'nohp_penjual' => $a,
        'password' => $c
    );

    $cek = $model->getWhere('penjual', $login);

    if ($cek > 0) {
        session()->set('id_penjual', $cek->id_penjual);
        session()->set('nama', $cek->nama_penjual);
        session()->set('nohp_penjual', $cek->nohp_penjual);
        return redirect()->to('home');
    } else {
        return redirect()->to('home/login');
    }
}
public function aksi_registerpelanggan()
{
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('nis');
    $c = $this->request->getPost('nohp');
    $d = $this->request->getPost('kelas');
    $e = md5($this->request->getPost('pass')); // Mengubah password menjadi hash MD5

    $isi = array(
        'nama' => $a,
        'nis' => $b,
        'nohp' => $c,
        'kelas' => $d,
        'password' => $e
    );

    $model = new M_canteen();
    $model->tambah('pelanggan', $isi);

    $login = array(
        'nis'=> $b,
          'password'=> $e
    );

    $cek = $model->getWhere('pelanggan', $login);

    if ($cek > 0) {
        session()->set('id_pelanggan',$cek->id_pelanggan);
             session()->set('nama',$cek->nama);
            session()->set('nis',$cek->nis);
        return redirect()->to('home');
    } else {
        return redirect()->to('home/login');
    }
}

public function profilecus($id)
{
        if (session()->get('level')>0){
        $model = new M_canteen();
        $where= array('pelanggan.id_pelanggan'=>$id);
        $where=array('id_pelanggan'=>session()->get('id'));
        
        $data['user']=$model->getWhere('pelanggan',$where);


        echo view('header');
        echo view ('menu',$data);
        echo view('profilecus',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/login');
        }
        
}
 public function aksi_eprofilecus()
    {
        $model = new M_canteen();
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('nis');
        $c = $this->request->getPost('nohp');
        $d = $this->request->getPost('kelas');
        $id = $this->request->getPost('id');

        $where= array('id_pelanggan'=>$id);


        $isi = array(
            'nama' => $a,
            'nis' => $b,
            'nohp' => $c,
            'kelas' => $d
            
            

        );
        $model->edit('pelanggan', $isi, $where);
        //print_r($isi);
        return redirect()->to('home/profilecus/'.$id);
    }
    public function profilesel($id)
{
        if (session()->get('level')>0){
        $model = new M_canteen();
        $where= array('penjual.id_penjual'=>$id);
        $where=array('id_penjual'=>session()->get('id'));
        
        $data['user']=$model->getWhere('penjual',$where);


        echo view('header');
        echo view ('menu',$data);
        echo view('profilesel',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/login');
        }
        
}
 public function aksi_eprofilesel()
    {
        $model = new M_canteen();
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('nohp');
        $id = $this->request->getPost('id');

        $where= array('id_penjual'=>$id);


        $isi = array(
            'nama_penjual' => $a,
            'nohp_penjual' => $b
           
            
            

        );
        $model->edit('penjual', $isi, $where);
        //print_r($isi);
        return redirect()->to('home/profilesel/'.$id);
    }

    //order

        public function aksi_tpesanan()
    {
        // Tangani permintaan saat tombol "Bayar" ditekan
        // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
            // Ambil data dari formulir
            $produk_ids = $_POST['produk']; // array of produk IDs
            $jumlahs = $_POST['jumlahs']; // array of jumlahs

            // ID pelanggan (contoh: disimpan di session)
            $id_pelanggan = session()->get('id'); // Sesuaikan dengan metode autentikasi Anda

            // Tanggal pesanan (tanggal sekarang)
            $tanggal_pesanan = date("Y-m-d H:i:s");

            // Load model untuk menyimpan data pesanan ke dalam database
            $model = new M_canteen();

            // Simpan data pesanan ke dalam tabel pesanan
            for ($i = 0; $i < count($produk_ids); $i++) {
                $id_produk = $produk_ids[$i];
                $jumlah = $jumlahs[$i];
                if ($jumlah>0) {
                    // Hitung total harga (saya asumsikan Anda sudah punya harga produk di database)
                //$harga_produk = $model->getHargaProduk($id_produk); // Mendapatkan harga produk dari database
                $isi = array(
                'id_produk' => $id_produk
                );
                $cek = $model->getWhere('produk', $isi);
                $harga_produk = $cek->harga;
                $total_harga = $harga_produk * $jumlah;
                $p1 = date("YmdHms");
                $kode = md5($p1 + $id_pelanggan);
                // Panggil method dalam model untuk menyimpan data pesanan
                //$model->tambahPesanan($id_produk, $id_pelanggan, $tanggal_pesanan, $jumlah, $total_harga);
                $fill = array(
                'id_produk' => $id_produk,
                'kode_pesanan' => $kode,
                'id_pelanggan' => $id_pelanggan,
                'tanggal_pesanan' => $tanggal_pesanan,
                'jumlah' => $jumlah,
                'total_harga' => $total_harga
                );
                $model ->tambah('pesanan', $fill);
                } else {
                    
                };
                
            }

            // Setelah menyimpan, Anda bisa melakukan redirect atau memberikan pesan berhasil kepada pengguna
            return redirect()->to('home');
        // }

        // print_r($produk_ids);
        // print_r($jumlahs);
    }

public function history()
    {   
        if (session()->get('level')>0){
        $model= new M_canteen();
        $where=array('pelanggan.id_pelanggan'=>session()->get('id'));

        $data['elly'] = $model->jointigawhere('pesanan','pelanggan','produk','pesanan.id_pelanggan=pelanggan.id_pelanggan','pesanan.id_produk=produk.id_produk','pesanan.id_pesanan',$where);
        echo view('header');
        echo view ('menu',$data);
        echo view('history',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/login');

    }
    }

    //print laporan

    public function formlaporan()
    {
        // if (session()->get('level')>0){
       $model= new M_canteen();
      $data['elly'] = $model->jointiga('pesanan','pelanggan','produk','pesanan.id_pelanggan=pelanggan.id_pelanggan','pesanan.id_produk=produk.id_produk','pesanan.id_pesanan');
        echo view('header');
        echo view ('menu');
        echo view('formlaporan',$data);
        echo view ('footer');
      
    }
     public function word()
    {
        $a=$this->request->getPost('awal');
        $b=$this->request->getPost('akhir');

        $model = new M_canteen();
        $data['elly']= $model->cari('pesanan','pelanggan','produk','pesanan.id_pelanggan=pelanggan.id_pelanggan','pesanan.id_produk=produk.id_produk', $a,$b,'tanggal_pesanan');

        echo view('word',$data);
        
        
    }
    public function pdf(){


        $a=$this->request->getPost('awal');
        $b=$this->request->getPost('akhir');

        $model = new M_canteen();
        $dompdf = new dompdf();
            $data['elly']= $model->cari('pesanan','pelanggan','produk','pesanan.id_pelanggan=pelanggan.id_pelanggan','pesanan.id_produk=produk.id_produk', $a,$b,'tanggal_pesanan');


        $html = view('pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream('laporan transaksi.pdf', array(
            "Attatchment" => false
        ));
        
    }
  
public function excel() {
    // Ambil data dari request
    $a = $this->request->getPost('awal');
    $b = $this->request->getPost('akhir');

    // Instansiasi model
    $model = new M_canteen();

    // Ambil data dari database
    $data['elly'] = $model->cari(
        'pesanan',
        'pelanggan',
        'produk',
        'pesanan.id_pelanggan=pelanggan.id_pelanggan',
        'pesanan.id_produk=produk.id_produk',
        $a,
        $b,
        'tanggal_pesanan'
    );

    // Load PhpSpreadsheet
    $spreadsheet = new Spreadsheet();

    // Set properti awal file Excel
    $spreadsheet->getProperties()->setTitle("Laporan Transaksi E-CANTEEN");

    // Inisialisasi penomoran baris
    $row = 1;

    // Set judul sheet
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Laporan Transaksi');

    // Set judul "LAPORAN TRANSAKSI"
    $sheet->setCellValue('A' . $row, 'LAPORAN TRANSAKSI');

    // Merge cell untuk judul dan tengahkan teks
    $sheet->mergeCells('A' . $row . ':E' . $row);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Style judul
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

    // Set border
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A1:E' . $row)->applyFromArray($styleArray);

    // Increment penomoran baris
    $row++;

    // Set judul kolom
    $sheet->setCellValue('A' . $row, 'No')
          ->setCellValue('B' . $row, 'Nama Pembeli')
          ->setCellValue('C' . $row, 'Pesanan')
          ->setCellValue('D' . $row, 'Total Transaksi')
          ->setCellValue('E' . $row, 'Tanggal Transaksi');

    // Auto-size kolom
    foreach(range('A', 'E') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Increment penomoran baris
    $row++;

    // Looping untuk mengisi data transaksi
    $no = 1;
    $grouped_transactions = array();
    foreach ($data['elly'] as $gou) {
        $kode_pesanan = $gou->kode_pesanan;
        if (!isset($grouped_transactions[$kode_pesanan])) {
            $grouped_transactions[$kode_pesanan] = array(
                'nama' => $gou->nama,
                'pesanan' => array(),
                'total_harga' => 0,
                'tanggal_pesanan' => $gou->tanggal_pesanan
            );
        }

        $grouped_transactions[$kode_pesanan]['pesanan'][] = $gou->nama_produk . " " . $gou->jumlah;
        $grouped_transactions[$kode_pesanan]['total_harga'] += $gou->total_harga;
    }

    foreach ($grouped_transactions as $kode_pesanan => $transaction) {
        $sheet->setCellValue('A' . $row, $no++)
              ->setCellValue('B' . $row, $transaction['nama'])
              ->setCellValue('C' . $row, implode(", ", $transaction['pesanan']))
              ->setCellValue('D' . $row, $transaction['total_harga'])
              ->setCellValue('E' . $row, $transaction['tanggal_pesanan']);
        $row++;
    }

    // Set border untuk sel data
    $sheet->getStyle('A2:E' . ($row - 1))->applyFromArray($styleArray);

    // Konfigurasi header untuk file Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan_transaksi.xlsx"');
    header('Cache-Control: max-age=0');

    // Output file Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}



}