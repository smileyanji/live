<?php
include_once '../inc/config.inc' ;
$result = $Channel -> channelList () ;
?>
<body>
	<h2>Channels list</h2>
	<div class="t-body">
		<table class="channel">
			<colgroup>
				<col width="10%">
				<col width="20%">
				<col width="10%">
				<col width="10%">
				<col width="10%">
				<col width="10%">
				<col width="10%">
			</colgroup>
			<thead>
				<tr>
					<th>채널명</th>
					<th>채널 ID</th>
					<th>채널상태</th>
					<th>화질 Template</th>
					<th>채널 사용 시간(누적)</th>
					<th>채널 생성 시간</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ( ! empty ( $result ) )
				{
					foreach ( $result['Channels'] as $k => $v )
					{
						echo "<tr>" ;
						echo "<td>{$v['name']}</td>" ;
						echo "<td>{$v['id']}</td>" ;
						echo "<td>{$v['state']}</td>" ;
						echo "<td>{$v['template']}</td>" ;
						echo "<td>{$v['publishing']}</td>" ;
						echo "<td>{$v['created_at']}</td>" ;
						echo "<td><a href='./ChannelDetail.php?id={$v['id']}'>Detail</a></td>" ;
						echo "</tr>" ;
					}
				}
				else
					echo "<tr><td colspan='6'><div class='well-lg text-warning text-center'> No messages </div></td></tr>" ;
				?>
			</tbody>
		</table>
	</div>
	<div class="search">
		<form method="post" action="./channelDetail.php">
			<span>Detail:</span>
			<input type="text" name="id" placeholder="Input Channel ID here!">
			<input type="submit" value="go">
		</form>
	</div>
	<div class="back">
		<a href="../index.php">back</a>
	</div>
</body>
<script src="../jquery.min.js"></script>
