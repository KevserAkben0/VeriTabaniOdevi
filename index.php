<?php 
ob_start(); 
include 'baglan.php'; 


if(isset($_POST['kaydet'])){
    $ad = $_POST['ad']; 
    $soyad = $_POST['soyad']; 
    $tc = $_POST['tc']; 
    $sinif = $_POST['sinif']; 
    $alan = $_POST['alan'];

    $ekle = $baglan->query("INSERT INTO Ogrenciler (Ad, Soyad, TCNo, Sinif, Alan) VALUES ('$ad','$soyad','$tc','$sinif','$alan')");

    if($ekle){
        $son_id = $baglan->insert_id;
        header("Location: odeme.php?id=" . $son_id);
        exit(); 
    } else {
        $hata = "Veritabanı Hatası: " . $baglan->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Yönetimi</title>
    <style>
        body{font-family:sans-serif; margin:20px; background:#f9f9f9;} 
        table{width:100%; border-collapse:collapse; background:white;} 
        th,td{padding:10px; border:1px solid #ddd;}
        .error{color:red; background:#ffdada; padding:10px; margin-bottom:10px; border:1px solid red;}
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Öğrenci Kayıt</a> | <a href="loglar.php">Sistem Logları</a>
    </nav>
    <h1>Arayüz 1: Öğrenci Kaydı</h1>

    <?php if(isset($hata)) echo "<div class='error'>$hata</div>"; ?>
    
    <form method="POST" style="background:white; padding:20px; border:1px solid #ccc;">
        <input type="text" name="ad" placeholder="Ad" required>
        <input type="text" name="soyad" placeholder="Soyad" required>
        <input type="text" name="tc" placeholder="TC No" maxlength="11" required>
        <select name="sinif"><option value="11">11. Sınıf</option><option value="12">12. Sınıf</option></select>
        <select name="alan"><option value="Sayısal">Sayısal</option><option value="Sözel">Sözel</option></select>
        <button type="submit" name="kaydet">Kaydet ve Ödemeye Geç</button>
    </form>

    <br>
    <table>
        <tr style="background:#eee;"><th>ID</th><th>Ad Soyad</th><th>TC</th><th>Sınıf/Alan</th><th>İşlem</th></tr>
        <?php
        $liste = $baglan->query("SELECT * FROM Ogrenciler ORDER BY OgrenciID DESC");
        while($row = $liste->fetch_assoc()){
            echo "<tr>
                <td>{$row['OgrenciID']}</td>
                <td>{$row['Ad']} {$row['Soyad']}</td>
                <td>{$row['TCNo']}</td>
                <td>{$row['Sinif']} ({$row['Alan']})</td>
                <td><a href='sil.php?id={$row['OgrenciID']}' onclick='return confirm(\"Silinsin mi?\")' style='color:red;'>[SİL]</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
<?php ob_end_flush(); ?>