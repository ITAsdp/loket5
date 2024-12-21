<?php
session_start();

// Set default nomor antrean jika belum ada
if (!isset($_SESSION['nomor'])) {
    $_SESSION['nomor'] = 1;
}

// Memeriksa apakah tombol diklik untuk menambah nomor
if (isset($_POST['tambah'])) {
    $_SESSION['nomor']++; // Tambah nomor urut setiap kali tombol ditekan
}

// Logika untuk reset nomor
if (isset($_POST['reset'])) {
    $_SESSION['nomor'] = 1; // Reset nomor ke 0
}


$hariInggris = date('l'); // Contoh output: "Monday"
// Buat array untuk menerjemahkan nama hari
$hariIndonesia = [
    'Sunday' => 'Minggu, ',
    'Monday' => 'Senin, ',
    'Tuesday' => 'Selasa, ',
    'Wednesday' => 'Rabu, ',
    'Thursday' => 'Kamis, ',
    'Friday' => 'Jumat, ',
    'Saturday' => 'Sabtu, '
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loket Antrian</title>

    <style>
        /* Aturan untuk mencetak hanya elemen tertentu */
        @media print {
            body * {
                visibility: hidden; /* Sembunyikan semua elemen */
            }
            #print-area, #print-area * {
                visibility: visible; /* Tampilkan elemen tertentu */
            }
            #print-area {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            background-color: #f4f4f9;
        }
        .container {
            margin-top: 30px;
            line-height: 1; /* Jarak spaci */  
        }
        h1 {
            background-color: #1b3d5f;
            color: white;
            padding: 10px;
            margin: 0;
        }
        h2 {
            color: black;
            padding: 2px;
            margin: 0;
            margin-top: 100;
            margin-bottom: 100;
            font-size: 15px;
        }
        h3 {
            color: black;
            padding: 2px;
            margin: 0;
            margin-top: 100;
            margin-bottom: 100;
            font-size: 12px;
            line-height: 0.8; /* Jarak spaci */  
        }

        .box {
            display: inline-block;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            width: 350px; /* Lebar */  
            height: 185px; /* Panjang */  
            margin: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .number {
          display: inline-block;
            font-size: 45px;
            font-weight: bold;
            margin: 3px 5;
            line-height: 0.9; /* Jarak spaci */  
        }

        button {
            padding: 10px 20px;
            background-color: #1b3d5f;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #14508e;
        }

        /* CSS untuk mengatur posisi logo */
        .logo {
            position: absolute; /* Posisi absolut terhadap halaman */
            top: 5px;          /* Jarak 10px dari atas */
            right: 10px;        /* Jarak 10px dari kanan */
            width: 70px;       /* Lebar logo */
            height: auto;       /* Tinggi menyesuaikan proporsi */
        }
        .date {
            font-size: 8px;
            font-weight: bold;
            margin: 0px 0;
            line-height: 0.1; /* Jarak spaci */  
            top: 100px;          /* Jarak 10px dari atas */            
        }

        .logo3 {
            display: inline-block;
            background-color: white;
            border: 0px solid #ccc;
            padding: 10px;
            width: 58px;
            bottom: 10;
            height: 38px;
            margin: 1px;
            line-height: 0.2; /* Jarak spaci */  
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
        }
        .text {
            position: absolute; /* Posisi absolut terhadap halaman */
            top: 30px;          /* Jarak 10px dari atas */
            left: 400px;        /* Jarak 10px dari kanan */
            padding: 100px 20px;
            font-size: 11px;
            text-align: center;

        }
    </style>

</head>
<body>
    <h1>PT ASDP Indonesia Ferry (Persero) Cabang Bajoe</h1>
    <img src="LOGO.png" alt="Logo Perusahaan" class="logo">
    <div class="container">
    <div class="box">
      <!-- Bagian untuk dicetak -->
      <div id="print-area">
        <img src="LOGO2.png" alt="Logo" class="logo3">
          <h2>NOMOR ANTRIAN</h2>
              <div class="number">
                  <?php echo $_SESSION['nomor']; ?>
              </div>
              <div class="date">
                <?php
                  date_default_timezone_set("Asia/Makassar"); // Set zona waktu sesuai lokasi (WITA)
                  // Menampilkan tanggal
                  $now = new DateTime();
                  echo "<p>" . $hariIndonesia[$hariInggris] . $now->format('d-m-Y') . "</p>"; // Output: Hari-Bulan-Tahun
                  // Menampilkan waktu
                  echo date("H:i:s");     // Format: Jam:Menit:Detik (24 jam)
                  // Text
                  echo "<h3>  <br></h3>";

                ?>
              <h2>PENYEBERANGAN PELABUHAN BAJOE</h2>
              </div>
      </div>
      </div>

      <!-- Button -->
        <div>
          <form method="post">
            <button onclick="window.print()">Print</button>
            <button type="submit" name="tambah">Next</button>
            <button type="submit" name="reset">Reset</button>
          </form>
        </div>
    </div>
</body>
</html>

