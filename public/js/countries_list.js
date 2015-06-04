/**
 * Created by Home on 4/18/2015.
 */
var tagsData = [
    {id:1,tag:'Latvia',selected:true},
    {id:2,tag:'Banana'},
    {id:3,tag:'Cherry'},
    {id:4,tag:'Cantelope'},
    {id:5,tag:'Grapefruit'},
    {id:6,tag:'Grapes'},
    {id:7,tag:'Lemon'},
    {id:8,tag:'Lime'},
    {id:9,tag:'Melon'},
    {id:10,tag:'Orange'},
    {id:11,tag:'Strawberry'},
    {id:11,tag:'Watermelon'}
];

function ctrlTags($scope){

    $scope.items = tagsData;

};

// init angular app and ctrls
angular
    .module('myApp',[])
    .controller('ctrlTags', ['$scope', ctrlTags]);


// init jquery functions and plugins
$(document).ready(function(){
    $.getScript('//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js', function(){
        $("#mySel2").select2({
            closeOnSelect:false
        });
    });
});