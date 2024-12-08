


document.addEventListener('DOMContentLoaded', function () {
    // Function to change the button text
    function changeButtonText() {
        var addButtons = document.querySelectorAll('.acf-gallery-toolbar .acf-gallery-add');
        addButtons.forEach(function (button) {
            if (button.textContent != 'Add from Gallery') {
                button.textContent = 'Add from Gallery';
            }
        });
    }

    // Initial change for already loaded elements
    setTimeout(changeButtonText, 10);

    // Create a MutationObserver to watch for changes in the DOM
    var observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                changeButtonText();
            }
        });
    });

    // Configuration of the observer:
    var config = { childList: true, subtree: true };

    // Pass in the target node, as well as the observer options
    observer.observe(document.body, config);

});



// jQuery(document).ready(function ($) {
//     function checkForDuplicates() {
//         var selectedOptions = [];
//         var state = true;

//         // Iterate through each repeater row
//         $('.acf-field-665a04f910586 .acf-row').each(function () {
//             // Find the selected option within the row
//             var selectedOption = $(this).find('select').val();
//             console.log(111)
//             // Check if the selected option is already in the array
//             if (selectedOptions.indexOf(selectedOption) !== -1) {
//                 console.log(123)
//                 // If duplicate is found, show the notice and exit the loop
//                 console.log($('.acf-field-repeater.acf-field-665a04f910586'))
//                 $('.acf-field-repeater.acf-field-665a04f910586').append('<div class="notice notice-error acf-duplicate-notice"><p>You have selected the same option more than once. Please choose different options.</p></div>');
//                 state = false;
//                 return false; // Exit the loop early
//             } else {
//                 // If the option is not a duplicate, add it to the array
//                 selectedOptions.push(selectedOption);
//             }
//         });

//         if (state) {
//             $('.acf-duplicate-notice').remove();
//         }
//     }

//     // Event listener for when select options change
//     $(document).on('change', '.acf-row select', function () {
//         checkForDuplicates();
//     });

//     // Initial check on page load
//     checkForDuplicates();
// });