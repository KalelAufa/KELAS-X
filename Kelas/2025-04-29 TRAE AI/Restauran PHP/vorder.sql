-- SQL untuk membuat view vorder
CREATE VIEW vorder AS
SELECT 
    tblorder.idorder,
    tblorder.idpelanggan,
    tblorder.tglorder,
    tblorder.total,
    tblorder.bayar,
    tblorder.kembali,
    tblorder.status,
    tblpelanggan.pelanggan,
    tblpelanggan.alamat,
    tblpelanggan.telp,
    tblpelanggan.email
FROM tblorder
JOIN tblpelanggan ON tblorder.idpelanggan = tblpelanggan.idpelanggan;

-- Catatan: Jalankan query ini di phpMyAdmin atau MySQL client
-- untuk membuat view vorder di database retauranphp