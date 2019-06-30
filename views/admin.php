
<?foreach ($users_list as $user):?>
    <?$i = 1;?>
    <?$id = $user['id']?>
    <?$basket = getBasket($id);?>

    <h4>Корзина товаров пользователя "<?=$user['login']?>"</h4>

    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование товара</th>
            <th scope="col">Количество</th>
            <th scope="col">Цена за единицу товара</th>
            </tr>
        </thead>


        <?foreach ($basket as $item):?>
                <tbody>
                    <tr>
                        <th scope="row"><?=$i++?></th>
                        <td><?=$item['item_name']?></td>
                        <td><?=$item['quantity']?></td>
                        <td><?=$item['price']?> рублей</td>
                    </tr>
                </tbody>
        <?endforeach;?>

    

        
    </table>






<?endforeach;?>

