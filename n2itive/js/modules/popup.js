
import { close_popup } from './helpers';

export function init_popup() {
    // js-popup-open
    if (document.querySelector('.js-popup-open')) {
        let section = document.querySelector('.js-popup-open')

        if (document.querySelector('.cmp-4-popup')) {
            let items = document.querySelectorAll('.js-popup-open')

            items.forEach(element => {
                element.addEventListener('click', function (e) {
                    e.preventDefault()
                    let target_popup_id = this.getAttribute('data-target');
                    let target_popup = document.querySelector('[data-id="' + target_popup_id + '"]');
                
                    if (target_popup.classList.contains('active')) {
                        target_popup.classList.remove('active')

                            document.querySelector('body').classList.remove('overflow-hidden');
                            document.querySelector('html').classList.remove('overflow-hidden');  

                        document.querySelectorAll('.cmp-4-popup').forEach(element => {
                            element.classList.add('mod-transit')
                        });

                        setTimeout(() => {
                            document.querySelectorAll('.cmp-4-popup.mod-transit').forEach(element => {
                                element.classList.remove('mod-transit')
                            });
                        }, 1);
                        return
                    }

                    if (target_popup) {
                        if (document.querySelector('.sct-header').querySelector('.data-nav').classList.contains('active')) {
                            document.querySelector('.sct-header').classList.remove('active')
                            document.querySelector('.sct-header').querySelector('.data-nav').classList.remove('active')
                        }

                        setTimeout(() => {
                            target_popup.classList.add('active')

                            document.querySelector('body').classList.add('overflow-hidden');
                            document.querySelector('html').classList.add('overflow-hidden');
                        }, 1);
                    }
                })
            });
        }
    }


    // // cmp-3-shipping-calculator
    if (document.querySelector('.cmp-3-shipping-calculator')) {
        let section = document.querySelector('.cmp-3-shipping-calculator')

        section.addEventListener('click', function (e) {

            if (e.target.closest('button[type="submit"]')) {
                if (document.querySelector('.cmp-4-popup.active')) {
                    document.querySelector('.cmp-4-popup.active').classList.remove('active')
                    document.querySelector('body').classList.remove('overflow-hidden');
                    document.querySelector('html').classList.remove('overflow-hidden');
                }
            }
        })
    }

    

    // // cmp-4-popup
    if (document.querySelector('.cmp-4-popup')) {
        let items = document.querySelectorAll('.cmp-4-popup')

        document.addEventListener('click', function (event) {
            let click = false;

            if (!event.target.closest('.cmp-4-popup') && !event.target.closest('.select2-container') && document.querySelector('.cmp-4-popup.active')) {
                click = true;

                if (event.target.closest('.js-popup-open')) {
                    let first = document.querySelector('.cmp-4-popup.active')
                    let target_popup_id = event.target.closest('.js-popup-open').getAttribute('data-target');
                     let second = document.querySelector('[data-id="' + target_popup_id + '"]');
            
                     document.querySelector('.cmp-4-popup.active').classList.remove('active')
                     if (first == second) {
                         document.querySelector('body').classList.remove('overflow-hidden');
                         document.querySelector('html').classList.remove('overflow-hidden');
                     }
                 } else{
                    document.querySelector('.cmp-4-popup.active').classList.remove('active')

                    document.querySelector('body').classList.remove('overflow-hidden');
                    document.querySelector('html').classList.remove('overflow-hidden');
                 }
            }
        })

        items.forEach(element => {
            element.querySelectorAll('.js-close').forEach(close => {
                close.addEventListener('click', function (e) {
                    element.classList.remove('active')
                    close_popup(e);
                })
            });

            element.querySelector('.cmp4-overlay').addEventListener('click', function (e) {
                element.classList.remove('active')

                close_popup(e);
            })

            element.querySelector('.cmp4-inner-out').addEventListener('click', function (e) {
                if (!e.target.closest('.cmp4-inner')) {
                    element.classList.remove('active')

                    close_popup(e);
                }
            })
        });
    }
}

