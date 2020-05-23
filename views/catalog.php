<div class='container'>
    <h3>Каталог магазина:</h3>
    
    <ul class='d-flex flex-wrap justify-content-between'>
        <?foreach($gallery as $item):?>
            <li class='figure card'>
                <h6><?=$item['item_name']?></h6>
                <h6>Цена: <?=$item['price']?> руб.</h6>
                <a href="/card/<?=$item['id']?>"><img src="/img/small/<?=$item['name'];?>" alt="<?=$item['name'];?>"></a>
                <button class="buy" id="<?=$item['id']?>_buyButton" data-id="<?=$item['id']?>">Купить</button>
                <p class='card__description'><?=$item['description']?></p>
            </li>
        <?endforeach;?>
    </ul>
</div>


<script>

    $(document).ready(function(){
        $(".buy").on('click', function(event){
            let counter = $("#counter").html();
            console.log(`counter: ${counter}`);
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

                    $("#counter").html(++counter);

                }
            })
        })
    }
)

</script>