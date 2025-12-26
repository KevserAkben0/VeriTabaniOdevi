<?php include 'baglan.php'; ?>
<h2>Ders ve Program Yönetimi</h2>

<form method="POST">
    <h3>Yeni Ders Tanımla</h3>
    <input type="text" name="ders_adi" placeholder="Örn: Matematik" required>
    <button type="submit" name="ders_ekle">Dersi Kaydet</button>
</form>

<hr>

<form method="POST">
    <h3>Ders Programı Oluştur</h3>
    <select name="secilen_ders">
        <?php
        $dersler = $baglan->query("SELECT * FROM Dersler");
        while($d = $dersler->fetch_assoc()){
            echo "<option value='{$d['DersID']}'>{$d['DersAdi']}</option>";
        }
        ?>
    </select>
    <input type="text" name="gun" placeholder="Örn: Pazartesi" required>
    <input type="time" name="saat" required>
    <button type="submit" name="program_ekle">Programa Ekle</button>
</form>

<?php
// Ders Ekleme İşlemi
if(isset($_POST['ders_ekle'])){
    $ders = $_POST['ders_adi'];
    $baglan->query("INSERT INTO Dersler (DersAdi) VALUES ('$ders')");
    echo "Ders eklendi!";
}

// Program Ekleme İşlemi
if(isset($_POST['program_ekle'])){
    $ders_id = $_POST['secilen_ders'];
    $gun = $_POST['gun'];
    $saat = $_POST['saat'];
    $baglan->query("INSERT INTO DersProgrami (DersID, Gun, Saat) VALUES ('$ders_id', '$gun', '$saat')");
    echo "Programa eklendi!";
}
?>
<br><br><a href="index.php">Ana Sayfaya Dön</a>