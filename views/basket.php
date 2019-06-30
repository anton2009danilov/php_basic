<div class='container'>
    <h3>Корзина:</h3>
    
    <ul class='d-flex flex-wrap justify-content-between'>
        <?$i=1?>
        <?foreach($basket as $item):?>
            <li class='figure' id="<?=$item['item_id']?>">
                <h6><?=$i?>. <?=$item['item_name']?></h6>
                <h6>Цена: <?=$item['price']?></h6>
                <h6>Количество: <span id="item<?=$item['item_id']?>"><?=$item['quantity']?></span></h6>
                <button class="delete" id="<?=$item['item_id']?>_deleteButton">Убрать из корзины</button>
                <?$i++?>
            </li>
        <?endforeach;?>
    </ul>
</div>

<hr>
<h3>Оформить заказ:</h3>

<!-- <form method="post" action="/order"> -->
<form method="post" action="/order">
    <input type="text" name="user_name" placeholder="Введите ФИО" value="<?=$row['name']?>" required>
    <br><br>
    <input type="email" name="email" placeholder="Введите email" value="<?=$row['name']?>" required>
    <br><br>
    
    <input class="order" id="<?=$id?>" type="submit" name="ok" value="Оформить заказ">
</form>
<!--
<button class="order" id="<?=$id?>">Оформить заказ</button> 
</form>
-->


<script>

    $(document).ready(function(){
        $(".delete").on('click', function(event){
            let id = parseInt(event.target.id);
            
            $.ajax(
                {
                url: "../delete_from_basket/" + id,
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    console.log(answer);
                    // console.log(answer['item_quantity']);
                    if(answer['error']) {
                        alert(answer['error']);
                    } else {
                        if(!answer['item_quantity']) {
                            $('#' + id).remove();
                        } 
                        else {
                            $('#item' + id).html(answer['item_quantity']);
                        }
                        $('#counter').html(`[ ${answer['total_quantity']} ]`);
                    }
                }
            })
        })

        $(".order").on('click', function(event) {
            event.preventDefault();
            let id = parseInt(event.target.id);
            console.log(id);
            
            $.ajax(
                {
                url: "../order/",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    console.log(answer);
                    // console.log(answer['item_quantity']);
                    if(answer['error']) {
                        alert(answer['error']);
                    } else {
                        if(!answer['item_quantity']) {
                            $('#' + id).remove();
                        } 
                        else {
                            $('#item' + id).html(answer['item_quantity']);
                        }
                        $('#counter').html(`[ ${answer['total_quantity']} ]`);
                    }
                }
            })
        })
    })

</script>