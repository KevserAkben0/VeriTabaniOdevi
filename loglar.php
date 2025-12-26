<?php 
include 'baglan.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistem Logları</title>
    <style>
        body{font-family:sans-serif; margin:20px; background:#f4f4f4;}
        table{width:100%; border-collapse:collapse; background:white;}
        th,td{padding:12px; border:1px solid #ddd; text-align:left;}
        th{background:#333; color:white;}
        tr:nth-child(even){background:#f9f9f9;}
    </style>
</head>
<body>
    <nav><a href="index.php"> <- Öğrenci Kayıt Paneline Dön</a></nav>
    <h2>Arayüz 3: Sistem Güvenlik Günlüğü (Trigger Kayıtları)</h2>
    
    <table>
        <tr>
            <th>İşlem Tipi</th>
            <th>Açıklama</th>
            <th>İşlem Zamanı</th>
        </tr>
        <?php
        $sorgu = $baglan->query("SELECT * FROM SistemLog ORDER BY LogID DESC");
        
        if($sorgu->num_rows > 0){
            while($l = $sorgu->fetch_assoc()){
                echo "<tr>
                        <td><b>{$l['IslemTipi']}</b></td>
                        <td>{$l['Aciklama']}</td>
                        <td>{$l['IslemZamani']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Henüz bir işlem kaydı bulunamadı.</td></tr>";
        }
        ?>
    </table>
</body>
</html>