<div class='container'>
    <h3>Каталог магазина:</h3>
    <ul class='d-flex flex-wrap justify-content-between'>
        <?foreach($gallery as $item):?>
            <li class='figure'>
                <a href="/?page=card&id=<?=$item['id']?>" target="_blank"><img src="/img/small/<?=$item['name'];?>" alt="<?=$item['name'];?>"></a>
                <!-- <a href="/img/big/<?=$item?>" target="_blank"><img src="/img/small/<?=$item;?>" alt="<?=$item;?>"></a> -->
            </li>
        <?endforeach;?>
    </ul>

    <form method="post" enctype="multipart/form-data">
        <!-- <label for="new_img">Выберите файл</label> -->
        <input id="new_img" class="upload" type="file" name="new_img">
        <input class="upload_btn" type="submit" name="load" value="Загрузить">
    </form>

</div>