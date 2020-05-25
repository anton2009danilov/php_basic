<h1>Магазин мягких игрушек "Best Friends"</h1>
<p>Приветствуем Вас на сайте нашего магазина!<br>
    Здесь мы собрали коллекцию мягких игрушек самых разных видов и размеров.<br>
    Здесь каждый найдёт себе мягкого и доброго друга!
</p>

<h3>Наш адрес: Санкт-Петербург, ул. Детская, 10.</h3>
<h3>Телефон: 8 812 555-55-55</h3>

<div id="map" style="width: 800px; height: 600px"></div>



<script>
    ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
                center: [59.928005, 30.251019],
                zoom: 17
            }, {
                searchControlProvider: 'yandex#search'
            }),

            // Создаём макет содержимого.
            MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
            ),

            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                // hintContent: 'Собственный значок метки',
                balloonContent: 'Магазин мягких игрушек "Best Friends"<br> ул. Детская, дом 10'
            }, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: './img/google-location.png',
                // Размеры метки.
                iconImageSize: [56, 50],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-40, -30]
            }),

            myPlacemarkWithContent = new ymaps.Placemark([59.928005, 30.251019], {
                // hintContent: 'Собственный значок метки с контентом',
                iconContent: '12'
            }, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#imageWithContent',
                // Своё изображение иконки метки.
                iconImageHref: 'images/logo.png',
                // Размеры метки.
                iconImageSize: [48, 48],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [0, 0],
                // Смещение слоя с содержимым относительно слоя с картинкой.
                iconContentOffset: [-10, -10],
                // Макет содержимого.
                iconContentLayout: MyIconContentLayout
            });

        myMap.geoObjects
            .add(myPlacemark)
            .add(myPlacemarkWithContent);
    });

</script>





<!--<script type="text/javascript">-->
<!--    // Функция ymaps.ready() будет вызвана, когда-->
<!--    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.-->
<!--    ymaps.ready(init);-->
<!--    function init(){-->
<!--        // Создание карты.-->
<!--        var myMap = new ymaps.Map("map", {-->
<!--            // Координаты центра карты.-->
<!--            // Порядок по умолчанию: «широта, долгота».-->
<!--            // Чтобы не определять координаты центра карты вручную,-->
<!--            // воспользуйтесь инструментом Определение координат.-->
<!--            center: [59.928005, 30.251019],-->
<!--            // center: [55.76, 37.64],-->
<!--            // Уровень масштабирования. Допустимые значения:-->
<!--            // от 0 (весь мир) до 19.-->
<!--            zoom: 17-->
<!--        });-->
<!--    }-->
<!--</script>-->