<h3>Карточка товара <?=$card['id']?></h3>
<img width='500px' src="/img/big/<?=$card['name']?>" alt="Товар <?=$card['id']?>">
<h5>Количество просмотров: <?=$card['views']?></h5>
<h5>Понравилось: <span id = "like"><?=$card['likes']?></span></h5>
<button class="action" id="likeButton" data-id="<?=$card['id']?>">Понравилось</button>

<?foreach($feedback as $item):?>
    <div class="border border-success">
        <h5><?=$item['name']?>:</h5>
        <p><?=$item['feedback']?></p>
        <a href="/deletefeedback/<?=$card['id']?>/<?=$item['id']?>">Удалить отзыв</a>
        <a href="/card/<?=$card['id']?>/EDIT/<?=$item['id']?>">Редактировать отзыв</a>
    </div>
    
<?endforeach;?>

<p><?=$message?></p>

<form method="post" action="/<?=$action?>">
    <input type="text" name="name" placeholder="Имя" value="<?=$row['name']?>">
    <br>
    <!-- <input type="textarea" name="feedback"> -->
    <textarea name="feedback" cols="40" rows="3" placeholder="Отзыв"><?=$row['feedback']?></textarea>
    <br>
    <input type="submit" name="ok" value="<?=$btn_text?>">
</form>
