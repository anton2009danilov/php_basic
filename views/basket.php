<div class='container'>
    <h3>Корзина:</h3>

    <!--    <ul class='d-flex flex-wrap justify-content-left'>-->
    <!--        --><? // $i = 1 ?>
    <!--        --><? // foreach ($basket as $item): ?>
    <!--            <li class='figure ml-3' id="--><? //= $item['item_id'] ?><!--">-->
    <!--                <h6>--><? //= $i ?><!--. --><? //= $item['item_name'] ?><!--</h6>-->
    <!--                <h6>Цена: --><? //= $item['price'] ?><!--</h6>-->
    <!--                <h6>Количество: <span id="item--><? //= $item['item_id'] ?><!--">-->
    <? //= $item['quantity'] ?><!--</span></h6>-->
    <!--                <button class="delete" id="-->
    <? //= $item['item_id'] ?><!--_deleteButton">Убрать из корзины</button>-->
    <!--                --><? // $i++ ?>
    <!--            </li>-->
    <!--        --><? // endforeach; ?>
    <!--    </ul>-->


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
                <td><?= $item['item_name'] ?></td>
                <td><?= $item['price'] ?> руб.</td>
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

    $(document).ready(function () {
        $(".item_quantity").change((event) => {
            let item_id = event.target.getAttribute('id');
            let old_quantity = +event.target.getAttribute('value');
            let new_quantity = +document.getElementById(item_id).value;
            if (new_quantity < 0) {
                new_quantity = 0;
                document.getElementById(item_id)['value'] = new_quantity;
            }

            $.ajax(
                {
                    url: "../update_basket/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: item_id,
                        quantity: new_quantity
                    },
                    error: function () {
                        console.log("update_basket: ajax error");
                    },
                    success: function (answer) {
                        console.log(answer);

                        let old_total_quantity = +document.getElementById("counter").getAttribute('data-value');
                        let new_total_quantity = old_total_quantity + new_quantity - old_quantity;
                        $('#counter').html(new_total_quantity);
                    }
                });
        });


        $(".delete").on('click', function (event) {
            let id = parseInt(event.target.id);
            let counter = $("#counter").html();

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
                            $('#counter').html(--counter);
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