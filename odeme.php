<?php 
include 'baglan.php'; 

if(isset($_GET['id'])) {
    $oid = intval($_GET['id']);
} else {
    die("Hata: Öğrenci ID bulunamadı.");
}

$sorgu = $baglan->query("SELECT * FROM Ogrenciler WHERE OgrenciID = $oid");
$ogrenci = $sorgu->fetch_assoc();

if(isset($_POST['ode'])){
    $miktar = $_POST['miktar'];
    
    $baglan->query("INSERT INTO Odemeler (OgrenciID, Miktar) VALUES ($oid, $miktar)");
    
    $alan = $ogrenci['Alan'];
    $atama_sorgusu = "SELECT d.DersID, o.OgretmenID 
                      FROM Dersler d 
                      JOIN Ogretmenler o ON d.Alan = o.Alan 
                      WHERE d.Alan = '$alan'";

    $dersler_hocalar = $baglan->query($atama_sorgusu);

    while($satir = $dersler_hocalar->fetch_assoc()){
        $did = $satir['DersID'];
        $hid = $satir['OgretmenID'];
       
        $baglan->query("INSERT INTO DersProgrami (OgrenciID, DersID, OgretmenID) VALUES ($oid, $did, $hid)");
    }

 
    echo "<div style='font-family:sans-serif; padding:20px; border:2px solid green; border-radius:10px; background:#eaffea;'>";
    echo "<h2 style='color:green;'>✔️ Ödeme Alındı ve Kayıt Tamamlandı!</h2>";
    echo "<p><b>Öğrenci:</b> {$ogrenci['Ad']} {$ogrenci['Soyad']} ({$ogrenci['Alan']})</p>";
    echo "<hr>";
    echo "<h3>Haftalık Ders Programınız ve Atanan Öğretmenler:</h3><table border='1' cellpadding='10' style='border-collapse:collapse; width:100%; background:white;'>";
    echo "<tr style='background:#ddd;'><th>Ders Adı</th><th>Öğretmen</th></tr>";

    $program_sorgu = $baglan->query("SELECT d.DersAdi, o.AdSoyad 
                                     FROM DersProgrami dp 
                                     JOIN Dersler d ON dp.DersID = d.DersID 
                                     JOIN Ogretmenler o ON dp.OgretmenID = o.OgretmenID 
                                     WHERE dp.OgrenciID = $oid");
    
    while($p = $program_sorgu->fetch_assoc()){
        echo "<tr><td>{$p['DersAdi']}</td><td>{$p['AdSoyad']}</td></tr>";
    }
    
    echo "</table>";
    echo "<br><a href='index.php' style='text-decoration:none; background:blue; color:white; padding:10px; border-radius:5px;'>Yeni Kayıt Yap</a>";
    echo " | <a href='loglar.php' style='text-decoration:none; color:gray;'>Sistem Loglarını Gör</a>";
    echo "</div>";
    
    exit; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ödeme ve Onay</title>
</head>
<body style="font-family:sans-serif; margin:40px;">
    <h1>Ödeme Onay Ekranı</h1>
    <p>Öğrenci: <b><?php echo $ogrenci['Ad'] . " " . $ogrenci['Soyad']; ?></b></p>
    <p>Alan: <b><?php echo $ogrenci['Alan']; ?></b></p>
    
    <form method="POST">
        <label>Ödeme Tutarı (TL):</label><br>
        <input type="number" name="miktar" value="5000" style="padding:10px;" required>
        <br><br>
        <button type="submit" name="ode" style="padding:10px 20px; background:green; color:white; border:none; border-radius:5px; cursor:pointer;">
            Ödemeyi Tamamla ve Programı Oluştur
        </button>
    </form>
</body>
</html>