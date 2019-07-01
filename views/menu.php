<ul class="nav justify-content-center bg-secondary">
    <?foreach($params as $item):?>
        
        <li class='nav-item'>
            <a class= 'nav-link active text-light' href = '<?=$item['link']?>'>
                <?=$item['name']?>
                <?if($item['cart']):?>
                    <?if(!$_SESSION['user']):?>
                        [ <span id="counter"><?=getTotalQuantity(($_SESSION['id']))?></span> ]
                    <?else:?>
                        [ <span id="counter"><?=getTotalQuantity()?></span> ]
                    <?endif;?>
                <?endif;?>
            </a>
        </li>
        
            
    <?endforeach;?>
     
</ul>
