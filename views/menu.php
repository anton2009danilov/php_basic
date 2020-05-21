<div class="container bg-nav container-round">
    <ul class="nav  align-content-center">
        <a href="../../.." class="logo"></a>
        <? foreach ($params as $item): ?>

            <li class='nav-item'>
                <a class='nav-link' href='<?= $item['link'] ?>'>
                    <?= $item['name'] ?>
                    <? if ($item['cart']): ?>
                        <? if (!$_SESSION['user']): ?>
                            [ <span id="counter"><?= getTotalQuantity(($_SESSION['id'])) ?></span> ]
                        <? else: ?>
                            [ <span id="counter"><?= getTotalQuantity() ?></span> ]
                        <? endif; ?>
                    <? endif; ?>
                </a>
            </li>


        <? endforeach; ?>

    </ul>
</div>
