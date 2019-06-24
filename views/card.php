<div class='d-flex'>
    <div>
        <img width='500px' src="/img/big/<?=$card['name']?>" alt="Товар <?=$card['id']?>">
    </div>
    <div class='d-flex flex-column description'>
        <h3><?=$card['item_name']?></h3>
        <h4>Цена: <?=$card['price']?> руб.</h4>
        <h4 class='description__text'><?=$card['description']?></h4>
        <h5>Количество просмотров: <?=$card['views']?></h5>
        <h5>Понравилось: <span id = "like"><?=$card['likes']?></span></h5>
        <button class="action" id="likeButton" data-id="<?=$card['id']?>">Понравилось</button>
    </div>

</div>
<h4>Отзывы:</h4>
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


<script>

    $(document).ready(function(){
        $(".action").on('click', function(){
            let id = $("#likeButton").attr("data-id");
           
            console.log(id);
            
            $.ajax(
                
                {
                url: "../addlike/" + id,
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    $('#like').html(answer.result);
                }
            })
        })
    }
)

</script>