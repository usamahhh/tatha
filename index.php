<!DOCTYPE html>
<html>
<head>
	<title>PENCARIAN TERM</title>
	<style type="text/css">
		* {
			font-family: "Trebuchet MS";
		}
		h1 {
			text-transform: uppercase;
			color: salmon;
		}
		table {
			border: 1px solid #ddeeee;
			border-collapse: collapse;
			border-spacing: 0;
			width: 70%;
			margin: 10px auto 10px auto;
		}
		th, td {
			border: 1px solid #ddeeee;
			padding: 20px;
			text-align: left;
		}
	</style>
</head>
<body>
	<center><h1>Pencarian Term</h1></center>
	<form method="GET" action="index.php" style="text-align: center;">
		<label>Kata Pencarian : </label>
		<input type="text" name="kata_cari" value="<?php if(isset($_GET['kata_cari'])) { echo $_GET['kata_cari']; } ?>"  />
		<button type="submit">Cari</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Nama File</th>
				<th>Term</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			//untuk meinclude kan koneksi
			include('koneksi.php');

				//jika kita klik cari, maka yang tampil query cari ini
				if(isset($_GET['kata_cari'])) {
					//menampung variabel kata_cari dari form pencarian
					$kata_cari = $_GET['kata_cari'];

					//untuk mencari kata dari variable namafile dan term
					$query = "SELECT * FROM term WHERE namafile like '%".$kata_cari."%' OR term like '%".$kata_cari."%'  ORDER BY ID ASC";
				} else {
					//jika tidak ada pencarian, default yang dijalankan query ini
					$query = "SELECT * FROM term ORDER BY ID ASC";
				}
				

				$result = mysqli_query($koneksi, $query);

				if(!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				}
				//kalau ini melakukan perulangan
				while ($row = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $row['ID']; ?></td>
				<td><?php echo $row['namafile']; ?></td>
				<td><?php echo $row['term']; ?></td>
				
			</tr>
			<?php
			}
			?>

		</tbody>
	</table>
</body>
</html>