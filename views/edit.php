<?php require_once 'top.php'; ?>
	
	<body>
	
	<p><a href="signup.php">Добавить пользователя</a></p>
	<p><a href="index.php">Список пользователей</a></p>
	
	<p class='success'>
		<?php
            if(isset($_SESSION['success'])) {    
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            }
		?>
	</p>	

	<div class="signup">
	
		<?php if(!empty(Authorization::getCookie()) && (Authorization::getCookie() === $users['code']) ) : ?>
		
		<h1>Редактирование пользовательских данных</h1>
		
			<ul>
			<?php if(!empty($errors)) : ?>
			<?php foreach($errors as $error) : ?>
			<li><?=$error;?></li>
			<?php endforeach; ?>
			<?php endif; ?>
			</ul>
			
		<form action="edit.php" method="post">

			<label><input type="text" class="form" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($users['name'], ENT_QUOTES); ?>"></label>

			<label><input type="text" class="form" name="surname" placeholder="Enter your surname" value="<?php echo htmlspecialchars($users['surname'], ENT_QUOTES); ?>"></label>
			
			<label><input type="email" class="form" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($users['email'], ENT_QUOTES); ?>"></label>
			
			<label>	
				<select name="birthday">
					<?php echo FormHelper::buildOptions(FormHelper::years(), $users['birthday']);?>
				</select>
			</label>

			<label>
				<select name="gender">
					<option value="M" <?=($users['gender'] == 'M') ? 'selected' : null; ?>>Мужчина</option>
					<option value="W" <?=($users['gender'] == 'W') ? 'selected' : null; ?>>Женщина</option>
				</select>
			</label>
			
			<input type="hidden" name="userid" value="<?=$users['uid']; ?>">
			
			<input type="submit" value="Изменить">

		</form>
	</div>

<?php else : ?>
<p>У вас нет прав посмотреть на эту страницу.</p>
<?php endif; ?>

<?php require_once 'footer.php'; ?>