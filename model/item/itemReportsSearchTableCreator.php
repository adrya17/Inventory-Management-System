<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = 'SELECT * FROM item';
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();

	$output = '<table id="itemReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Kode Item</th>
						<th>Nama Item</th>
						<th>Diskon %</th>
						<th>Stok</th>
						<th>Harga Unit</th>
						<th>Status</th>
						<th>Deskripsi</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $row['productID'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						//'<td>' . $row['itemName'] . '</td>' .
						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $row['productID'] . '">' . $row['itemName'] . '</a></td>' .
						'<td>' . $row['discount'] . '</td>' .
						'<td>' . $row['stock'] . '</td>' .
						'<td>' . $row['unitPrice'] . '</td>' .
						'<td>' . $row['status'] . '</td>' .
						'<td>' . $row['description'] . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Item ID</th>
							<th>Kode Item</th>
							<th>Nama Item</th>
							<th>Diskon %</th>
							<th>Stok</th>
							<th>Harga Unit</th>
							<th>Status</th>
							<th>Deskripsi</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>