<?php


?>
<head>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ваш API-01ff6321-24c8-4bc8-8a91-c197c7311d55&lang=ru_RU"
            type="text/javascript">
    </script>
</head>
<div id="map" style="width: 600px; height: 400px"></div>
<script type="text/javascript">
    ymaps.ready(init);

    function init() {
        var Map = new ymaps.Map("map", {
            center: [49.83, 73.16],
            zoom: 10
        });

        var searchControl = new ymaps.control.SearchControl({
            options: {
                provider: 'yandex#search'
            }
        });

        myMap.controls.add(searchControl);
        Map.setType('yandex#map');
    }
</script>
