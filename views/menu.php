<ul class="nav justify-content-center bg-secondary">
   
    <?foreach($params as $item):?>
        
        <li class='nav-item'>
            <a class= 'nav-link active text-light' href = '<?=$item['link']?>'><?=$item['name']?></a>
        </li>
        
    <?endforeach;?>
     
</ul>