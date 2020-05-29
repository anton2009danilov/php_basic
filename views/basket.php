<div class='container'>
    <h3>Корзина:</h3>

    <? if ($basket->num_rows === 0) { ?>
        <h4>В корзине нет товаров</h4>
    <? } else { ?>
        <table class="table">
            <thead>
            <tr>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Количество</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <? foreach ($basket as $item): ?>
                <tr id="<?= $item['item_id'] ?>">
                    <td><a href="../card/<?=$item['item_id']?>"><?= $item['item_name'] ?></a></td>
                    <td><span class="price"><?= $item['price'] ?></span> руб.</td>
                    <td><input id="item<?= $item['item_id'] ?>" class="item_quantity" type="number"
                               value="<?= $item['quantity'] ?>" min="1" max="100"
                               step="1">
                    </td>
                    <td>
                        <button class="delete" id="<?= $item['item_id'] ?>_deleteButton">Убрать из корзины</button>
                    </td>

                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
        <h4>Итого: <span id="total_price"></span> руб.</h4>
    <? } ?>


</div>

<hr>
<h3>Оформить заказ:</h3>

<form method="post" action="/order">
    <input type="text" id="user_name" name="user_name" placeholder="Введите ФИО" required>
    <br><br>
    <input type="email" id="email" name="email" placeholder="Введите email" required>
    <br><br>

    <input class="order" id="<?= $id ?>" type="submit" name="ok" value="Оформить заказ">
</form>
<p id="answer"></p>

<script>

    function showTotalPrice() {
        let $total_price;
        // let prices_objs = $('.price');
        let calculation_data = {};
        let prices_objs = document.getElementsByClassName('price');
        let prices_arr = [];

        for (let i = 0; i < prices_objs.length; i++) {
            prices_arr.push(+prices_objs[i].textContent);
        }

        let items_quantity_objs = document.getElementsByClassName('item_quantity');
        let items_quantities_arr = [];

        for (let i = 0; i < items_quantity_objs.length; i++) {
            items_quantities_arr.push(+items_quantity_objs[i].value);
        }

        calculation_data.prices = prices_arr;
        calculation_data.quantities = items_quantities_arr;

        let result = 0;

        for (let i = 0; i < calculation_data.prices.length; i++) {
            result += calculation_data.prices[i] * calculation_data.quantities[i];
        }

        $('#total_price').html(result);
    }

    showTotalPrice();

    $(document).ready(function () {

        $(".item_quantity").change((event) => {
            let item_id = event.target.getAttribute('id');
            let item_id_num = item_id.match(/\d+/)[0];
            // console.log(item_id, item_id_num);
            let old_quantity = +event.target.getAttribute('value');
            let new_quantity = +document.getElementById(item_id).value;
            if (new_quantity < 1) {
                new_quantity = 1;
                document.getElementById(item_id)['value'] = new_quantity;
            } else if (new_quantity > 100) {
                new_quantity = 100;
                document.getElementById(item_id)['value'] = new_quantity;
            }

            $.ajax(
                {
                    url: "../update_basket/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: item_id_num,
                        quantity: new_quantity
                    },
                    error: function () {
                        console.log("update_basket: ajax error");
                    },
                    success: function (answer) {
                        let old_total_quantity = +document.getElementById("counter").getAttribute('data-value');
                        let new_total_quantity = old_total_quantity + new_quantity - old_quantity;
                        $('#counter').html(new_total_quantity);
                        showTotalPrice();
                    }
                });
        });


        $(".delete").on('click', function (event) {
            let id = parseInt(event.target.id);
            let counter = $("#counter").html();
            let id_name = "item" + id;
            let item_quantity = +document.getElementById(id_name).getAttribute('value');

            $.ajax(
                {
                    url: "../delete_from_basket/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    error: function () {
                        console.log("ajax error");
                    },
                    success: function (answer) {
                        console.log(answer);


                        // console.log(answer['item_quantity']);
                        if (answer['error']) {
                            alert(answer['error']);
                        } else {

                            if (!answer['item_quantity']) {
                                $('#' + id).remove();
                            } else {
                                $('#item' + id).html(answer['item_quantity']);
                            }
                            $('#counter').html(counter - item_quantity);
                        }
                    }
                })
        });

        $(".order").on('click', function (event) {
            event.preventDefault();
            let id = parseInt(event.target.id);
            console.log(id);
            console.log($('#user_name').val());

            $.ajax(
                {
                    url: "../order/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id,
                        name: $('#user_name').val(),
                        email: $('#email').val(),
                    },
                    error: function () {
                        console.log("ajax error");
                    },
                    success: function (answer) {
                        console.log(answer);
                        // console.log(answer['item_quantity']);
                        if (answer['error']) {
                            alert(answer['error']);
                        } else {
                            $('#answer').html(`Заказ оформлен. Спасибо за покупку!`);
                        }
                    }
                })
        })
    })

</script>