<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electricity Bill Calculator</title>
		<style>
			body{
			background-image:url('https://img.freepik.com/free-vector/network-mesh-wire-digital-technology-background_1017-27428.jpg?w=740&t=st=1668063826~exp=1668064426~hmac=35c68ca2427fbf5d97a1fe43665a3e6dc869c447453fa2f6f90e74a064e9f3a5');
			background-size:cover;
			}
		
		</style>


		<!-- Bootstrap CSS -->
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- jQuery -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>

	<div class="container">
		<h1>Electricity Bill Calculator</h1>
		<form action="" method="POST" role="form">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="">Total Unit / Kwh</label>
					<input type="text" class="form-control" name="unit" placeholder="Input total Unit">
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group">
					<label for="">Fixed Meter Charge</label>
					<select class="form-control" name="meter">
						<option value="100">Fixed Meter Charge for 1-4 KWH Connection 100 RS</option>
						<option value="220">Fixed Meter Charge for 4-10 KWH Connection 220 RS</option>
					</select>
				</div>
			</div>
			
			<div class="col-lg-6">
				<button type="submit" class="btn btn-primary">Calculate</button>
			</div>
		</div>
		</form>

		<hr>
		<?php
		if(isset($_POST['unit']))
		{
			$total = 0;
			$unit = (int) $_POST['unit'];

			function calculate($unit,$range,$price)
			{
				$xunit = $range[1]-$range[0]+1;
				if($unit<=$xunit && $unit>0)
				{
					$bill = $unit  * $price;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>$unit</td>
							<td>$bill RS</td>
						</tr>
						";
					return array($unit-$xunit, $bill);
				}
				elseif($unit>$xunit)
				{
					$bill = $xunit * $price;
					$newUnit = $unit - $xunit;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>".$xunit."</td>
							<td>$bill RS</td>
						</tr>
						";
					return array($newUnit, $bill);
				}
			}

			echo "<h3>Bill for $unit Unit</h3>";

			echo "<table class=\"table table-hover\">
			<thead>
				<tr>
					<th>Range</th>
					<th>Price/Unit</th>
					<th>Unit</th>
					<th>Bill</th>
				</tr>
			</thead>
			<tbody>
				
			";

			$newUnit = 0;
			if($unit>0)
			{
				$rep = calculate($unit,array(1,75),3.53);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(76,200),5.01);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(201,300),5.19);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(301,400),5.42);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(401,600),8.51);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(601,1000000),9.93);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			$meter = $_POST['meter'];
			$newTotal = $total + $meter;
			$vat = ($newTotal * 5)/100;
			$gTotal = $newTotal + $vat;
			echo "
				
			</tbody>

			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th>Bill</th>
					<th>$total RS</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Fixed Meter Charge</th>
					<th>$meter RS</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Total</th>
					<th>$newTotal RS</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Vat</th>
					<th>$vat RS</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Grand Total</th>
					<th>$gTotal RS</th>
				</tr>

			</tfoot>
		</table>";
		}
		?>
	

	<footer>
		&copy; <?php echo date('Y'); ?> Manan Gaur</a>
	</footer>
	</div>	
	</body>
</html>
