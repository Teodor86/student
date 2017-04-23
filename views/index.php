<?php require_once 'top.php'; ?>
	
  <body>
  
    <p><a href="signup.php">Добавить пользователя</a></p>
    <p><a href="edit.php">Редактировать пользователя</a></p>

    <div class="search-panel">
        <form action="index.php" method="GET">
            <input type="search" name="q" placeholder="Что искать">
            <input type="submit" value="Найти">
        </form>
    </div>
	
	
<?php if(sizeof($users) > 0) : ?>
  <table>

    <tr>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=uid">Номер</a></th>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=name">Имя</a></th>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=surname">Фамилия</th>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=email">Электронная почта</a></th>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=birthday">Год рождения</a></th>
      <th><a href="<?=$_SERVER['PHP_SELF']; ?>?order=gender">Пол</a></th>
    </tr>
		
	<?php foreach($users as $user): ?>
  
    <tr>
      <td><?=htmlspecialchars($user['uid'], ENT_QUOTES); ?></td>
      <td><?=htmlspecialchars($user['name'], ENT_QUOTES); ?></td>
      <td><?=htmlspecialchars($user['surname'], ENT_QUOTES); ?></td>
      <td><?=htmlspecialchars($user['email'], ENT_QUOTES); ?></td>
      <td><?=htmlspecialchars($user['birthday'], ENT_QUOTES); ?></td>
      <td><?=htmlspecialchars($user['gender'], ENT_QUOTES); ?></td>
    </tr>
    
	<?php endforeach; ?>
  
  </table>
  
  <?php 
  	
    if($count['total'] > $perPage) :

        for($page = 1; $page <= $pager->getTotalPages(); $page++) :
          
            if($page == $cur_page) : ?>
              
              <span style="margin-left: 15px;"><?=htmlspecialchars($page, ENT_QUOTES);?></span>
              
            <?php else : ?>

              <a style="margin-left: 15px;" href="<?=$pager->getLinkForPage($page, $order);?>"><?=htmlspecialchars($page, ENT_QUOTES);?></a>
              
          <?php endif;
        
        endfor;
       
    endif;
   ?>
	
	<?php else: ?>
  
    <p>В базе данных нет пользователей.</p>
  
	<?php endif; ?>
	
<?php require_once 'footer.php'; ?>