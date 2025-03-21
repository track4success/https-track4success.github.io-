<?php
include("../connect.php");
session_start();

switch ($_POST['form']) {

	case 'displayorderslist':
		if ($_POST['srchprod'] != '') {
			$searchuseracc = "AND (a.payment_id LIKE '%" . $_POST['srchprod'] . "%')";
		} else {
			$searchuseracc = "";
		}

		if ($_POST['orderstat'] != '') {
			$orderstat = "AND a.status = '" . $_POST['orderstat'] . "'";
		} else {
			$orderstat = "";
		}

		if ($_POST['datefrom'] != "" && $_POST['dateto'] == "") {
			$DateFilter = "AND DATE(a.date_added) = '" . date('Y-m-d', strtotime($_POST['datefrom'])) . "'";
		} else if ($_POST['datefrom'] == "" && $_POST['dateto'] != "") {
			$DateFilter = "AND DATE(a.date_added) = '" . date('Y-m-d', strtotime($_POST['dateto'])) . "'";
		} else if ($_POST['datefrom'] != "" && $_POST['dateto'] != "") {
			$DateFilter = "AND DATE(a.date_added) BETWEEN '" . date('Y-m-d', strtotime($_POST['datefrom'])) . "' AND '" . date('Y-m-d', strtotime($_POST['dateto'])) . "'";
		} else {
			$DateFilter = "";
		}

		$counter = 0;
		$page = $_POST["page"];
		$limit = ($page - 1) * 10;
		$res = mysqli_query($connection, "SELECT a.payment_id, CASE WHEN c.middlename = '' OR c.middlename IS NULL THEN CONCAT(c.lastname, ', ', c.firstname) ELSE CONCAT(c.lastname, ', ', c.firstname, ' ', LEFT(c.middlename, '1'), '.') END, a.amount, a.status, b.product_id, b.customer_id, a.order_id, a.paymenttype FROM payments AS a LEFT JOIN orders AS b ON a.order_id = b.order_id LEFT JOIN users AS c ON b.customer_id = c.user_id LEFT JOIN products AS d ON b.product_id = d.product_id WHERE a.id != '' " . $searchuseracc . " " . $orderstat . " " . $DateFilter . " ORDER BY a.payment_id ASC LIMIT " . $limit . ",10");
		$numrows = mysqli_num_rows($res);
		if ($numrows == TRUE) {
			while ($row = mysqli_fetch_array($res)) {

				$counter++;

				if ($row[3] == "PENDING") {
					$paymentstatus = "<span class='label label-light-danger'>Pending</span>";
				} elseif ($row[3] == "FORAPPROVAL") {
					$paymentstatus = "<span class='label label-light-danger'>For Approval</span>";
				} else {
					$paymentstatus = "<span class='label label-light-success'>Paid</span>";
				}

				echo "<tr style='cursor:pointer;'>
							<td style='white-space: nowrap; text-align: center;'>" . $counter . "</td>
							<td style='white-space: nowrap;'>" . $row[0] . "</td>
	                        <td style='white-space: nowrap;'>" . $row[1] . "</td>
	                        <td style='white-space: nowrap;'>" . number_format($row[2], "2", ".", ",") . "</td>
	                        <td style='white-space: nowrap;'>" . $row[7] . "</td>
	                        <td style='white-space: nowrap;'>" . $paymentstatus . "</td>
	                        <td style='white-space: nowrap; text-align: center;'>
	                        	<i class='fas fa-eye fa-lg text-info' style='cursor:pointer;' onclick='modalopenorderdet(\"" . $row[4] . "\", \"" . $row[6] . "\", \"" . $row[5] . "\")' title='Edit Branch'></i>
	                        </td>
	                    </tr>";
			}
			echo "|" . $counter;
		} else {
			echo "<tr><td  colspan='12' style='text-align:center'>No Record Found . . .</td></tr>";
		}
		break;

	case "loadorderslistPagination":
		if ($_POST['srchprod'] != '') {
			$searchuseracc = "AND (a.payment_id LIKE '%" . $_POST['srchprod'] . "%')";
		} else {
			$searchuseracc = "";
		}

		if ($_POST['orderstat'] != '') {
			$orderstat = "AND a.status = '" . $_POST['orderstat'] . "'";
		} else {
			$orderstat = "";
		}

		if ($_POST['datefrom'] != "" && $_POST['dateto'] == "") {
			$DateFilter = "AND DATE(a.date_added) = '" . date('Y-m-d', strtotime($_POST['datefrom'])) . "'";
		} else if ($_POST['datefrom'] == "" && $_POST['dateto'] != "") {
			$DateFilter = "AND DATE(a.date_added) = '" . date('Y-m-d', strtotime($_POST['dateto'])) . "'";
		} else if ($_POST['datefrom'] != "" && $_POST['dateto'] != "") {
			$DateFilter = "AND DATE(a.date_added) BETWEEN '" . date('Y-m-d', strtotime($_POST['datefrom'])) . "' AND '" . date('Y-m-d', strtotime($_POST['dateto'])) . "'";
		} else {
			$DateFilter = "";
		}

		$page = $_POST["page"];
		$rowCount = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(a.id) FROM payments AS a LEFT JOIN orders AS b ON a.order_id = b.order_id LEFT JOIN users AS c ON b.customer_id = c.user_id LEFT JOIN products AS d ON b.product_id = d.product_id WHERE a.id != '' " . $searchuseracc . " " . $orderstat . " " . $DateFilter . ";"));
		$rowsperpage = 10;
		$range = 1;
		$totalpages = ceil($rowCount[0] / $rowsperpage);
		$prevpage;
		$nextpage;
		if ($page > 1) {
			echo "<li style='width:50px !important;' onclick='orderlistPageFunc(1)'><< </li>";
			$prevpage = $page - 1;
			echo "<li style='width:70px !important;' onclick='orderlistPageFunc(" . $prevpage . ")'>< </li>";
		}
		for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
			if (($x > 0) && ($x <= $totalpages)) {
				if ($x == $page) {
					echo "<li id='pgorderlistPageFunc" . $x . "' class='pgnumorderlistPageFunc active' onclick='orderlistPageFunc(" . $x . "," . $x . ")'>" . $x . "</li>";
					$ex = $x;
				} else {
					echo "<li id='pgorderlistPageFunc" . $x . "' class='pgnumorderlistPageFunc' onclick='orderlistPageFunc(" . $x . "," . $x . ")'>" . $x . "</li>";
					$ex = $x;
				}
			}
		}
		if ($page < ($totalpages - $range)) {
			echo "<li>...</li>";
		}
		if ($page != $totalpages && $rowCount[0] != 0) {
			$nextpage = $page + 1;
			echo "<li style='width:50px !important;' onclick='orderlistPageFunc(" . $nextpage . ", " . $nextpage . ")'> ></li>";
			echo "<li style='width:50px !important;' onclick='orderlistPageFunc(" . $totalpages . ", " . $totalpages . ")'> >></li>";
		}
		echo "|" . $ex;
		break;

	case 'fncdsplyorderinfo':
		// IMAGE
		echo "<div class='row' style='padding-left: 12px; padding-right: 12px;'>";
		$res0 = mysqli_query($connection, "SELECT image, imagename, id FROM products_image WHERE product_id = '" . $_POST['product_id'] . "'");
		$numrows0 = mysqli_num_rows($res0);
		if ($numrows0 == TRUE) {
			while ($row0 = mysqli_fetch_array($res0)) {
				$image = "../" . $row0[0];
				$count++;
				if ($count >= 2) {
					echo "<div class='col-md-4 colimagesize' style='padding: 3px 4px;'>
	                            <img class='card-img-top img-responsive' src='" . $image . "' alt='Card image cap' style='border: 1px solid #f3efea !important;cursor:pointer' onclick='viewvalidIDphoto(\"" . $image . "\")'>
	                        </div>";
				} else {
					echo "<div class='col-md-12 colimagesize' style='padding: 3px 4px;'>
	                            <img class='card-img-top img-responsive' src='" . $image . "' alt='Card image cap' style='border: 1px solid #f3efea !important;cursor:pointer' onclick='viewvalidIDphoto(\"" . $image . "\")'>
	                        </div>";
				}
			}
		} else {
			echo "";
		}
		echo "</div>";
		// END IMAGE


		$proddetails = mysqli_fetch_array(mysqli_query($connection, "SELECT productname FROM products WHERE product_id = '" . $_POST['product_id'] . "';"));

		echo "|" . $proddetails[0] . "|" . $proddetails[1] . "|" . $proddetails[2] . "|" . $proddetails[3] . "|" . $proddetails[4];

		$orderdetails = mysqli_fetch_array(mysqli_query($connection, "SELECT quantity, price, shipfee, totalamt, paymenttype FROM orders WHERE order_id = '" . $_POST['order_id'] . "';"));

		echo "|" . $orderdetails[0] . "|" . number_format($orderdetails[1], "2", ".", ",") . "|" . number_format($orderdetails[2], "2", ".", ",") . "|" . number_format($orderdetails[3], "2", ".", ",") . "|" . $orderdetails[4];

		$customerdetails = mysqli_fetch_array(mysqli_query($connection, "SELECT CASE WHEN a.middlename = '' OR a.middlename IS NULL THEN CONCAT(a.lastname, ', ', a.firstname) ELSE CONCAT(a.lastname, ', ', a.firstname, ' ', LEFT(a.middlename, '1'), '.') END, b.contactnum, b.address, b.latitude, b.longitude FROM users AS a LEFT JOIN user_details AS b ON a.user_id = b.user_id WHERE a.user_id = '" . $_POST['customer_id'] . "';"));

		echo "|" . $customerdetails[0] . "|" . $customerdetails[1] . "|" . $customerdetails[2] . "|" . $customerdetails[3] . "|" . $customerdetails[4] . "|";

		$paymentdetails = mysqli_fetch_array(mysqli_query($connection, "SELECT refnumber, image FROM payments WHERE order_id = '" . $_POST['order_id'] . "';"));
		echo $paymentdetails[0] . "|";

		$image2 = "../" . $paymentdetails[1];
		echo "<div class='col-md-12 colimagesize' style='padding: 3px 0px;'>
                        <img class='card-img-top img-responsive' src='" . $image2 . "' alt='Card image cap' style='border: 1px solid #f3efea !important;cursor:pointer' onclick='viewvalidIDphoto(\"" . $image2 . "\")'>
                    </div>";
		break;
}
