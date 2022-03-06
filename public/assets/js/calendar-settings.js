$(document).ready(function () {
    // you may need to change this code if you are not using Bootstrap Datepicker
    $('.js-datepicker').datepicker({
        duration: '',
        changeMonth: true,
        changeYear: true,
        showTime: false,
        time24h: true
    });

    $.datepicker.regional['bg'] = {
        closeText: 'затвори',
        prevText: '&#x3c; назад',
        nextText: 'напред &#x3e;',
        nextBigText: '&#x3e;&#x3e;',
        currentText: 'днес',
        monthNames: ['Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
        monthNamesShort: ['Яну', 'Фев', 'Мар', 'Апр', 'Май', 'Юни', 'Юли', 'Авг', 'Сеп', 'Окт', 'Нов', 'Дек'],
        dayNames: ['Неделя', 'Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък', 'Събота'],
        dayNamesShort: ['Нед', 'Пон', 'Вто', 'Сря', 'Чет', 'Пет', 'Съб'],
        dayNamesMin: ['Не', 'По', 'Вт', 'Ср', 'Че', 'Пе', 'Съ'],
        weekHeader: 'Wk',
        dateFormat: 'dd-mm-yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        yearRange: '1900:2100',
    };
    $.datepicker.setDefaults($.datepicker.regional['bg']);
});