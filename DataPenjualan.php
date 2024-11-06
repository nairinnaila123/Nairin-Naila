<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Data Penjualan</title>
</head>
<body>
    <h2>Sistem Pencatatan Data Penjualan</h2>
    <hr>
    <h3>Form Input untuk Data Penjualan</h3>
    <form method="post" action="">
        <label>Nama Produk:</label>
        <input type="text" name="nama" required><br><br>

        <label>Harga Per Produk:</label>
        <input type="number" name="harga" required><br><br>

        <label>Jumlah Terjual:</label>
        <input type="number" name="jumlah" required><br><br>

        <input type="submit" name="submit" value="Tambahkan Data">
    </form>

    <?php
    // Inisialisasi array untuk menyimpan data penjualan
    session_start();
    if (!isset($_SESSION['data_penjualan'])) {
        $_SESSION['data_penjualan'] = [];
    }

    // Tambah data jika form disubmit
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $harga * $jumlah;

        $data = [
            'nama' => $nama,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total' => $total
        ];

        // Menambahkan data ke dalam session
        $_SESSION['data_penjualan'][] = $data;
    }

    // Menampilkan laporan penjualan jika data tersedia
    if (!empty($_SESSION['data_penjualan'])) {
        echo "<h3>Laporan Penjualan:</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Nama</th>
                <th>Harga Per Produk</th>
                <th>Jumlah Terjual</th>
                <th>Total</th>
            </tr>";

        $totalJumlah = 0;
        $totalPenjualan = 0;
        foreach ($_SESSION['data_penjualan'] as $item) {
            echo "<tr>
                    <td>{$item['nama']}</td>
                    <td>{$item['harga']}</td>
                    <td>{$item['jumlah']}</td>
                    <td>{$item['total']}</td>
                </tr>";
            $totalJumlah += $item['jumlah'];
            $totalPenjualan += $item['total'];
        }

        echo "<tr>
                <th colspan='2'>Total Penjualan</th>
                <th>{$totalJumlah}</th>
                <th>{$totalPenjualan}</th>
            </tr>";
        echo "</table>";
    }
    ?>
</body>
</html>