<!DOCTYPE html>
<html>
<head>
<title>掲示板TOP</title>
</head>
<body>
<h2>BBS</h2>
<!--form-->
<p>
	<form name="contribute" action="./index.php" method="post">
		<table>
			<tr>
				<th>投稿者:</th>
				<td><input type="text" name="contributor" size="20"></td>
			</tr>
			<tr>
				<th>タイトル:</th>
				<td><input type="text" name="contribute_title" size="50"></td>
			</tr>
			<tr>
				<th>本文:</th>
				<td><textarea name="contribute_text" rows="10" cols="50"></textarea></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="action" value="register">
					<input type="submit" value="投稿">
				</td>
			</tr>
		</table>
		<p>
			<font color="red">{$error}</font>
		</p>
	</form>
</p>

<!--contribute list-->
<p>
	<table>
		{foreach name=list from=$list item=item}
			<tr>
				<td>記事No.:</td>
				<td><a href="./edit.php?contribute_id={$item.contribute_id}&action=edit" target="_blank">{$item.contribute_id}</a></td>
			</tr>
			<tr>
				<td>投稿者:</td>
				<td>{$item.contributor}</td>
			</tr>
			<tr>
				<td>タイトル:</td>
				<td>{$item.contribute_title}</td>
			</tr>
			<tr>
				<td colspan="2">{$item.contribute_text}</td>
			</tr>
			<tr>
				<td>{$item.contribute_time}</td>
				<td>
					<form name="delete" action="./index.php" method="post">
						<input type="hidden" name="action" value="delete">
						<input type="hidden" name="contribute_id" value="{$item.contribute_id}">
						<input type="submit" value="削除">
					</form>
				</td>
			</tr>
			<tr></tr>
		{/foreach}
	</table>
</p>
</body>
</html>