<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Mini Project - Data Mahasiswa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      line-height: 1.6;
    }
    input, button {
      padding: 6px 10px;
      margin: 4px 0;
    }
    label {
      display: block;
      margin-top: 10px;
    }
    .error {
      color: red;
      margin: 5px 0;
    }
    .hasil {
      background: #f0f0f0;
      padding: 15px;
      margin-top: 20px;
      border-left: 5px solid #4CAF50;
    }
  </style>
</head>
<body>

  <h2>Formulir Data Mahasiswa</h2>

  <form method="POST" action="">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" required>

    <label for="prodi">Program Studi:</label>
    <input type="text" id="prodi" name="prodi" required>

    <label for="semester">Semester:</label>
    <input type="number" id="semester" name="semester" min="1" max="14" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <br><br>
    <button type="submit">Kirim Data</button>
  </form>

  <?php
    $data = null;
    $error = [];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama           = trim($_POST["nama"] ?? "");
        $nim            = trim($_POST["nim"] ?? "");
        $prodi          = trim($_POST["prodi"] ?? "");
        $semesterInput  = $_POST["semester"] ?? "";
        $email          = trim($_POST["email"] ?? "");

        // Validasi
        if ($nama === "") {
            $error[] = "Nama wajib diisi.";
        }
        if ($nim === "") {
            $error[] = "NIM wajib diisi.";
        }
        if ($prodi === "") {
            $error[] = "Program studi wajib diisi.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Format email tidak valid.";
        }
        if (!ctype_digit((string)$semesterInput) || (int)$semesterInput < 1 || (int)$semesterInput > 14) {
            $error[] = "Semester harus berupa angka 1–14.";
        }

        // Jika tidak ada error
        if (empty($error)) {
            $data = [
                "nama"     => $nama,
                "nim"      => $nim,
                "prodi"    => $prodi,
                "semester" => (int)$semesterInput,
                "email"    => $email
            ];
        }
    }
  ?>

  <?php if (!empty($error)): ?>
    <div style="margin-top: 20px;">
      <?php foreach ($error as $err): ?>
        <p class="error"><?= htmlspecialchars($err) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if ($data !== null): ?>
    <div class="hasil">
      <h3>Data Mahasiswa Diterima</h3>
      <p><strong>Nama:</strong> <?= htmlspecialchars($data["nama"]) ?></p>
      <p><strong>NIM:</strong> <?= htmlspecialchars($data["nim"]) ?></p>
      <p><strong>Program Studi:</strong> <?= htmlspecialchars($data["prodi"]) ?></p>
      <p><strong>Semester:</strong> <?= htmlspecialchars($data["semester"]) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($data["email"]) ?></p>
    </div>
  <?php endif; ?>

</body>
</html>