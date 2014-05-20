<!DOCTYPE html>
<html>
<head>
<title>投稿編集</title>
</head>
<body>
<h2>投稿編集</h2>
{if $action == 'edit'}
<!--form-->
<p>
	<form name="edit_contribute" action="./edit.php" method="post">
		<table>
			<tr>
				<th>投稿者:</th>
				<td><input type="text" name="contributor" size="20" value="{$list.contributor}"></td>
			</tr>
			<tr>
				<th>タイトル:</th>
				<td><input type="text" name="contribute_title" size="50" value="{$list.contribute_title}"></td>
			</tr>
			<tr>
				<th>本文:</th>
				<td><textarea name="contribute_text" rows="10" cols="50">{$list.contribute_text}</textarea></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="contribute_id" value="{$list.contribute_id}">
					<input type="hidden" name="action" value="edit_end">
					<input type="submit" value="編集">
				</td>
			</tr>
		</table>
		<p>
			<font color="red">{$error}</font>
		</p>
	</form>
</p>
{/if}
{if $action == 'edit_end'}
<p>
	編集完了しました。
	<table>
		<tr>
			<th>投稿者:</th>
			<td>{$list.contributor}</td>
		</tr>
		<tr>
			<th>タイトル:</th>
			<td>{$list.contribute_title}</td>
		</tr>
		<tr>
			<th>本文:</th>
			<td>{$list.contribute_text}</textarea></td>
		</tr>
		<tr>
			<td colspan="2">
			</td>
		</tr>
	</table>
	<p>
		<a href='http://54.199.190.207/bbs/index.php'>TOPへ</a>
	</p>
</p>
{/if}
</body>
</html>