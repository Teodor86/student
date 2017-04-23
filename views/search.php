<?php require_once  'top.php'; ?>
	
	<body>
	
	<p><a href="signup.php">Добавить пользователя</a></p>
	<p><a href="index.php">Список пользователей</a></p>
	
	<div class="search-panel">
		<form action="" method="GET">
			<input type="search" name="q" placeholder="Что искать" value="<?=htmlspecialchars($search, ENT_QUOTES);?>">
			<input type="submit" value="Найти">
		</form>
	</div>
	
	<?php if( sizeof($searchResult) > 0) : ?>
	<table>
		<tr>
			<th>Номер:</a></th>
			<th>Имя:</a></th>
			<th>Фамилия:</th>
			<th>Электронная почта:</a></th>
			<th>Город:</a></th>
			<th>Возраст:</a></th>
		</tr>
		
	<?php foreach($searchResult as $searchStr): ?>
		<tr>
			<td><?=htmlspecialchars($searchStr['uid'], ENT_QUOTES); ?></td>
			<td><?=htmlspecialchars($searchStr['name'], ENT_QUOTES); ?></td>
			<td><?=htmlspecialchars($searchStr['surname'], ENT_QUOTES); ?></td>
			<td><?=htmlspecialchars($searchStr['email'], ENT_QUOTES); ?></td>
			<td><?=htmlspecialchars($searchStr['birthday'], ENT_QUOTES); ?></td>
			<td><?=htmlspecialchars($searchStr['gender'], ENT_QUOTES); ?></td>
		</tr>	
	<?php endforeach; ?>
	
	</table>
	
	<?php else: ?>
	<p>Ничего не найдено.</p>
	<?php endif; ?>
	
<?php require_once 'footer.php'; ?>