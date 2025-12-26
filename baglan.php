<?php
$baglan = new mysqli("localhost", "root", "", "dershaneotomasyon");
if ($baglan->connect_error) { die("Bağlantı hatası: " . $baglan->connect_error); }
?>