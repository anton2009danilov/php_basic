<div class="bg-nav">
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
<!--                        [ <span id="counter">--><?//= getTotalQuantity() ?><!--</span> ]-->
<!--                        [ <span id="counter">--><?//= getTotalQuantity(($_SESSION['id'])) ?><!--</span> ]-->
                        <? if (!$_SESSION['id']): ?>
                            [ <span id="counter"><?= getTotalQuantity() ?></span> ]
                        <? else: ?>
                            [ <span id="counter"><?= getTotalQuantity(($_SESSION['id'])) ?></span> ]
                        <? endif; ?>
                </li>
                </a>
            <? endif; ?>

        <? endforeach; ?>

    </ul>
</div>
