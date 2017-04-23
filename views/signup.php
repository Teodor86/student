<?php require_once  'top.php'; ?>
	
	<body>

	<p><a href="index.php">Список пользователей</a></p>
	<p><a href="edit.php">Редактировать пользователя</a></p>
	
		<?php if( !Authorization::getCookie() ) : ?>
		
		<div class="signup">
			<h1>Регистрация пользователя:</h1>
			
			<ul>
			<?php if(!empty($errors)) : ?>
			<?php foreach($errors as $error) : ?>
			<li><?=$error;?></li>
			<?php endforeach; ?>
			<?php endif; ?>
			</ul>
			
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			
				<label><input type="text" class="form" name="name" placeholder="Имя" value="<?php if(isset($user)) echo htmlspecialchars($user->getName(), ENT_QUOTES); ?>"></label>
				
				<label><input type="text" class="form" name="surname" placeholder="Фамилия" value="<?php if(isset($user)) echo htmlspecialchars($user->getSurname(), ENT_QUOTES); ?>"></label>
				
				<label><input type="email" class="form" name="email" placeholder="Электоронная почта" value="<?php if(isset($user)) echo htmlspecialchars($user->getEmail(), ENT_QUOTES); ?>"></label>
				
				<label>
					<select name="birthday">
						<?php
						
							$birthday = (isset($user)) ? $user->getBirthday() : null;
							
							echo FormHelper::buildOptions(FormHelper::years(), $birthday );
						?>
					</select>
				</label>
				
				<label>
						<select name="gender">
							<option value="0">Выберите пол</option>
							
							<option value="M" <?php 
								if(isset($user)) {
									echo ($user->getGender() == 'M') ? 'selected' : null;
								} ?>>Мужчина</option>
								
							<option value="W" <?php
							if(isset($user)) {
								echo ($user->getGender() == 'W') ? 'selected' : null;
								} ?>>Женщина</option>
						</select>
				</label>				
				
				<label><input type="submit" value="Добавить"></label>

			</form>
		</div>

<?php else: ?>
<p>Спасибо, данные сохранены, вы можете их <a href="edit.php">отредактировать</a> или просмотреть <a href="index.php">список пользователей.</a></p>
<?php endif; ?>

<?php require_once 'footer.php'; ?>