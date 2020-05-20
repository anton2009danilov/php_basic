<?//var_dump($orders_list);?>
<?if($allow):?>
<h3>Список заказов:</h3>
<table class="table">
    <thead>
        <tr>
        <th scope="col">номер заказа</th>
        <th scope="col">имя пользователя</th>
        <th scope="col">e-mail</th>
        <th scope="col">статус заказа</th>
        <th scope="col">изменить статус</th>
        </tr>
    </thead>
    <?foreach ($orders_list as $order):?>

        <tbody>
            <tr>
                <td><?=$order['id']?></td>
                <td><?=$order['name']?></td>
                <td><?=$order['email']?></td>
                <td id='status<?=$order['id']?>'><?=$order['status']?></td>
                <td>
                    <select class="change_status" id="<?=$order['id']?>">
                        <option value=""></option>
                        <option value="new">новый</option>
                        <option value="completed">завершен</option>
                        <option value="cancelled">отменен</option>
                    </select>
                </td>
            </tr>
        </tbody>

    <?endforeach;?>

</table>

<?else:?>
    <h3>Ошибка: отказано в доступе</h3>

<?endif;?>


<script>
    
    $(document).ready(function(){
        
        $(".change_status").on('change', function(event){
            let status = event.target.value;

            let order_id = event.target.id;
            console.log(status);
            console.log(order_id);
            
            if(status){
                $.ajax(
                    {
                    url: "../change_order_status/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        status: status,
                        order_id: order_id
                    },
                    error: function() {console.log("ajax error");},
                    success: function(answer){
                        console.log(answer);
                        $('#status'+ order_id).html(answer);
                        }
                })
            }
            
        })
    })

        

</script>