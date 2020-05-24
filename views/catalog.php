<div class='container'>
    <h3>Каталог магазина:</h3>

    <ul class='d-flex flex-wrap'>
        <? foreach ($gallery as $item): ?>
            <li class='figure card m-2'>
                <h6><?= $item['item_name'] ?></h6>
                <h6>Цена: <?= $item['price'] ?> руб.</h6>
                <a href="/card/<?= $item['id'] ?>" class="card_link"><img src="/img/small/<?= $item['name']; ?>"
                                                        alt="<?= $item['name']; ?>"></a>
                <button class="buy btn bg-nav mt-1" id="<?= $item['id'] ?>_buyButton" data-id="<?= $item['id'] ?>">
                    Купить
                </button>
                <p class='card__description'><?= $item['description'] ?></p>
            </li>
        <? endforeach; ?>
    </ul>

    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="../../../catalog/<?=$previous_page?>"><i class="fas fa-arrow-left"></i></a></li>
        <? for ($i = 1; $i <= $pages_count; $i++): ?>
            <li class="page-item pagination_item" id="page<?=$i?>"><a class="page-link" href="../../../catalog/<?=$i?>"><?=$i?></a></li>
        <? endfor; ?>
        <li class="page-item"><a class="page-link" href="../../../catalog/<?=$next_page?>"><i class="fas fa-arrow-right"></i></a></li>
    </ul>
</div>


<script>

    $(document).ready(function () {
            // let url_page_number = explode("/", $_SERVER['REQUEST_URI'])[2];
            let current_page;
            $str = window.location.href;
            $str = $str.substr(-5, 5);
            if($str.match(/\d+$/)) {
                let url_page_num = $str.match(/\d+/)[0];
                current_page = "#page" + url_page_num;
            } else {
                current_page = "#page1";
            }

            $(current_page).addClass("active");

            $(".buy").on('click', function (event) {
                let counter = $("#counter").html();
                console.log(`counter: ${counter}`);
                let id = parseInt(event.target.id);
                console.log(id);

                $.ajax(
                    {
                        url: "../add_to_basket/" + id,
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        error: function () {
                            console.log("ajax error");
                        },
                        success: function (answer) {
                            console.log(answer);
                            if (answer['error']) {
                                alert(answer['error']);
                            }

                            $("#counter").html(++counter);

                        }
                    })
            })
        }
    )

</script>