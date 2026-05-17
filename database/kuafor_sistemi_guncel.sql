-- Önce eski randevular tablosunu temizleyelim ki çakışmasın
DROP TABLE IF EXISTS `randevular`;
DROP TABLE IF EXISTS `hizmetler`;
DROP TABLE IF EXISTS `kullanicilar`;

-- 1. Kullanıcılar Tablosu
CREATE TABLE `kullanicilar` (
  `kullanici_id` INT AUTO_INCREMENT PRIMARY KEY,
  `ad_soyad` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `telefon` VARCHAR(20) NOT NULL,
  `sifre` VARCHAR(255) NOT NULL,
  `rol` ENUM('Musteri', 'Kuafor') DEFAULT 'Musteri',
  `kayit_tarihi` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. VIP Hizmetler Tablosu (Senin Yeni Eklediğin Fiyatlarla 💎)
CREATE TABLE `hizmetler` (
  `hizmet_id` INT AUTO_INCREMENT PRIMARY KEY,
  `hizmet_adi` VARCHAR(100) NOT NULL,
  `fiyat` DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Gelişmiş İlişkisel Randevular Tablosu
CREATE TABLE `randevular` (
  `randevu_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `hizmet_id` INT NOT NULL,
  `tarih` DATE NOT NULL,
  `saat` TIME NOT NULL,
  `durum` VARCHAR(50) NOT NULL DEFAULT 'Onay Bekliyor',
  `olusturulma_tarihi` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
  CONSTRAINT `fk_randevu_kullanici` FOREIGN KEY (`user_id`) REFERENCES `kullanicilar` (`kullanici_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_randevu_hizmet` FOREIGN KEY (`hizmet_id`) REFERENCES `hizmetler` (`hizmet_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ====================================================================
-- SENİN YENİ VIP FİYATLARIN VE ÖRNEK VERİLERİN YÜKLENMESİ
-- ====================================================================

-- Örnek Kullanıcı Hesapları
INSERT INTO `kullanicilar` (`kullanici_id`, `ad_soyad`, `email`, `telefon`, `sifre`, `rol`) VALUES
(1, 'Berkay Vardar', 'berkay@stylesync.com', '05555555551', '123456', 'Musteri'),
(2, 'Can Barış', 'can@stylesync.com', '05555555552', '123456', 'Musteri'),
(3, 'Murat Can Şahin', 'murat@stylesync.com', '05555555553', '123456', 'Kuafor');

-- Tamamen Senin Düzenlediğin Yeni Lüks Fiyat Listesi 🚀
INSERT INTO `hizmetler` (`hizmet_id`, `hizmet_adi`, `fiyat`) VALUES
(1, 'VIP Saç Kesimi & Stil Danışmanlığı', 5000.00),
(2, 'Modern Sakal Tasarımı & Bakım', 1000.00),
(3, 'StyleSync Özel Kombine Paket', 7500.00),
(4, 'Şekilli Fön', 750.00),
(5, 'Saç Yıkama', 200.00),
(6, 'Işıltılı Bakım Hizmeti(Keratin Bakım)', 4000.00);

-- Örnek İlk Randevu Kaydı
INSERT INTO `randevular` (`randevu_id`, `user_id`, `hizmet_id`, `tarih`, `saat`, `durum`) VALUES
(1, 1, 1, '2026-06-18', '10:00:00', 'Onaylandı');
