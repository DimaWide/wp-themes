

import { getModelData, updatePopupWithSelectedModelAndYear, close_popup, check_state_configurator, setCookie, getCookie } from './helpers.js';

export function init_acf_1_configurator() {




    // cmp-1-models
    if (document.querySelector('#yearSelect')) {
        const modelItems = document.querySelectorAll(".data-thumbnail-slider-item");
        const yearSelect = document.getElementById("yearSelect");

        modelItems.forEach(item => {
            item.addEventListener("click", function () {
                setTimeout(() => {
                    const years = JSON.parse(this.getAttribute("data-years")); //
                    const selectedYear = getCookie("selectedYear");

                    yearSelect.innerHTML = '<option value="" disabled>Select year</option>';

                    years.forEach(year => {
                        const option = document.createElement("option");
                        option.value = year;
                        option.textContent = year;

                        if (selectedYear && selectedYear == year) {
                            option.selected = true;
                        }

                        yearSelect.appendChild(option);
                    });
                }, 1);
            });
        });


        //
        yearSelect.addEventListener("change", function () {
            const selectedYear = this.value;
            setCookie("selectedYear", selectedYear, 7);

            filterParts();
        });
    }






    // cmp-1-models
    if (document.querySelector('.cmp-1-models')) {
        let section = document.querySelector('.cmp-1-models')
        let popup = document.querySelector('.tesla-models')

        const models = document.querySelectorAll('.model');
        const years = document.querySelectorAll('.year');

        models.forEach(model => {
            model.addEventListener('click', function (e) {
                if (e.target.closest('.cmp1-item-info')) {

                    if (!this.classList.contains('active')) {
                        years.forEach(y => y.classList.remove('active'));

                        years.forEach(function (element) {
                            element.classList.remove('active');
                        });
                    }

                    models.forEach((element) => {
                        element.classList.remove('active');

                        if (element !== this) {
                            element.classList.remove('open');
                        }
                    });

                    this.classList.add('active');

                    if (!this.classList.contains('open')) {
                        this.classList.add('open');
                    } else {
                        this.classList.remove('open');
                    }
                }
            });
        });





        // years
        years.forEach(year => {
            year.addEventListener('click', function () {
                years.forEach(y => y.classList.remove('active'));
                this.classList.add('active');
            });
        });


        // confirmButton
        document.getElementById('confirmButton').addEventListener('click', function () {

            if (checkSelection()) {
                const activeItem = document.querySelector('.cmp1-item.active');

                if (activeItem) {
                    const items = Array.from(document.querySelectorAll('.cmp1-item'));
                    const activeIndex = items.indexOf(activeItem);

                    setCookie('selectedModel', activeItem.dataset.slug, 7);
                    setCookie('selectedYear', activeItem.querySelector('.year.active').dataset.year, 7);

                    if (activeIndex !== -1) {
                        const mainSliderElement = document.querySelector('.main-slider');
                        if (mainSliderElement && mainSliderElement.swiper) {
                            mainSliderElement.swiper.slideToLoop(activeIndex);
                        }

                        const thumbSliderElement = document.querySelector('.thumbnail-slider');
                        if (thumbSliderElement && thumbSliderElement.swiper) {
                            thumbSliderElement.swiper.slideTo(activeIndex);
                            thumbSliderElement.swiper.activeIndex = activeIndex
                        }

                        const slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');

                        slides.forEach(slide => {
                            slide.classList.remove('selected');
                        });

                        slides[activeIndex]?.classList.add('selected');
                    }
                }

                update_header_model();

                if (document.querySelector('.archive.woocommerce')) {
                    const cleanURL = window.location.href.split('/page')[0];
                    window.location.href = wcl_obj.site_url + '/shop';
                    return
                }

                close_popup();
            }

            if (state_configurator == 2) {
                filterParts();
            }
        });





        // checkSelection
        function checkSelection() {
            const selectedModel = document.querySelector('.model.active');
            const selectedYear = selectedModel ? selectedModel.querySelector('.year.active') : null;

            if (!selectedModel) {
                alert('Please select a model!');
                return false;
            }
            if (!selectedYear) {
                alert('Please select a year!');
                return false;
            }

            return true;
        }
    }






    // acf-1-configurator
    if (document.querySelector('.acf-1-configurator')) {
        let section = document.querySelector('.acf-1-configurator')

        const carImages = section.querySelectorAll('.data-b1-car');

        carImages.forEach(carImg => {
            carImg.addEventListener('mouseenter', (e) => {
                carImg.querySelector('.data-b1-car-img').classList.add('active');
            });

            carImg.addEventListener('mouseleave', (e) => {
                carImg.querySelector('.data-b1-car-img').classList.remove('active');
            });
        });


        if (window.matchMedia("(max-width: 1025px)").matches) {

            document.querySelectorAll(".data-b1-note-plus").forEach(function (plusButton) {
                plusButton.addEventListener("click", function (event) {
                    event.stopPropagation();
                    let noteCard = plusButton.closest(".data-b1-note").querySelector(".data-b1-note-card");

                    if (noteCard) {
                        let clonedCard = noteCard.cloneNode(true);

                        if (document.querySelector('.cloned-block')) {
                            document.querySelector('.cloned-block').remove()
                        }

                        if (!document.querySelector('.cloned-block')) {
                            clonedCard.classList.add("cloned-block");

                            let closeButton = clonedCard.querySelector(".data-b1-note-card-close");
                            if (closeButton) {
                                closeButton.addEventListener("click", function () {
                                    clonedCard.remove();
                                });
                            }

                            document.querySelector('.mod-info-car .cmp-7-car-info').appendChild(clonedCard);
                            document.querySelector('.mod-info-car').classList.add('active')
                            document.querySelector('body').classList.add('overflow-hidden');
                            document.querySelector('html').classList.add('overflow-hidden');
                        }
                    }
                });
            });
        }



        const carNote = section.querySelectorAll('.data-b1-note');

        carNote.forEach(carImg => {
            carImg.addEventListener('click', (e) => {
                section.querySelector('.data-main-slider-out').classList.add('hovered')
            });

            carImg.addEventListener('mouseenter', (e) => {
                section.querySelector('.data-main-slider-out').classList.add('hovered')
            });

            carImg.addEventListener('mouseleave', (e) => {
                section.querySelector('.data-main-slider-out').classList.remove('hovered')
            });
        });

        document.querySelectorAll('.data-thumbnail-slider-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.data-thumbnail-slider-item').forEach(slide => slide.classList.remove('selected'));
                item.classList.add('selected');

                const selectedModelSlug = getCookie('selectedModel');

                if (!selectedModelSlug) {
                    setCookie('selectedModel', item.dataset.slug, 7);
                    updatePopupWithSelectedModelAndYear(item.dataset.slug)
                    update_header_model()
                    check_state_configurator()
                }
            });
        });

        document.querySelectorAll('.data-b3-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.data-b3-item').forEach(option => option.classList.remove('selected'));
                item.classList.add('selected');
                setCookie('selectedCarOption', item.dataset.key, 7);

                check_state_configurator()

                if (state_configurator == 2) {
                    filterParts();
                }
            });
        });

        const parentElement = document.querySelector('.data-b5-list');
        if (parentElement) {
            parentElement.addEventListener('click', function (event) {
                event.preventDefault();

                const clickedItem = event.target.closest('.data-b5-item');
                if (clickedItem) {
                    clickedItem.classList.add('selected');
                    check_state_configurator();
                    const url = clickedItem.querySelector('a').getAttribute('href');
                    window.open(url, '_blank');
                }
            });
        }
    }


 

    // acf-1-configurator
    if (document.querySelector('.acf-1-configurator')) {
        let section = document.querySelector('.acf-1-configurator')
        let initialSlide = document.querySelector('.cmp-1-models').getAttribute('data-active-index')
        const yearSelect = document.getElementById("yearSelect");

        if (window.matchMedia("(max-width: 1200px)").matches) {
            OverlayScrollbars(document.querySelector(".scroll-container"), {
                className: "os-theme-dark",  
                autoHide: "leave", 
                scrollbars: {
                    visibility: "auto",
                    autoHideDelay: 1000
                }
            });
        }

        window.mainSlider = new Swiper('.acf-1-configurator .main-slider', {
            slidesPerView: 1,
            speed: 0,
            noSwiping: true,
            touchMove: false,
            simulateTouch: false,
            allowTouchMove: false,
            spaceBetween: 10,
            initialSlide: initialSlide,
            on: {
                init: function () {
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {

                        const lazyImages = activeSlide.querySelectorAll('.lazy-image');
                        lazyImages.forEach(loadImage);
                    }
                },
                slideChange: function () {
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        const lazyImages = activeSlide.querySelectorAll('.lazy-image');
                        lazyImages.forEach(loadImage);
                    }
                },
            },
            navigation: {
                nextEl: section.querySelector('.mod-next'),
                prevEl: section.querySelector('.mod-prev'),
            },

            breakpoints: {
                0: {
                    allowTouchMove: true,
                    touchRatio: 0.2,
                    speed: 550,
                },
                500: {
                    allowTouchMove: false,
                    speed: 0,
                },
            }
        });

        window.thumbnailSlider = new Swiper('.acf-1-configurator .thumbnail-slider', {
            direction: 'vertical',
            slidesPerView: 5,
            speed: 0,
            spaceBetween: 15,
            initialSlide: initialSlide,
            noSwiping: true,
            touchMove: false,
            simulateTouch: false,
            freeMode: {
                enabled: true,
                momentum: false,
            },
            breakpoints: {
                0: {
                    slidesPerView: 'auto',
                    direction: 'horizontal',
                    noSwiping: false,
                    touchMove: true,
                    simulateTouch: true,
                    allowTouchMove: true,
                    speed: 500,
                },
                500: {
                    slidesPerView: 5,
                    direction: 'horizontal',
                    noSwiping: true,
                    touchMove: false,
                    simulateTouch: false,
                    slidesOffsetAfter: 0,
                    slidesOffsetBefore: 0,
                    allowTouchMove: false,
                    speed: 0,
                },
                1199: {
                    direction: 'vertical',
                    slidesPerView: 5,
                    centeredSlides: false,
                    speed: 0,
                },
            }
        });

        if (window.matchMedia("(min-width: 1200px)").matches) {
            window.mainSlider.controller.control = window.thumbnailSlider;
            window.thumbnailSlider.controller.control = window.mainSlider;
        }

        const addClickHandlers = () => {
            const slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');
            slides.forEach((slide, index) => {
                slide.setAttribute('data-id', index);
                slide.addEventListener('click', () => {
                    const slideId = parseInt(slide.getAttribute('data-id'), 10);
                    const currentSlide = window.mainSlider.realIndex;

                    console.log(slideId)

                    window.mainSlider.slideTo(slideId);
                    slides.forEach(slide => slide.classList.remove('swiper-slide-active'));

                    if (window.matchMedia("(max-width: 1025px)").matches) {
                        if (slideId === 1 && currentSlide > 0) {
                            window.thumbnailSlider.setTransition(300);
                            window.thumbnailSlider.setTranslate(0);
                        }
                    }
                    if (slideId === 0 ) {
                        filterParts();
                    }
                    
                    slide.classList.add('swiper-slide-active');
                });
            });
        };

        addClickHandlers();




        window.mainSlider.on('slideChange', function () {
            const activeIndex = window.mainSlider.activeIndex;
            let prev = document.querySelector('.data-main-slider .swiper-slide-active')

            const prevIndex = Array.from(prev.parentNode.children).indexOf(prev);

            if (window.matchMedia("(max-width: 1025px)").matches) {
                if (activeIndex === 1 && prevIndex === 2) {
                    setTimeout(() => {
                        window.thumbnailSlider.setTransition(300);
                        window.thumbnailSlider.setTranslate(0);
                    }, 1);
                }
            }

            window.thumbnailSlider.slideTo(activeIndex);

            window.thumbnailSlider.slides.removeClass('swiper-slide-active');
            window.thumbnailSlider.slides.eq(activeIndex).addClass('swiper-slide-active');

            const slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');

            slides.forEach(slide => {
                slide.classList.remove('selected');
            });

            slides[activeIndex]?.classList.add('selected');

            setCookie('selectedModel', slides[activeIndex].dataset.slug, 7);

            updatePopupWithSelectedModelAndYear(slides[activeIndex].dataset.slug)
            update_header_model()
            check_state_configurator()

            filterParts();



            const years = JSON.parse(slides[activeIndex].getAttribute("data-years"));
            const selectedYear = getCookie("selectedYear");

            yearSelect.innerHTML = '<option value="" disabled>Select year</option>';

            years.forEach(year => {
                const option = document.createElement("option");
                option.value = year;
                option.textContent = year;

                if (selectedYear && selectedYear == year) {
                    option.selected = true;
                }

                yearSelect.appendChild(option);
            });
        });
    }




    // sct-header .data-lang
    if (document.querySelector('.sct-header .data-lang')) {
        let section = document.querySelector('.sct-header .data-lang');
        let selectedModels = [];

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.sct-header .data-lang')) {
                section.querySelector('.wcl-cmp-4-lang').classList.remove('active');
            }
        });

        section.addEventListener('click', function (e) {
            if (!e.target.closest('.cmp4-item')) {
                section.querySelector('.wcl-cmp-4-lang').classList.toggle('active');
            }
        });

        section.querySelectorAll('.cmp4-item').forEach(item => {
            if (item.classList.contains('active')) {
                const selectedName = item.getAttribute('data-name');
                const selectedImage = item.getAttribute('data-image');
                document.getElementById('selected-name').textContent = selectedName;
                document.getElementById('selected-image').src = selectedImage;
            }

            item.addEventListener('click', function (e) {
                e.preventDefault();

                section.querySelectorAll('.cmp4-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');

                const selectedName = this.getAttribute('data-name');
                const selectedImage = this.getAttribute('data-image');
                document.getElementById('selected-name').textContent = selectedName;
                document.getElementById('selected-image').src = selectedImage;

                const selectedSlug = this.getAttribute('data-slug');
                if (!selectedModels.includes(selectedSlug)) {
                    selectedModels.push(selectedSlug);
                }

                section.querySelector('.wcl-cmp-4-lang').classList.remove('active');
            });
        });
    }




    // filterParts
    function filterParts() {
        let section = document.querySelector('.acf-1-configurator')
        const model = section.querySelector('.data-thumbnail-slider .selected')?.getAttribute('data-slug') || '';
        const option = section.querySelector('.data-b3-item.selected')?.getAttribute('data-key') || '';
        const year = getCookie('selectedYear') || '';

        const data = new FormData();
        data.append('action', 'filter_car_parts');
        data.append('model', model);
        data.append('option', option);
        data.append('year', year);

        section.querySelector('.data-b5-list').classList.add('active')

        fetch(wcl_obj.ajax_url, {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    section.querySelector('.data-b5-list').innerHTML = data.data;
                } else {
                    section.querySelector('.data-b5-list').innerHTML = data.data
                }

                if (section.querySelector('.data-b5-list').classList.contains('active')) {
                    section.querySelector('.data-b5-list').classList.remove('active')
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    }




    // update_header_model
    function update_header_model() {
        const selectedModelSlug = getCookie('selectedModel');
        const selectedYear = getCookie('selectedYear');
        const selectedModel = getModelData(selectedModelSlug);

        document.getElementById('selected-name').textContent = selectedModel.name;
        document.getElementById('selected-image').src = wcl_obj.template_url + '/img/cars/' + selectedModel.image;
    }


    // loadImage
    function loadImage(imageElement) {
        const srcset = imageElement.getAttribute('srcset');
        const src = srcset.split(',').find(item => item.includes(window.devicePixelRatio > 1 ? '2x' : '1x')).split(' ')[0];

        const img = new Image();
        img.src = src;

        img.onload = () => {
            imageElement.src = src;
        };

        img.onerror = () => {
            console.error('Failed to load image');
        };
    }
}


