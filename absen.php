<?php
// Koneksi ke MySQL
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "satpam"; 

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noPegawai = $_POST['noPegawai'];
    $nama = $_POST['nama'];
    $shift = $_POST['shift'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO absensi (noPegawai, nama, shift, gender)
            VALUES ('$noPegawai', '$nama', '$shift', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data absensi berhasil disimpan.');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

$sql = "SELECT * FROM absensi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 font-sans text-gray-200">

    <!-- Container -->
    <div class="container mx-auto p-6 max-w-4xl">
      
      <!-- Title -->
      <h1 class="text-4xl font-extrabold text-center text-blue-400 mb-6">Form Absensi</h1>

      <!-- Form -->
      <form id="absensiForm" action="absen.php" method="POST" class="space-y-6 bg-gray-800 p-6 rounded-lg shadow-lg">
        <div class="space-y-4">
          <div>
            <label for="noPegawai" class="block text-sm font-medium text-blue-500">Nomor Pegawai</label>
            <input
              type="text"
              name="noPegawai"
              id="noPegawai"
              class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>
          
          <div>
            <label for="nama" class="block text-sm font-medium text-blue-500">Nama</label>
            <input
              type="text"
              name="nama"
              id="nama"
              class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
              required
            />
          </div>

          <!-- Dropdown for Shift -->
          <div>
            <label for="shift" class="block text-sm font-medium text-blue-500">Shift</label>
            <select
              name="shift"
              id="shift"
              class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
              required
            >
              <option value="Pagi">Pagi</option>
              <option value="Malam">Malam</option>
            </select>
          </div>

          <!-- Dropdown for Gender -->
          <div>
            <label for="gender" class="block text-sm font-medium text-blue-500">Gender</label>
            <select
              name="gender"
              id="gender"
              class="mt-1 w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500"
              required
            >
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
              <option value="Tidak Menyebutkan">Tidak Menyebutkan</option>
            </select>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            id="submitBtn"
            class="w-full py-3 text-white font-semibold bg-blue-600 hover:bg-blue-700 rounded-lg shadow-lg transition duration-300"
          >
            Submit
          </button>
        </div>
      </form>

      <!-- Data Table -->
      <h2 class="text-3xl font-bold text-center text-blue-400 mt-12">Data Absensi</h2>
      <div class="overflow-x-auto mt-4">
        <table class="min-w-full border border-gray-700 bg-gray-800 text-white rounded-lg shadow-lg">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">No. Pegawai</th>
              <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Shift</th>
              <th class="px-6 py-3 bg-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Gender</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700">
            <?php
            if ($result->num_rows > 0) {
                // Tampilkan data absensi
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td class='px-6 py-4 whitespace-nowrap'>" . $row['noPegawai'] . "</td>
                            <td class='px-6 py-4 whitespace-nowrap'>" . $row['nama'] . "</td>
                            <td class='px-6 py-4 whitespace-nowrap'>" . $row['shift'] . "</td>
                            <td class='px-6 py-4 whitespace-nowrap'>" . $row['gender'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='px-6 py-4 text-center'>Tidak ada data absensi</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Button Kembali ke Dashboard -->
      <div class="mt-6 text-center">
        <a
          href="DashBoard.html"
          class="py-2 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md"
        >
          Kembali ke Dashboard
        </a>
      </div>

    </div>

    <?php
    // Tutup koneksi
    $conn->close();
    ?>

</body>
</html>
