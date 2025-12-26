<?php 
include 'baglan.php'; 

if(isset($_GET['id'])){
    $id = intval($_GET['id']); 

    $silme_sorgusu = "DELETE FROM Ogrenciler WHERE OgrenciID = $id";
    
    if($baglan->query($silme_sorgusu)){
        header("Location: index.php?durum=silindi");
        exit();
    } else {
        echo "Silme Hatası: " . $baglan->error;
    }
} else {
    echo "ID gelmedi!";
}
?>