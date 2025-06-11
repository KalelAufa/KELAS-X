-- SQL untuk membuat view vorderdetail
CREATE VIEW vorderdetail AS
SELECT 
    od.idorderdetail,
    o.idorder,
    o.tglorder,
    o.idpelanggan,
    p.pelanggan,
    p.alamat,
    p.telp,
    p.email,
    od.idmenu,
    m.menu,
    m.harga,
    od.jumlah,
    (m.harga * od.jumlah) AS subtotal
FROM tblorderdetail od
JOIN tblorder o ON od.idorder = o.idorder
JOIN tblmenu m ON od.idmenu = m.idmenu
JOIN tblpelanggan p ON o.idpelanggan = p.idpelanggan;

-- Catatan: Jalankan query ini di phpMyAdmin atau MySQL client
-- untuk membuat view vorderdetail di database retauranphp