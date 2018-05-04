
$(function () {
    $(".price").bind('click', function () {
        $('.price-edit').css('display','none');
        $(this).children('.price-text').css('display','none');
        $(this).children('.price-edit').css('display','block');
    });
    $('#price-change').bind('click', function(){
        var newPrice=0;
        newPrice=$(this).parent('span').prev('input').val();
        var ID=0
        ID=$(this).parent('span').prev('input').attr('data-id');
        $.ajax({
            url: 'products/price-edit',
            method: 'GET',
            data: {
                newPrice: newPrice,
                productID: ID,
            },
            dataType: 'json'
        }).done(function(data, textStatus, jqXHR){
            window.location.reload();
        }).fail(function() {
            alert('Ошибка при обновлении цены');
        });
    });
});
