<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма</title>
</head>
<body>
<form method="post" id="form" action="">
    <input class="first group1" name="phone[]" maxlength="3" type="tel" value="" placeholder="066" pattern="[0-9]*">
    <input class="second group1" name="phone[]" maxlength="3" type="tel" value="" placeholder="999" pattern="[0-9]*">
    <input class="three group1" name="phone[]" maxlength="4" type="tel" value="" placeholder="9999" pattern="[0-9]*">
    <input class="group1" style="opacity: 0;" name="a" maxlength="1" type="text">
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        crossorigin="anonymous"></script>
<script src="group.js"></script>
<script><!--
    $('.group1').groupinputs();
    $('.group1').on('input propertychange', function (e) {
        var elem = $(e.target),
            value = elem.val(),
            // caret = elem.caret(),
            newValue = value.replace(/[^0-9]/g, ''),
            valueDiff = value.length - newValue.length;

        if (valueDiff) {
            elem
                .val(newValue);
            // .caret(caret.start - valueDiff, caret.end - valueDiff);
        }
    });

    $(document).on('blur', 'input.three, input.second, input.first', function () {
        var $v1 = $('input.three').val()
        var $v2 = $('input.second').val()
        var $v3 = $('input.first').val()
        if($v1.length>3 && $v2.length == 3 && $v3.length == 3){
            $.ajax({
                url: 'text.php',
                type: 'post',
                data: $('#form input'),
                dataType: 'html',
                success: function (html) {
                    $('#form').load('text.php p');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });

    --></script>
</body>
</html>