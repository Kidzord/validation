
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание</title>
    <style>
        span {
            color: red;
        }
    </style>
</head>
<body>

<?php
// определим переменные для формы
$nameErr = $numberErr = $emailErr = $timeErr = "";
$name = $number = $email = $time = "";
// обрабатываем данные при отправке формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Проверяем ввод в поле "имя" 
 if (empty($_POST["name"])) {
    $nameErr = "Введите имя";
  } else {
    $name = test_input($_POST["name"]);
    // Валидация на вводимые символы
    if (!preg_match("/^[a-zA-Zа-яА-Я'][a-zA-Zа-яА-Я-' ]+[a-zA-Zа-яА-Я']?$/u",$name)) {
      $nameErr = "Допускаются только буквы"; 
    }
  }
// Аналогично проверяем ввод в поле "номер телефона"
if (empty($_POST["number"])) {
    $numberErr = "Введите номер телефона";
  } else {
    $number = test_input($_POST["number"]);
    // Валидация на вводимые символы 
    if (!preg_match('/^((8|\+)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{3,12}$/',$number)) {
      $numberErr = "Допускаются только  «+», «-» и цифры"; 
    }
  }
  //Проверяем ввод в поле "Email"
  if (empty($_POST["email"])) {
    $emailErr = "Введите Email";
  } else {
    $email = test_input($_POST["email"]);
    // Валидация Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Неверный формат Email"; 
    }
  }
  //Проверяем ввод в поле "количество циклов"
  if (empty($_POST["time"]) || empty($_POST["email"]) || empty($_POST["number"]) || empty($_POST["name"])) {
    $timeErr = "Введите количество циклов и заполните другие поля";
  } else {
    //расчет кол-ва бактерий
    $red = 1; //зададим начальные значения
    $green = 1;
    $amount = $_POST["time"]; 
    for ($i = 1; $i <= $amount; $i++) {  // алгоритм решения задачи
    $amountGreen = $green * 3 + $red * 7;
    $amountRed = $green * 4 + $red * 5;
    $red = $amountRed; //задаем новые переменные, так как для подстановки в расчет красных бактерий будет идти уже новое значение зеленых
    $green = $amountGreen;
}
    $change = ($amount*($red+$green)); //считаем итоговое количество бактерий
  }

}
// очищаем вводимые данные
function test_input($data) { 
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>Задача</h1>
    <p>Есть два вида бактерий. Одни - зеленые. Вторые - красные. Каждый такт времени зеленая бактерия превращается в 3 зеленые и 4 красные. Каждая красная бактерия превращается в 7 зеленых и 5 красных. </p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 <div>
    <p>Имя:</p> <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error"><?php echo $nameErr;?></span>
 </div>
<div>
    <p>Номер телефона:</p> <input type="text" name="number" value="<?php echo $number;?>">
    <span class="error"><?php echo $numberErr;?></span>
</div>
<div>
    <p>Email:</p> <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error"><?php echo $emailErr;?></span>
</div>
<div>
    <p>Количество циклов:</p> <input type="text" name="time" value="<?php echo $time;?>">
    <span class="error"><?php echo $timeErr;?></span>
</div>

<div>
    <br>
    <input type="submit" name="submit" value="Получить количество бактерий">  
</div>
</form>

<?php
echo "<p>Вывод формы</p>";
echo $change;
echo "<br>";
?>

</body>
</html>



