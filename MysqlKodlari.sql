
-- Veritabanı Oluşturma
CREATE DATABASE IF NOT EXISTS dershaneotomasyon;
USE dershaneotomasyon;

-- 1. Öğrenciler Tablosu (
CREATE TABLE Ogrenciler (
    OgrenciID INT AUTO_INCREMENT PRIMARY KEY, 
    Ad VARCHAR(50) NOT NULL,
    Soyad VARCHAR(50) NOT NULL,
    TCNo CHAR(11) UNIQUE NOT NULL, 
    Sinif INT NOT NULL,
    Alan VARCHAR(20) NOT NULL, 
    KayitTarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- 2. Öğretmenler Tablosu 
CREATE TABLE Ogretmenler (
    OgretmenID INT AUTO_INCREMENT PRIMARY KEY,
    AdSoyad VARCHAR(100) NOT NULL,
    Brans VARCHAR(50) NOT NULL,
    Alan VARCHAR(20) NOT NULL
);

-- 3. Dersler Tablosu 
CREATE TABLE Dersler (
    DersID INT AUTO_INCREMENT PRIMARY KEY,
    DersAdi VARCHAR(50) NOT NULL,
    Alan VARCHAR(20) NOT NULL
);

-- 4. Ödemeler Tablosu 
CREATE TABLE Odemeler (
    OdemeID INT AUTO_INCREMENT PRIMARY KEY,
    OgrenciID INT,
    Miktar DECIMAL(10,2) CHECK (Miktar > 0), 
    OdemeTarihi DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (OgrenciID) REFERENCES Ogrenciler(OgrenciID) ON DELETE CASCADE 
);

-- 5. Ders Programı 
CREATE TABLE DersProgrami (
    ProgramID INT AUTO_INCREMENT PRIMARY KEY,
    OgrenciID INT,
    DersID INT,
    OgretmenID INT,
    FOREIGN KEY (OgrenciID) REFERENCES Ogrenciler(OgrenciID) ON DELETE CASCADE,
    FOREIGN KEY (DersID) REFERENCES Dersler(DersID),
    FOREIGN KEY (OgretmenID) REFERENCES Ogretmenler(OgretmenID)
);

-- 6. Sistem Log Tablosu 
CREATE TABLE SistemLog (
    LogID INT AUTO_INCREMENT PRIMARY KEY,
    IslemTipi VARCHAR(20), 
    Aciklama TEXT,
    IslemZamani DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Öğretmen ve Ders Tanımları
INSERT INTO Ogretmenler (AdSoyad, Brans, Alan) VALUES 
('Ahmet Demir', 'Edebiyat', 'Sözel'), ('Ayşe Kaya', 'Tarih', 'Sözel'),
('Zeynel Abidin SAMAK', 'Matematik', 'Sayısal'), ('Fatma Yılmaz', 'Fizik', 'Sayısal');

INSERT INTO Dersler (DersAdi, Alan) VALUES 
('Edebiyat', 'Sözel'), ('Tarih', 'Sözel'), ('Matematik', 'Sayısal'), ('Fizik', 'Sayısal');