<div class='container'>
    <h3>Каталог магазина:</h3>
    
    <ul class='d-flex flex-wrap justify-content-between'>
        <?foreach($gallery as $item):?>
            <li class='figure card'>
                <h6><?=$item['item_name']?></h6>
                <h6>Цена: <?=$item['price']?> руб.</h6>
                <a href="/card/<?=$item['id']?>" target="_blank"><img src="/img/small/<?=$item['name'];?>" alt="<?=$item['name'];?>"></a>
                <button class="buy" id="<?=$item['id']?>_buyButton" data-id="<?=$item['id']?>">Купить</button>
                <p class='card__description'><?=$item['description']?></p>
            </li>
        <?endforeach;?>
    </ul>
        <?if($user='admin'&&$allow):?>
            <form method="post" enctype="multipart/form-data">
                <!-- <label for="new_img">Выберите файл</label> -->
                <input id="new_img" class="upload" type="file" name="new_img">
                <input class="upload_btn" type="submit" name="load" value="Загрузить">
            </form>
        <?endif;?>
</div>


<script>

    $(document).ready(function(){
        $(".buy").on('click', function(event){
            
            let id = parseInt(event.target.id);
            console.log(id);
            
            $.ajax(
                
                {
                url: "../add_to_basket/" + id,
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    console.log(answer);
                    if(answer['error']) {
                        alert(answer['error']);
                    }

                    $("#counter").html(`[ ${parseInt(answer['result'])} ]`);

                }
            })
        })
    }
)

</script>