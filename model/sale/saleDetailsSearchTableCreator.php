<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$uPrice = 0;
	$qty = 0;
	$totalPrice = 0;
	
	$saleDetailsSearchSql = 'SELECT * FROM sale';
	$saleDetailsSearchStatement = $conn->prepare($saleDetailsSearchSql);
	$saleDetailsSearchStatement->execute();

	$output = '<table id="saleDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Penjualan ID</th>
						<th>Kode Item</th>
						<th>Pelanggan ID</th>
						<th>Nama Pelanggan</th>
						<th>Nama Item</th>
						<th>Tanggal Penjualan</th>
						<th>Diskon %</th>
						<th>Kuantitas</th>
						<th>Harga Unit</th>
						<th>Total Harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $saleDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$uPrice = $row['unitPrice'];
		$qty = $row['quantity'];
		$discount = $row['discount'];
		$totalPrice = $uPrice * $qty * ((100 - $discount)/100);
			
		$output .= '<tr>' .
						'<td>' . $row['saleID'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						'<td>' . $row['customerID'] . '</td>' .
						'<td>' . $row['customerName'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['saleDate'] . '</td>' .
						'<td>' . $row['discount'] . '</td>' .
						'<td>' . $row['quantity'] . '</td>' .
						'<td>' . $row['unitPrice'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
						'<td>
							<button class="btn btn-primary btn-sm btn-edit-sale" data-id="'. $row['saleID'] .'">Edit</button>
						</td>' .
					'</tr>';
	}
	
	$saleDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Penjualan ID</th>
							<th>Kode Item</th>
							<th>Pelanggan ID</th>
							<th>Nama Pelanggan</th>
							<th>Nama Item</th>
							<th>Tanggal Penjualan</th>
							<th>Diskon %</th>
							<th>Kuantitas</th>
							<th>Harga Unit</th>
							<th>Total Harga</th>
							<th>Aksi</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>


