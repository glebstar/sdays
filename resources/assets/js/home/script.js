$(document).ready(function(){
    var city_id = $.cookie('city_id');
    if (city_id != undefined) {
        $('#sel-city').val(city_id);
        setCity(city_id);
    }

    $('#sel-city').change(function(){
        setCity($(this).val());
    });
});

function setCity(cityId) {
    $('#res').hide();

    if (cityId == 0) {
        $('#res-info').html('Select city...').show();
        $.removeCookie('city_id');
    } else {
        $.cookie('city_id', cityId, { expires: 30 });
        $('#res-info').html('Loading...').show();

        $.post('/sdays', {city_id: cityId, _token: csrf_token}, function (data) {
            $('#res-info').hide();
            $('#res-his').html(data.his);
            $('#res-month').html(data.month);
            $('#res-curr').html(data.curr);
            $('#res').show();
        });
    }
}