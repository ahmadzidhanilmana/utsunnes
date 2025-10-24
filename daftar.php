<?php
// --- Ambil & validasi input ---
$first = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
$last  = isset($_POST['last_name'])  ? trim($_POST['last_name'])  : '';
$city  = isset($_POST['city'])       ? trim($_POST['city'])       : '';
$umur  = isset($_POST['umur'])       ? $_POST['umur']             : '';

$errors = [];
if ($first === '' || $last === '' || $city === '' || $umur === '') {
  $errors[] = 'Semua field wajib diisi.';
}
if ($umur !== '' && !is_numeric($umur)) {
  $errors[] = 'Umur harus berupa angka.';
}
if (is_numeric($umur)) {
  $umur = (int)$umur;
  if ($umur < 10) {
    $errors[] = 'Umur minimal adalah 10 tahun.';
  }
}

function e($str){ return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Registrasi User</title>
  <style>
    *{box-sizing:border-box}
    body{
      margin:0; min-height:100vh; display:flex; align-items:flex-start; justify-content:center;
      font-family: Arial, Helvetica, sans-serif;
      background-image:url('https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg');
      background-size:cover; background-position:center; padding:30px 16px;
    }
    .card{
      width:min(940px, 96vw); background:#fff; border:1px solid #ddd; border-radius:10px;
      box-shadow:0 8px 20px rgba(0,0,0,.15); padding:24px 28px;
    }
    h2{ margin:0 0 10px; text-align:center; color:#0f172a }
    .alert{ margin:10px 0 16px; border-radius:8px; padding:12px; border:1px solid; font-weight:700; text-align:center }
    .success{ background:#d4edda; border-color:#c3e6cb; color:#155724 }
    .error{ background:#fde2e1; border-color:#f5c2c7; color:#842029 }
    table{ width:100%; border-collapse:collapse; margin-top:10px }
    th, td{ border:1px solid #e5e7eb; padding:10px 12px; text-align:left }
    th{ background:#f1f5f9 }
    .foot-actions{ display:flex; justify-content:center; margin-top:16px }
    .btn{ background:#3b82f6; color:#fff; border:0; border-radius:8px; padding:10px 18px; font-weight:700; text-decoration:none }
    .btn:hover{ filter:brightness(.95) }
  </style>
</head>
<body>
  <div class="card">
    <h2>Data Registrasi User</h2>

<?php if (!empty($errors)): ?>
    <div class="alert error">
      <?php echo e(implode(' ', $errors)); ?>
    </div>
    <div class="foot-actions">
      <a class="btn" href="index.html">Kembali ke Form Registrasi</a>
    </div>
<?php else: ?>
    <div class="alert success">Registrasi Berhasil!</div>

    <table>
      <thead>
        <tr>
          <th style="width:80px">No</th>
          <th>Nama Lengkap</th>
          <th style="width:140px">Umur</th>
          <th style="width:220px">Asal Kota</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $full   = strtoupper($first . ' ' . $last);
        $cityUp = strtoupper($city);

        for ($i = 1; $i <= $umur; $i++) {
          // 3) tampilkan ganjil saja
          if ($i % 2 === 0) { continue; }
          // 4) skip 7 dan 13
          if ($i === 7 || $i === 13) { continue; }

          echo '<tr>';
          echo '<td>'. $i .'</td>';
          echo '<td>'. e($full) .'</td>';
          echo '<td>'. $umur .' tahun</td>';
          echo '<td>'. e($cityUp) .'</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>

    <div class="foot-actions">
      <a class="btn" href="index.html">Kembali ke Form Registrasi</a>
    </div>
<?php endif; ?>
  </div>
</body>
</html>
