<?php
require 'vendor/autoload.php';
include 'db_config.php'; // Include file koneksi database
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date; // Library untuk konversi tanggal

if (isset($_POST['import']) && isset($_POST['file_path']) && file_exists($_POST['file_path'])) {
    $file_path = $_POST['file_path'];
    $spreadsheet = IOFactory::load($file_path);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
    
    // Lewati header (baris pertama)
    array_shift($rows); 

    $imported_count = 0;
    $error_count = 0;

    foreach ($rows as $row) {
        $nama = $conn->real_escape_string($row[0] ?? '');
		$department = $conn->real_escape_string($row[1] ?? '');
        $tanggal_excel = $row[2] ?? '';
		$hari = $row[3] ?? '';
		$jam_mulai = $row[4] ?? '';
		$jam_akhir = $row[5] ?? '';
        $jumlah = (int)($row[6] ?? 0);
		$agenda = $row[7] ?? '';
		$nama_ruang = $row[8] ?? '';
		$keperluan = $row[9] ?? '';
		$user = $row[10] ?? '';
		$hod = $row[11] ?? '';
		$hga = $row[12] ?? '';
		$os = $row[13] ?? '';

        // --- Konversi Tanggal ---
        // Excel menyimpan tanggal sebagai serial number. Fungsi Date::excelToDateTimeObject mengkonversi ini.
        if (is_numeric($tanggal_excel) && $tanggal_excel > 0) {
            try {
                $dateTimeObject = Date::excelToDateTimeObject($tanggal_excel);
                $tanggal_mysql = $dateTimeObject->format('Y-m-d'); // Format MySQL DATE
            } catch (\Exception $e) {
                // Handle error konversi tanggal jika perlu
                $tanggal_mysql = null; 
            }
        } else {
            // Jika data di excel sudah berupa string format yang valid (misal 'YYYY-MM-DD')
            $tanggal_mysql = $tanggal_excel;
        }

        // Masukkan ke database
        if ($nama && $tanggal_mysql) {
            $sql = "INSERT INTO data_inventaris (nama,department,tanggal_masuk,hari,jam_mulai,jam_akhir,jumlah,agenda,nama_ruang,keperluan,user,hod,hga,os) VALUES ('$nama','$department','$tanggal_mysql','$hari','$jam_mulai','$jam_akhir','$jumlah','$agenda','$nama_ruang','$keperluan','$user','$hod','$hga','$os')";
            if ($conn->query($sql) === TRUE) {
                $imported_count++;
            } else {
                $error_count++;
                // Anda bisa log error spesifik di sini
            }
        } else {
             $error_count++;
        }
    }

    // Hapus file temporary setelah import selesai
    unlink($file_path);
    $conn->close();

    echo "<p>Proses import selesai. Berhasil mengimpor $imported_count data. Gagal: $error_count data.</p>";
    echo "<a href='index.php'>Kembali</a>";

} else {
    echo "<p>Akses tidak valid atau file tidak ditemukan.</p>";
}
?>
