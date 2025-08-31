jQuery(document).ready(function ($) {


    setTimeout(() => {
    console.log($('.acf-accordion-title').length); 

    $('.acf-accordion-title').on('click', function (e) {
        var $accordion = $(this).closest('.acf-field-accordion');

        $accordion.toggleClass('-open'); 

    });

    $(document).off('click', '.acf-accordion-title');

    }, 300);
});
