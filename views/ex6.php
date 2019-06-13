<?

$arr2 = [
    'Menu1' => [
        'linkA1' => 'Страница А1',
        'linkA2' => 'Страница А2',
        'menu2' => [
            'Menu2' => [
                'linkB1' => 'Страница B1',
                'linkB2' => 'Страница B2',
                'linkB3' => 'Страница B3',
                'linkB4' => 'Страница B4',
            ]
        ],
        'linkA3' => 'Страница А3',
        'linkA4' => 'Страница А4',
    ]
];

$arr = [
    'Menu1' => [
        'linkA1' => 'Страница А1',
        'linkA2' => 'Страница А2',
    ]
];

function render_menu($arr) {
    $menu = '<ul>';
    foreach ($arr as $key => $list) {
        $menu .= $key;

        foreach($list as $link => $text) {
            if (!is_array($text)) {
                $menu .= "<li><a href = '$link'>{$text}</a></li>";
            } else {
                
               $menu .= render_menu($list[$link]);
            }
        }
    }

    return $menu . '</ul>';
}

// echo render_menu($arr);
echo render_menu($arr2);