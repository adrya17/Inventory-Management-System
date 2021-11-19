<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$vendorDetailsSearchSql = 'SELECT * FROM vendor';
	$vendorDetailsSearchStatement = $conn->prepare($vendorDetailsSearchSql);
	$vendorDetailsSearchStatement->execute();

	$output = '<table id="vendorDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Supplier ID</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Telepon (Mobile)</th>
						<th>Telepon 2</th>
						<th>Alamat</th>
						<th>Alamat 2</th>
						<th>Kota</th>
						<th>Wilayah</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $vendorDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $row['vendorID'] . '</td>' .
						'<td>' . $row['fullName'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $row['mobile'] . '</td>' .
						'<td>' . $row['phone2'] . '</td>' .
						'<td>' . $row['address'] . '</td>' .
						'<td>' . $row['address2'] . '</td>' .
						'<td>' . $row['city'] . '</td>' .
						'<td>' . $row['district'] . '</td>' .
						'<td>' . $row['status'] . '</td>' .
						'<td>
							<button class="btn btn-primary btn-sm btn-edit-vendor" data-id="'. $row['vendorID'] .'">Edit</button>
						</td>' .
					'</tr>';
	}
	
	$vendorDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Supplier ID</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Telepon (Mobile)</th>
							<th>Telepon 2</th>
							<th>Alamat</th>
							<th>Alamat 2</th>
							<th>Kota</th>
							<th>Wilayah</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>