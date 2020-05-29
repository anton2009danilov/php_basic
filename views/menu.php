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
                        <? if (!$_SESSION['id']): ?>
                            [ <span id="counter"
                                    data-value="<?= getTotalQuantity() ?>"><?= getTotalQuantity() ?></span> ]
                        <? else: ?>
                            [ <span id="counter"
                                    data-value="<?= getTotalQuantity(($_SESSION['id'])) ?>"><?= getTotalQuantity(($_SESSION['id'])) ?></span> ]
                        <? endif; ?>
                    </a>
                </li>
            <? endif; ?>

        <? endforeach; ?>

    </ul>
</div>
