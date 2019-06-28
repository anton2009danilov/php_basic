<div class='container'>
    <h3>Корзина:</h3>
    
    <ul class='d-flex flex-wrap justify-content-between'>
        <?$i=1?>
        <?foreach($basket as $item):?>
            <li class='figure'>
                <h6><?=$i?>. <?=$item['item_name']?></h6>
                <h6>Цена: <?=$item['price']?></h6>
                <h6>Количество: <?=$item['quantity']?></h6>
                <!--
                <h6>Цена: <?=$item['price']?> руб.</h6>
                <a href="/card/<?=$item['id']?>" target="_blank"><img src="/img/small/<?=$item['name'];?>" alt="<?=$item['name'];?>"></a>
                <button class="buy" id="<?=$item['id']?>_buyButton" data-id="<?=$item['id']?>">Купить</button>
                <p class='card__description'><?=$item['description']?></p>
                -->
                <?$i++?>
            </li>
        <?endforeach;?>
    </ul>
</div>