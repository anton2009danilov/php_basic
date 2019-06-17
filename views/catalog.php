<div class='container'>
    <h3>Каталог магазина:</h3>
    <ul class='list-group d-flex justify-content-between'>
        <?foreach($catalog as $item):?>
            <li class='list-group-item'><?=$item;?></li>
        <?endforeach;?>
    </ul>

</div>