<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum PHP - Lab 7</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
    input, button { padding: 6px 10px; margin: 4px 0; }
  </style>
</head>
<body>

  <?php
    // ========== LATIHAN 1 ==========
    echo "<p>PHP berhasil dijalankan.</p>";
    echo "<p>Waktu server: " . date("d-m-Y H:i:s") . "</p><br>";
  ?>

  <?php
    // ========== LATIHAN 2 ==========
    $nama = "Siti";
    $tugas = 85;
    $uts = 78;
    $uas = 90;

    $nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

    if ($nilaiAkhir >= 85) {
        $predikat = "A";
    } elseif ($nilaiAkhir >= 75) {
        $predikat = "B";
    } elseif ($nilaiAkhir >= 60) {
        $predikat = "C";
    } else {
        $predikat = "D";
    }

    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
    echo "Predikat: " . $predikat . "<br><br>";
  ?>

  <?php
    // ========== LATIHAN 3 ==========
    $mahasiswa = ["Alya", "Bima", "Citra", "Doni", "Eka", "Farah", "Gilang"];

    echo "<h3>Daftar Mahasiswa</h3>";
    echo "<ol>";
    foreach ($mahasiswa as $namaMhs) {
        echo "<li>" . htmlspecialchars($namaMhs) . "</li>";
    }
    echo "</ol><br>";
  ?>

  <?php
    // ========== LATIHAN 4 ==========
    function hitungDiskon($harga, $persen) {
        $potongan = $harga * ($persen / 100);
        return $harga - $potongan;
    }

    function hitungLuasPersegiPanjang($panjang, $lebar) {
        return $panjang * $lebar;
    }

    $hargaAkhir = hitungDiskon(150000, 10);
    echo "Harga setelah diskon: Rp" . number_format($hargaAkhir, 0, ",", ".") . "<br>";

    $luas = hitungLuasPersegiPanjang(8, 4);
    echo "Luas persegi panjang: " . $luas . "<br><br>";
  ?>

  <!-- ========== LATIHAN 5 (Form GET) ========== -->
  <form method="GET" action="">
    <label for="kata">Kata kunci:</label><br>
    <input id="kata" name="kata" type="text">
    <button type="submit">Cari</button>
  </form>

  <?php
    if (isset($_GET["kata"])) {
        $kata = trim($_GET["kata"]);
        echo "<p>Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8") . "</p>";
    }
  ?>

  <!-- ========== LATIHAN 6 (Form POST) ========== -->
  <br>
  <form method="POST" action="">
    <label for="nama">Nama:</label><br>
    <input id="nama" name="nama" type="text" required><br>

    <label for="prodi">Program Studi:</label><br>
    <input id="prodi" name="prodi" type="text" required><br><br>

    <button type="submit" name="kirim">Kirim Data</button>
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["kirim"])) {
        $nama  = trim($_POST["nama"] ?? "");
        $prodi = trim($_POST["prodi"] ?? "");

        if ($nama === "" || $prodi === "") {
            echo "<p>Semua kolom wajib diisi.</p>";
        } else {
            echo "<h3>Data diterima</h3>";
            echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
            echo "Program Studi: " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8");
        }
    }
  ?>

    <!-- ========== LATIHAN 7 (Pengolahan Data Sederhana) ========== -->
  <br><br>
  <form method="POST" action="">
    <label>Nama barang:</label><br>
    <input name="barang" type="text" required><br>

    <label>Harga:</label><br>
    <input name="harga" type="number" min="0" step="0.01" required><br>

    <label>Jumlah:</label><br>
    <input name="jumlah" type="number" min="1" step="1" required><br><br>

    <button type="submit" name="hitung">Hitung</button>
  </form>

  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["hitung"])) {
        $barang       = trim($_POST["barang"] ?? "");
        $hargaInput   = $_POST["harga"] ?? "";
        $jumlahInput  = $_POST["jumlah"] ?? "";

        if (
            $barang === "" ||
            !is_numeric($hargaInput) ||
            !ctype_digit((string)$jumlahInput) ||
            (float)$hargaInput < 0 ||
            (int)$jumlahInput < 1
        ) {
            echo "<p style='color:red;'>Periksa kembali nama barang, harga, dan jumlah.</p>";
        } else {
            $harga    = (float)$hargaInput;
            $jumlah   = (int)$jumlahInput;
            $subtotal = $harga * $jumlah;

            echo "<p>Barang: " . htmlspecialchars($barang) . "</p>";
            echo "<p>Subtotal: Rp" . number_format($subtotal, 0, ",", ".") . "</p>";
        }
    }
  ?>

</body>
</html>