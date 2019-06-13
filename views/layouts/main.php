<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?=$title?></title>
</head>
<body>

<ul class="nav justify-content-center bg-secondary">
  <li class="nav-item">
    <a class="nav-link active text-light" href="/">Главная</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=catalog">Каталог</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex1">Задание 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex2">Задание 2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex3">Задание 3</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex4">Задание 4</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex5">Задание 5</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex6">Задание 6</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex7">Задание 7</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex8">Задание 8</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=ex9">Задание 9</a>
  </li>
</ul>

<div class="container">
    <?=$content?>
</div>

</body>
</html>