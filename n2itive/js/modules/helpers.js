



// getOffsetTop
export function getOffsetTop(element) {
    let offsetTop = 0;
    while (element) {
        offsetTop += element.offsetTop;
        element = element.offsetParent;
    }
    return offsetTop;
}



// sidebar_scroll
export function sidebar_scroll(sidebar, section, scroll = false, sidebar_offset = '', content_item = '') {
    let offsetTop = getOffsetTop(sidebar);

    if (sidebar_offset) {
        offsetTop = sidebar_offset
    }

    let sidebar_top = offsetTop

    let content = '';

    if (content_item == '') {
        content = section.querySelector('.data-tabs')
    } else {
        content = content_item
    }

    let sidebar_bot = offsetTop + content.clientHeight
    sidebar_bot = sidebar_bot - sidebar.clientHeight
    let sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

    if (sidebar_bot_2 < 0) {
        sidebar_bot_2 = 0
    }

    let scrolled = window.scrollY

    if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
        sidebar.classList.add('active')
        sidebar.classList.remove('active-2')
        sidebar.style.top = '15px'
    } else {
        if (scrolled >= sidebar_top - 15) {
            sidebar.classList.remove('active')
            sidebar.classList.add('active-2')
            sidebar.style.top = sidebar_bot_2 + 'px'
        } else {
            sidebar.classList.remove('active')
            sidebar.style.top = '0'
        }
    }

    if (scroll) {
        window.addEventListener('scroll', function (e) {
            sidebar_bot = offsetTop + content.clientHeight
            sidebar_bot = sidebar_bot - sidebar.clientHeight
            sidebar_bot_2 = content.clientHeight - sidebar.clientHeight

            if (sidebar_bot_2 < 0) {
                sidebar_bot_2 = 0
            }

            let scrolled = window.scrollY

            if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
                sidebar.classList.add('active')
                sidebar.classList.remove('active-2')
                sidebar.style.top = '15px'
            } else {
                if (scrolled >= sidebar_top - 15) {
                    sidebar.classList.remove('active')
                    sidebar.classList.add('active-2')
                    sidebar.style.top = sidebar_bot_2 + 'px'
                } else {
                    sidebar.classList.remove('active')
                    sidebar.style.top = '0'
                }
            }
        });
    }
}




// getModelData
export function getModelData(slug) {
    return window.teslaModels.find(model => model.slug === slug);
}

// updatePopupWithSelectedModelAndYear
export function updatePopupWithSelectedModelAndYear(selectedModelSlug = '', selectedYear = '', resetToCurrent = false) {
    const selectedModel = getModelData(selectedModelSlug);
    let section = document.querySelector('.cmp-1-models')


    if (resetToCurrent) {
        const selectedModelSlug = getCookie('selectedModel');
        const selectedYear = getCookie('selectedYear');

        const selectedModel = getModelData(selectedModelSlug);

        if (selectedModelSlug && selectedYear) {
            if (selectedModel) {
                section.querySelectorAll('.model').forEach(model => {
                    model.classList.remove('active');
                    model.classList.remove('open');

                    if (model.dataset.slug === selectedModel.slug) {
                        model.classList.add('active');
                    }
                });

                section.querySelectorAll('.year').forEach(yearBtn => {
                    yearBtn.classList.remove('active');
                });

                const yearBtn = section.querySelector(`.model.active .year-selection [data-year="` + selectedYear + `"]`);
                if (yearBtn) {
                    yearBtn.classList.add('active');
                }
            }
        }
    }


    if (selectedModel) {
        document.querySelectorAll('.model').forEach(model => {
            model.classList.remove('active');
            model.classList.remove('open');

            if (model.dataset.slug === selectedModel.slug) {
                model.classList.add('active');
            }
        });

        const modelYears = selectedModel.years || [];

        section.querySelectorAll('.year').forEach(yearBtn => {
            yearBtn.classList.remove('active');
        });

        const yearSelectionBlock = document.querySelector(`.model.active .year-selection`);
        if (yearSelectionBlock) {

            if (!selectedYear) {
                selectedYear = getCookie(`selectedYear-${selectedModelSlug}`) || modelYears[0];
            }

            yearSelectionBlock.querySelectorAll('.year').forEach(yearBtn => {
                if (yearBtn.dataset.year === selectedYear) {
                    yearBtn.classList.add('active');
                }
            });

            setCookie('selectedYear', selectedYear, 7);
        }
    }
}

// close_popup
export function close_popup(event = '') {
    if (document.querySelector('.sct-header').querySelector('.data-nav').classList.contains('active')) {
        document.querySelector('.sct-header').classList.remove('active')
        document.querySelector('.sct-header').querySelector('.data-nav').classList.remove('active')
    }

    document.querySelector('.cmp-4-popup .cmp4-close img').click();
    updatePopupWithSelectedModelAndYear('', '', true)

    if (event.target && event.target.closest('.js-popup-open') && document.querySelector('.cmp-4-popup.active')) {
        let first = document.querySelector('.cmp-4-popup.active')
        let target_popup_id = event.target.closest('.js-popup-open').getAttribute('data-target');
        let second = document.querySelector('[data-id="' + target_popup_id + '"]');

        document.querySelector('.cmp-4-popup.active').classList.remove('active')
        if (first == second) {
            document.querySelector('body').classList.remove('overflow-hidden');
            document.querySelector('html').classList.remove('overflow-hidden');
        }
    } else {
        document.querySelector('body').classList.remove('overflow-hidden');
        document.querySelector('html').classList.remove('overflow-hidden');
    }
}


// check_state_configurator
export function check_state_configurator() {
    if (document.querySelector('.acf-1-configurator')) {
        let section = document.querySelector('.acf-1-configurator')

        if (window.state_1) {
            if (section.querySelector('.data-thumbnail-slider .selected')) {
                if (section.querySelector('.data-b4.mod-one').classList.contains('state-active')) {
                    section.querySelector('.data-b4.mod-one').classList.remove('state-active')
                    section.querySelector('.data-b4.mod-one').classList.add('active')
                }

                window.state_2 = true

                if (window.matchMedia("(max-width: 1025px)").matches) {
                    if (section.querySelector('.data-b3.mod-mobile').classList.contains('state-disabled')) {
                        section.querySelector('.data-b3.mod-mobile').classList.remove('state-disabled')
                    }
                } else {
                    const mobileNodes = section.querySelectorAll('.data-b3:not(.mod-mobile)');

                    if (mobileNodes[0].classList.contains('state-disabled')) {
                        mobileNodes[0].classList.remove('state-disabled')
                    }
                }
            } else {
                if (section.querySelector('.data-b4.mod-one')) {
                    section.querySelector('.data-b4.mod-one').classList.add('state-active')
                }
            }
        }


        if (window.state_2) {
            let b3_item = '';

            if (window.matchMedia("(max-width: 1025px)").matches) {
                b3_item = section.querySelector('.data-b3.mod-mobile')
            } else {
                const mobileNodes = section.querySelectorAll('.data-b3:not(.mod-mobile)');
                b3_item = mobileNodes[0]
            }

            if (b3_item.querySelector('.data-b3-item.selected') ){
                if (b3_item.querySelector('.data-b4.mod-two').classList.contains('state-active')) {
                    b3_item.querySelector('.data-b4.mod-two').classList.remove('state-active')
                    b3_item.querySelector('.data-b4.mod-two').classList.add('active')
                }

                window.state_configurator = 2;
                window.state_3 = true

                if (section.querySelector('.data-b5').classList.contains('state-disabled')) {
                    section.querySelector('.data-b5').classList.remove('state-disabled')
                }
            } else {
                if (b3_item.querySelector('.data-b4.mod-two')) {
                    b3_item.querySelector('.data-b4.mod-two').classList.add('state-active')
                }
            }
        }

        if (window.state_3) {
            if (section.querySelector('.data-b5-item.selected')) {
                if (section.querySelector('.data-b4.mod-three').classList.contains('state-active')) {
                    section.querySelector('.data-b4.mod-three').classList.remove('state-active')
                    section.querySelector('.data-b4.mod-three').classList.add('active')
                }
            } else {
                if (section.querySelector('.data-b4.mod-three')) {
                    section.querySelector('.data-b4.mod-three').classList.add('state-active')
                }
            }
        }
    }
}

// setCookie
export function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// getCookie
export function getCookie(name) {
    const nameEq = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(nameEq) === 0) {
            return c.substring(nameEq.length, c.length);
        }
    }
    return "";
}
