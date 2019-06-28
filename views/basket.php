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


<script>

    $(document).ready(function(){
        $(".delete").on('click', function(event){
            // alert(event.target.id);
            // let id = $("#buyButton").attr("data-id");
            let id = parseInt(event.target.id);
            
            console.log(id);
            
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
                    if(answer['error']) {
                        alert(answer['error']);
                    }
                    if(!answer['result']) {
                        $('#' + id).remove();
                    } else {
                        $('#item' + id).html(answer.result);
                    }
                }
            })
        })
    }
)

</script>