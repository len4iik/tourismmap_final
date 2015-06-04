/**
 * Created by Home on 5/4/2015.
 */

$(document).ready(function()
{
    $("#form_submit").click(function()
    {
        $("#target_form").submit();
    });

    $("#category_submit").click(function()
    {
        $("#category_form").submit();
    });

    $("#category_update_submit").click(function()
    {
        $("#category_update_form").submit();
    });

    $(".new_category").click(function()
    {
        var id = event.target.id;
        var pieces = id.split("_");
        $("#category_form").prop('action', '/forum/category/' + pieces[2] + '/new');
    });

    $(".update_category").click(function()
    {
        var id = event.target.id;
        var pieces = id.split("_");
        $("#category_update_form").prop('action', '/forum/category/' + pieces[2] + '/edit');
    });

    $(".delete_group").click(function(event)
    {
        $("#btn_delete_group").prop('href', '/forum/group/' + event.target.id + '/delete');
    });

    $(".delete_category").click(function(event)
    {
        $("#btn_delete_category").prop('href', '/forum/category/' + event.target.id + '/delete');
    });

    $(".delete_post").click(function(event)
    {
        $("#btn_delete_post").prop('href', '/forum/post/' + event.target.id + '/delete');
    });

    $(".delete_country").click(function(event)
    {
        $("#btn_delete_country").prop('href', '/countries/delete/' + event.target.id);
    });
});