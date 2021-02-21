<!DOCTYPE html>
	<html lang="ru">
	<head>
  		<title>TableReader</title>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	</head>
	<body>
  <?php
    $host = 'localhost';
    $user = 'mestnikova';
    $pass = 'ZnjUe6Lx';
    $db_name = 'mestnikova';
    $link = mysqli_connect($host, $user, $pass, $db_name);

    echo "<meta charset=\"utf8\">";
    header('Content-Type: text/html; charset = utf-8');

    mysqli_query($link, 'SET NAMES utf8');



    if (!$link) {
      echo 'Can not connect with DB. : code of mistake' . mysqli_connect_errno() . ', mistake: ' . mysqli_connect_error();
      exit;
    }


    if (isset($_POST["name"])) {

      if (isset($_GET['red'])) {
        $sql = mysqli_query($link, "UPDATE `Table` SET `name` = '{$_POST['name']}',`surname` = '{$_POST['surname']}',`age` = '{$_POST['age']}' WHERE `id`={$_GET['red']}");
      } else {

        $sql = mysqli_query($link, "INSERT INTO `Table` (`name`, `surname`,`age` ) VALUES ('{$_POST['name']}', '{$_POST['surname']}','{$_POST['age']}')");
      }


      if ($sql) {
        echo '<p>Успешно!</p>';
      } else {
        echo '<p> Ошибка: ' . mysqli_error($link) . '</p>';
      }
    }


    if (isset($_GET['del'])) {
      $sql = mysqli_query($link, "DELETE FROM `Table` WHERE `id` = {$_GET['del']}");
      if ($sql) {
        echo "<p>Не существует</p>";
      } else {
        echo '<p>Ошибка: ' . mysqli_error($link) . '</p>';
      }
    }


    if (isset($_GET['red'])) {
      $sql = mysqli_query($link, "SELECT `id`, `name`, `surname`, `age` FROM `Table` WHERE `id`={$_GET['red']}");
      $product = mysqli_fetch_array($sql);
    }

  ?>


  <?php
  //Получаем данные
  $sql = mysqli_query($link, 'SELECT `id`, `name`, `surname`,`age` FROM `Table`');
  echo '<h1 class="display-4 text-center mt-5 mb-5">Данные</h1>';
  echo '<div class="container"> <table class="table table-bordered">
	<tr>
	<th>Имя</th>
	<th>Фамилия</th>
	<th>Возраст</th>
	<th></th>
	<th></th>
	</tr>';
    while($result = mysqli_fetch_array($sql))
    {
      echo "
		 <tr>
     <td> {$result['name']} </td>
		 <td> {$result['surname']}</td>
		 <td> {$result['age']} </td>
     <td> <a href='?del={$result['id']}'> Удалить </a></td>
     <td> <a href='?red={$result['id']}'> Редактировать</a> </td>";
    }
    echo "</table></div>";

    echo "<p></p> <p class='display-4 text-center mt-5 mb-5'>Добавить новую запись</p>";
  ?>

  <p></p>
  <form action="" method="post">
	 <div class="container">
    <table class="table table-borderless">
      <tr>
        <td>Имя:</td>
        <td><input type="text" name="name" value="<?= isset($_GET['red']) ? $product['name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Фамилия:</td>
        <td><input type="text" name="surname" value="<?= isset($_GET['red']) ? $product['surname'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Возраст:</td>
        <td><input type="text" name="age" value="<?= isset($_GET['red']) ? $product['age'] : ''; ?>"></td>
      </tr>
      <tr>
        <td colspan="5"><input type="submit" value="Добавить" class="btn btn-dark"></td>
      </tr>
    </table>
		</div>
  </form>
  <p class='display-4 text-center mt-5 mb-5'><a href="?add=new">Обновить</a></p>
</body>
</html>
