<?php
require 'vendor/autoload.php'; // Sesuaikan path jika berbeda
use PhpOffice\PhpSpreadsheet\IOFactory;

$preview_data = [];
$file_path = '';

if (isset($_POST['preview'])) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (in_array($_FILES['excel_file']['type'], $file_mimes)) {
        $upload_file = $_FILES['excel_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        $file_path = 'uploads/' . time() . '.' . $extension; // Simpan file sementara

        if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $file_path)) {
            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            // Ambil header (baris pertama)
            $header = array_shift($rows); 

            // Ambil data untuk preview
            foreach ($rows as $row) {
                // Pastikan indeks kolom sesuai dengan file Excel Anda (misal: Kolom A=0, B=1, C=2, D=3)
                $data_row = [
					'nama' => $row[0] ?? '',
					'department' => $row[1] ?? '',
                    'tanggal_masuk' => $row[2] ?? '', // Data mentah dari Excel
					'hari' => $row[3] ?? '',
					'jam_mulai' => $row[4] ?? '',
					'jam_akhir' => $row[5] ?? '',
                    'jumlah' => $row[6] ?? '',
					'agenda' => $row[7] ?? '',
					'nama_ruang' => $row[8] ?? '',
					'keperluan' => $row[9] ?? '',
					'user' => $row[10] ?? '',
					'hod' => $row[11] ?? '',
					'hga' => $row[12] ?? '',
					'os' => $row[13] ?? ''
                ];
                $preview_data[] = $data_row;
            }
        }
    } else {
        echo "<p style='color: red;'>Format file tidak didukung. Harap unggah file Excel (.xls atau .xlsx).</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Excel - Preview</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Unggah File Excel untuk Pratinjau</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="excel_file" required>
        <button type="submit" name="preview">Pratinjau Data</button>
    </form>

    <?php if (!empty($preview_data)): ?>
        <h3>Pratinjau Data</h3>
        <form method="POST" action="import.php">
            <!-- Kirim data yang sudah di-parse dan path file melalui hidden fields -->
            <input type="hidden" name="file_path" value="<?php echo htmlspecialchars($file_path); ?>">
            <button type="submit" name="import">Konfirmasi Import ke Database</button>
            <table>
                <thead>
                    <tr>
                     <!--   <th>Nama Barang</th> -->
						<th>Nama</th>
						<th>Department</th>
                        <th>Tanggal Masuk (Format Excel)</th>
						<th>Hari</th>
						<th>Jam Mulai</th>
						<th>Jam Akhir</th>
                        <th>Jumlah</th>
						<th>Agenda</th>
						<th>Nama Ruang</th>
						<th>Keperluan</th>
						<th>User</th>
						<th>Hod</th>
						<th>Hga</th>
						<th>Os</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($preview_data as $row): ?>
                        <tr>
                           
							<td><?php echo htmlspecialchars($row['nama']); ?></td>
							<td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_masuk']); ?></td>
							<td><?php echo htmlspecialchars($row['hari']); ?></td>
							<td><?php echo htmlspecialchars($row['jam_mulai']); ?></td>
							<td><?php echo htmlspecialchars($row['jam_akhir']); ?></td>
                            <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
							<td><?php echo htmlspecialchars($row['agenda']); ?></td>
							<td><?php echo htmlspecialchars($row['nama_ruang']); ?></td>
							<td><?php echo htmlspecialchars($row['keperluan']); ?></td>
							<td><?php echo htmlspecialchars($row['user']); ?></td>
							<td><?php echo htmlspecialchars($row['hod']); ?></td>
							<td><?php echo htmlspecialchars($row['hga']); ?></td>
							<td><?php echo htmlspecialchars($row['os']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    <?php endif; ?>
</body>
</html>
