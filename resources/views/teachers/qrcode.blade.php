<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{ $page_title }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<meta name='robots' content='noindex,nofollow'/>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.2 -->
	<style type="text/css">
		@page { size: auto; margin: 15mm 0 54mm 50; } body { margin:0; padding:0;}
		.container{
			float: left;
			margin: 10px;
		}

		tr,td{
			color: #333;
			font-size: 10px;
			font-family: tahoma;
			border: 1px solid #333;
			padding-left: 10px;
			padding: 2px 2px;
		}
	</style>
</head>
<body>
	<?php
	$num = 0;
	?>
	@foreach($data as $key => $row)
	<?php
	$num += 1;
	?>
	<div class="container">
		<table style="border-collapse: collapse; width: 200px;height: 210px;">
			<tr>
				<td align="center">
					<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate(strval($row->id))) !!} ">
					<hr>
					<b>
						{{ $row->name }}<br>
					</b>
				</td>
			</tr>
		</table>
	</div>
	@if($num%12 == 0)
	<div style="page-break-after: always;"></div>
	@endif
	@endforeach
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>