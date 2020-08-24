<?php
include_once '../inc/config.inc' ;
if ( ! isset ( $_GET['id'] ) )
	$id = $_POST['id'] ;
else
	$id = $_GET['id'] ;
$result = $Channel -> channelDetail ( $id ) ;
?>
<body>
	<h2>Channels detail</h2>
	<div>
		<table class="mailTable">
			<?php
			if ( ! empty ( $result['Channel'] ) )
			{
				?>
				<tr>
					<th colspan="2">채널명</th>
					<td><?= $result['Channel']['name'] ?></td>
				</tr>
				<tr>
					<th colspan="2">채널 ID</th>
					<td><?= $id ?></td>
				</tr>
				<tr>
					<th colspan="2">사용시간</th>
					<td><?= $result['Channel']['publishing'] ?></td>
				</tr>
				<tr>
					<th colspan="2">녹화 설정</th>
					<td><?= $result['Channel']['record'] ?></td>
				</tr>
				<tr>
					<th colspan="2">Thumbnail</th>
					<td><?= $result['Channel']['thumnail'] ?></td>
				</tr>
				<tr>
					<th colspan="2">Rtmp</th>
					<td><?= $result['Channel']['rtmp'] ?></td>
				</tr>
				<tr>
					<th colspan="2">Stream Key</th>
					<td><?= $result['Channel']['key'] ?></td>
				</tr>
				<?php
				foreach ( $result['Channel']['urls'] as $k => $v )
				{
					$count = count ( $result['Channel']['urls'] ) ;
					if ( $v['type'] == 'ABR' )
						echo "<tr><th class='column' rowspan='{$count}' width='40'>Play Url</th>" ;
					echo "<th width='60'>{$v['type']}</th>" ;
					echo"<td >{$v['url']}</td></tr>" ;
				}
				?>
				<tr>
					<th colspan="2">생성일시</th>
					<td><?= $result['Channel']['created_at'] ?></td>
				</tr>
				<?php
			}
			else
				echo "<tr><td colspan='6'><div class='well-lg text-warning text-center'> No messages </div></td></tr>" ;
			?>
		</table>
	</div>
	<div class="back">
		<a href="./channelList.php">back</a>
	</div>
</body>
<script src="../jquery.min.js"></script>
