$(function () {
    $('#banner').toggleClass('on-load');
});

new Cleave('.input-phone', {
    phone: true,
    phoneRegionCode: 'fr'
});

new Cleave('.input-date-naiss', {
    date: true,
    delimiter: ' / ',
    datePattern: ['d', 'm', 'Y']
});

new Cleave('.input-cp', {
    blocks: [2, 3],
    numericOnly: true
});
