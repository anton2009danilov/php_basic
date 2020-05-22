<div class="bg-nav container-round ml-1 mr-1">
    <ul class="nav d-flex">

        <a href="../../../catalog" class="logo"></a>
        <? foreach ($params as $item): ?>
            <? if ($item['name'] !== "Корзина"): ?>
                <li class='nav-item'>
                    <a class='nav-link' href='<?= $item['link'] ?>'>
                        <?= $item['name'] ?>
                    </a>
                </li>
            <? endif; ?>

            <? if ($item['cart']): ?>
                <li class="ml-auto">
                    <a class='nav-link' href='<?= $item['link'] ?>'>
                        <?= $item['name'] ?>
                        <? if (!$_SESSION['user']): ?>
                            [ <span id="counter"><?= getTotalQuantity(($_SESSION['id'])) ?></span> ]
                        <? else: ?>
                            [ <span id="counter"><?= getTotalQuantity() ?></span> ]
                        <? endif; ?>
                </li>
                </a>
            <? endif; ?>

        <? endforeach; ?>

    </ul>
</div>
