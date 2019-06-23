
<h3>Карточка товара <?=$card['id']?></h3>
<img width='500px' src="/img/big/<?=$card['name']?>" alt="Товар <?=$card['id']?>">
<h5>Количество просмотров: <?=$card['views']?></h5>
<h5>Понравилось: <span id = "like"><?=$card['likes']?></span></h5>
<button class="action" id="likeButton" data-id="<?=$card['id']?>">Понравилось</button>

