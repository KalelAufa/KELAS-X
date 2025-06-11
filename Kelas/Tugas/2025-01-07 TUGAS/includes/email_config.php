<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Pastikan jalur ini benar jika menggunakan Composer

class EmailConfig
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true); // Buat instance PHPMailer

        // Konfigurasi server SMTP
        $this->mail->isSMTP(); // Set mailer untuk menggunakan SMTP
        $this->mail->Host = 'smtp.example.com'; // Ganti dengan server SMTP Anda
        $this->mail->SMTPAuth = true; // Aktifkan otentikasi SMTP
        $this->mail->Username = 'your_email@example.com'; // Ganti dengan alamat email Anda
        $this->mail->Password = 'your_password'; // Ganti dengan password email Anda
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Aktifkan enkripsi TLS
        $this->mail->Port = 587; // Port yang digunakan untuk SMTP (587 untuk TLS)

        // Konfigurasi pengirim dan penerima
        $this->mail->setFrom('your_email@example.com', 'Your Name'); // Ganti dengan nama dan email pengirim
    }

    public function sendEmail($to, $subject, $body)
    {
        try {
            // Set penerima
            $this->mail->addAddress($to); // Tambahkan penerima

            // Set konten email
            $this->mail->isHTML(true); // Set email format ke HTML
            $this->mail->Subject = $subject; // Set subjek email
            $this->mail->Body = $body; // Set isi email

            // Kirim email
            $this->mail->send();
            return true; // Email berhasil dikirim
        } catch (Exception $e) {
            return false; // Gagal mengirim email: $this->mail->ErrorInfo;
        }
    }
}
?>