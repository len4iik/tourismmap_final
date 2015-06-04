$(function(){
    $('#map').vectorMap({map: 'europe_mill_en',
        backgroundColor: 'white',
        regionStyle: {
            initial: {
                fill: '#a9a9a9'
            },
            hover: {
                "fill-opacity": 0.5
            }
        },
        series: {
            regions: [{
                values: visited,
                scale: ['#a9a9a9', '#009018'],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionClick: function (event, code) {
            var map = $('#map').vectorMap('get', 'mapObject');
            var region = map.getRegionName(code);
            /*window.alert(region);*/
            window.location.href = "/countries/" + region;
        }});
});