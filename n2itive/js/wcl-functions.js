/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./js/modules/acf-1-configurator.js":
/*!******************************************!*\
  !*** ./js/modules/acf-1-configurator.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_1_configurator: () => (/* binding */ init_acf_1_configurator)
/* harmony export */ });
/* harmony import */ var _helpers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers.js */ "./js/modules/helpers.js");

function init_acf_1_configurator() {
  // cmp-1-models
  if (document.querySelector('#yearSelect')) {
    var modelItems = document.querySelectorAll(".data-thumbnail-slider-item");
    var yearSelect = document.getElementById("yearSelect");
    modelItems.forEach(function (item) {
      item.addEventListener("click", function () {
        var _this = this;
        setTimeout(function () {
          var years = JSON.parse(_this.getAttribute("data-years")); //
          var selectedYear = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)("selectedYear");
          yearSelect.innerHTML = '<option value="" disabled>Select year</option>';
          years.forEach(function (year) {
            var option = document.createElement("option");
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
      var selectedYear = this.value;
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)("selectedYear", selectedYear, 7);
      filterParts();
    });
  }

  // cmp-1-models
  if (document.querySelector('.cmp-1-models')) {
    // checkSelection
    var checkSelection = function checkSelection() {
      var selectedModel = document.querySelector('.model.active');
      var selectedYear = selectedModel ? selectedModel.querySelector('.year.active') : null;
      if (!selectedModel) {
        alert('Please select a model!');
        return false;
      }
      if (!selectedYear) {
        alert('Please select a year!');
        return false;
      }
      return true;
    };
    var section = document.querySelector('.cmp-1-models');
    var popup = document.querySelector('.tesla-models');
    var models = document.querySelectorAll('.model');
    var years = document.querySelectorAll('.year');
    models.forEach(function (model) {
      model.addEventListener('click', function (e) {
        var _this2 = this;
        if (e.target.closest('.cmp1-item-info')) {
          if (!this.classList.contains('active')) {
            years.forEach(function (y) {
              return y.classList.remove('active');
            });
            years.forEach(function (element) {
              element.classList.remove('active');
            });
          }
          models.forEach(function (element) {
            element.classList.remove('active');
            if (element !== _this2) {
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
    years.forEach(function (year) {
      year.addEventListener('click', function () {
        years.forEach(function (y) {
          return y.classList.remove('active');
        });
        this.classList.add('active');
      });
    });

    // confirmButton
    document.getElementById('confirmButton').addEventListener('click', function () {
      if (checkSelection()) {
        var activeItem = document.querySelector('.cmp1-item.active');
        if (activeItem) {
          var items = Array.from(document.querySelectorAll('.cmp1-item'));
          var activeIndex = items.indexOf(activeItem);
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)('selectedModel', activeItem.dataset.slug, 7);
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)('selectedYear', activeItem.querySelector('.year.active').dataset.year, 7);
          if (activeIndex !== -1) {
            var _slides$activeIndex;
            var mainSliderElement = document.querySelector('.main-slider');
            if (mainSliderElement && mainSliderElement.swiper) {
              mainSliderElement.swiper.slideToLoop(activeIndex);
            }
            var thumbSliderElement = document.querySelector('.thumbnail-slider');
            if (thumbSliderElement && thumbSliderElement.swiper) {
              thumbSliderElement.swiper.slideTo(activeIndex);
              thumbSliderElement.swiper.activeIndex = activeIndex;
            }
            var slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');
            slides.forEach(function (slide) {
              slide.classList.remove('selected');
            });
            (_slides$activeIndex = slides[activeIndex]) === null || _slides$activeIndex === void 0 || _slides$activeIndex.classList.add('selected');
          }
        }
        update_header_model();
        if (document.querySelector('.archive.woocommerce')) {
          var cleanURL = window.location.href.split('/page')[0];
          window.location.href = wcl_obj.site_url + '/shop';
          return;
        }
        (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.close_popup)();
      }
      if (state_configurator == 2) {
        filterParts();
      }
    });
  }

  // acf-1-configurator
  if (document.querySelector('.acf-1-configurator')) {
    var _section = document.querySelector('.acf-1-configurator');
    var carImages = _section.querySelectorAll('.data-b1-car');
    carImages.forEach(function (carImg) {
      carImg.addEventListener('mouseenter', function (e) {
        carImg.querySelector('.data-b1-car-img').classList.add('active');
      });
      carImg.addEventListener('mouseleave', function (e) {
        carImg.querySelector('.data-b1-car-img').classList.remove('active');
      });
    });
    if (window.matchMedia("(max-width: 1025px)").matches) {
      document.querySelectorAll(".data-b1-note-plus").forEach(function (plusButton) {
        plusButton.addEventListener("click", function (event) {
          event.stopPropagation();
          var noteCard = plusButton.closest(".data-b1-note").querySelector(".data-b1-note-card");
          if (noteCard) {
            var clonedCard = noteCard.cloneNode(true);
            if (document.querySelector('.cloned-block')) {
              document.querySelector('.cloned-block').remove();
            }
            if (!document.querySelector('.cloned-block')) {
              clonedCard.classList.add("cloned-block");
              var closeButton = clonedCard.querySelector(".data-b1-note-card-close");
              if (closeButton) {
                closeButton.addEventListener("click", function () {
                  clonedCard.remove();
                });
              }
              document.querySelector('.mod-info-car .cmp-7-car-info').appendChild(clonedCard);
              document.querySelector('.mod-info-car').classList.add('active');
              document.querySelector('body').classList.add('overflow-hidden');
              document.querySelector('html').classList.add('overflow-hidden');
            }
          }
        });
      });
    }
    var carNote = _section.querySelectorAll('.data-b1-note');
    carNote.forEach(function (carImg) {
      carImg.addEventListener('click', function (e) {
        _section.querySelector('.data-main-slider-out').classList.add('hovered');
      });
      carImg.addEventListener('mouseenter', function (e) {
        _section.querySelector('.data-main-slider-out').classList.add('hovered');
      });
      carImg.addEventListener('mouseleave', function (e) {
        _section.querySelector('.data-main-slider-out').classList.remove('hovered');
      });
    });
    document.querySelectorAll('.data-thumbnail-slider-item').forEach(function (item) {
      item.addEventListener('click', function () {
        document.querySelectorAll('.data-thumbnail-slider-item').forEach(function (slide) {
          return slide.classList.remove('selected');
        });
        item.classList.add('selected');
        var selectedModelSlug = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)('selectedModel');
        if (!selectedModelSlug) {
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)('selectedModel', item.dataset.slug, 7);
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.updatePopupWithSelectedModelAndYear)(item.dataset.slug);
          update_header_model();
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.check_state_configurator)();
        }
      });
    });
    document.querySelectorAll('.data-b3-item').forEach(function (item) {
      item.addEventListener('click', function () {
        document.querySelectorAll('.data-b3-item').forEach(function (option) {
          return option.classList.remove('selected');
        });
        item.classList.add('selected');
        (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)('selectedCarOption', item.dataset.key, 7);
        (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.check_state_configurator)();
        if (state_configurator == 2) {
          filterParts();
        }
      });
    });
    var parentElement = document.querySelector('.data-b5-list');
    if (parentElement) {
      parentElement.addEventListener('click', function (event) {
        event.preventDefault();
        var clickedItem = event.target.closest('.data-b5-item');
        if (clickedItem) {
          clickedItem.classList.add('selected');
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.check_state_configurator)();
          var url = clickedItem.querySelector('a').getAttribute('href');
          window.open(url, '_blank');
        }
      });
    }
  }

  // acf-1-configurator
  if (document.querySelector('.acf-1-configurator')) {
    var _section2 = document.querySelector('.acf-1-configurator');
    var initialSlide = document.querySelector('.cmp-1-models').getAttribute('data-active-index');
    var _yearSelect = document.getElementById("yearSelect");
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
        init: function init() {
          var activeSlide = this.slides[this.activeIndex];
          if (activeSlide) {
            var lazyImages = activeSlide.querySelectorAll('.lazy-image');
            lazyImages.forEach(loadImage);
          }
        },
        slideChange: function slideChange() {
          var activeSlide = this.slides[this.activeIndex];
          if (activeSlide) {
            var lazyImages = activeSlide.querySelectorAll('.lazy-image');
            lazyImages.forEach(loadImage);
          }
        }
      },
      navigation: {
        nextEl: _section2.querySelector('.mod-next'),
        prevEl: _section2.querySelector('.mod-prev')
      },
      breakpoints: {
        0: {
          allowTouchMove: true,
          touchRatio: 0.2,
          speed: 550
        },
        500: {
          allowTouchMove: false,
          speed: 0
        }
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
        momentum: false
      },
      breakpoints: {
        0: {
          slidesPerView: 'auto',
          direction: 'horizontal',
          noSwiping: false,
          touchMove: true,
          simulateTouch: true,
          allowTouchMove: true,
          speed: 500
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
          speed: 0
        },
        1199: {
          direction: 'vertical',
          slidesPerView: 5,
          centeredSlides: false,
          speed: 0
        }
      }
    });
    if (window.matchMedia("(min-width: 1200px)").matches) {
      window.mainSlider.controller.control = window.thumbnailSlider;
      window.thumbnailSlider.controller.control = window.mainSlider;
    }
    var addClickHandlers = function addClickHandlers() {
      var slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');
      slides.forEach(function (slide, index) {
        slide.setAttribute('data-id', index);
        slide.addEventListener('click', function () {
          var slideId = parseInt(slide.getAttribute('data-id'), 10);
          var currentSlide = window.mainSlider.realIndex;
          console.log(slideId);
          window.mainSlider.slideTo(slideId);
          slides.forEach(function (slide) {
            return slide.classList.remove('swiper-slide-active');
          });
          if (window.matchMedia("(max-width: 1025px)").matches) {
            if (slideId === 1 && currentSlide > 0) {
              window.thumbnailSlider.setTransition(300);
              window.thumbnailSlider.setTranslate(0);
            }
          }
          if (slideId === 0) {
            filterParts();
          }
          slide.classList.add('swiper-slide-active');
        });
      });
    };
    addClickHandlers();
    window.mainSlider.on('slideChange', function () {
      var _slides$activeIndex2;
      var activeIndex = window.mainSlider.activeIndex;
      var prev = document.querySelector('.data-main-slider .swiper-slide-active');
      var prevIndex = Array.from(prev.parentNode.children).indexOf(prev);
      if (window.matchMedia("(max-width: 1025px)").matches) {
        if (activeIndex === 1 && prevIndex === 2) {
          setTimeout(function () {
            window.thumbnailSlider.setTransition(300);
            window.thumbnailSlider.setTranslate(0);
          }, 1);
        }
      }
      window.thumbnailSlider.slideTo(activeIndex);
      window.thumbnailSlider.slides.removeClass('swiper-slide-active');
      window.thumbnailSlider.slides.eq(activeIndex).addClass('swiper-slide-active');
      var slides = document.querySelectorAll('.thumbnail-slider .swiper-slide');
      slides.forEach(function (slide) {
        slide.classList.remove('selected');
      });
      (_slides$activeIndex2 = slides[activeIndex]) === null || _slides$activeIndex2 === void 0 || _slides$activeIndex2.classList.add('selected');
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.setCookie)('selectedModel', slides[activeIndex].dataset.slug, 7);
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.updatePopupWithSelectedModelAndYear)(slides[activeIndex].dataset.slug);
      update_header_model();
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.check_state_configurator)();
      filterParts();
      var years = JSON.parse(slides[activeIndex].getAttribute("data-years"));
      var selectedYear = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)("selectedYear");
      _yearSelect.innerHTML = '<option value="" disabled>Select year</option>';
      years.forEach(function (year) {
        var option = document.createElement("option");
        option.value = year;
        option.textContent = year;
        if (selectedYear && selectedYear == year) {
          option.selected = true;
        }
        _yearSelect.appendChild(option);
      });
    });
  }

  // sct-header .data-lang
  if (document.querySelector('.sct-header .data-lang')) {
    var _section3 = document.querySelector('.sct-header .data-lang');
    var selectedModels = [];
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.sct-header .data-lang')) {
        _section3.querySelector('.wcl-cmp-4-lang').classList.remove('active');
      }
    });
    _section3.addEventListener('click', function (e) {
      if (!e.target.closest('.cmp4-item')) {
        _section3.querySelector('.wcl-cmp-4-lang').classList.toggle('active');
      }
    });
    _section3.querySelectorAll('.cmp4-item').forEach(function (item) {
      if (item.classList.contains('active')) {
        var selectedName = item.getAttribute('data-name');
        var selectedImage = item.getAttribute('data-image');
        document.getElementById('selected-name').textContent = selectedName;
        document.getElementById('selected-image').src = selectedImage;
      }
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _section3.querySelectorAll('.cmp4-item').forEach(function (el) {
          return el.classList.remove('active');
        });
        this.classList.add('active');
        var selectedName = this.getAttribute('data-name');
        var selectedImage = this.getAttribute('data-image');
        document.getElementById('selected-name').textContent = selectedName;
        document.getElementById('selected-image').src = selectedImage;
        var selectedSlug = this.getAttribute('data-slug');
        if (!selectedModels.includes(selectedSlug)) {
          selectedModels.push(selectedSlug);
        }
        _section3.querySelector('.wcl-cmp-4-lang').classList.remove('active');
      });
    });
  }

  // filterParts
  function filterParts() {
    var _section$querySelecto, _section$querySelecto2;
    var section = document.querySelector('.acf-1-configurator');
    var model = ((_section$querySelecto = section.querySelector('.data-thumbnail-slider .selected')) === null || _section$querySelecto === void 0 ? void 0 : _section$querySelecto.getAttribute('data-slug')) || '';
    var option = ((_section$querySelecto2 = section.querySelector('.data-b3-item.selected')) === null || _section$querySelecto2 === void 0 ? void 0 : _section$querySelecto2.getAttribute('data-key')) || '';
    var year = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)('selectedYear') || '';
    var data = new FormData();
    data.append('action', 'filter_car_parts');
    data.append('model', model);
    data.append('option', option);
    data.append('year', year);
    section.querySelector('.data-b5-list').classList.add('active');
    fetch(wcl_obj.ajax_url, {
      method: 'POST',
      body: data
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      if (data.success) {
        section.querySelector('.data-b5-list').innerHTML = data.data;
      } else {
        section.querySelector('.data-b5-list').innerHTML = data.data;
      }
      if (section.querySelector('.data-b5-list').classList.contains('active')) {
        section.querySelector('.data-b5-list').classList.remove('active');
      }
    })["catch"](function (error) {
      console.error('Ошибка:', error);
    });
  }

  // update_header_model
  function update_header_model() {
    var selectedModelSlug = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)('selectedModel');
    var selectedYear = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getCookie)('selectedYear');
    var selectedModel = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getModelData)(selectedModelSlug);
    document.getElementById('selected-name').textContent = selectedModel.name;
    document.getElementById('selected-image').src = wcl_obj.template_url + '/img/cars/' + selectedModel.image;
  }

  // loadImage
  function loadImage(imageElement) {
    var srcset = imageElement.getAttribute('srcset');
    var src = srcset.split(',').find(function (item) {
      return item.includes(window.devicePixelRatio > 1 ? '2x' : '1x');
    }).split(' ')[0];
    var img = new Image();
    img.src = src;
    img.onload = function () {
      imageElement.src = src;
    };
    img.onerror = function () {
      console.error('Failed to load image');
    };
  }
}

/***/ }),

/***/ "./js/modules/acf-10-faq.js":
/*!**********************************!*\
  !*** ./js/modules/acf-10-faq.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_10_faq: () => (/* binding */ init_acf_10_faq)
/* harmony export */ });
function init_acf_10_faq() {
  // acf-10-faq
  if (document.querySelector('.acf-10-faq')) {
    var section = document.querySelector('.acf-10-faq');
    var faqItems = section.querySelectorAll('.data-item');
    faqItems.forEach(function (item) {
      var question = item.querySelector('.data-item-question');
      var answer = item.querySelector('.data-item-answer');
      question.addEventListener('click', function () {
        section.querySelectorAll('.data-item').forEach(function (element) {
          if (item != element) {
            element.classList.remove('active');
            element.querySelector('.data-item-answer').style.maxHeight = 0;
          }
        });
        item.classList.toggle('active');
        if (item.classList.contains('active')) {
          answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
          answer.style.maxHeight = 0;
        }
      });
    });
    var tabButtons = document.querySelectorAll('.faq-tab-button');
    var tabPanels = document.querySelectorAll('.faq-tab-panel');
    tabButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var tab = button.getAttribute('data-tab');
        tabButtons.forEach(function (btn) {
          return btn.classList.remove('active');
        });
        tabPanels.forEach(function (panel) {
          return panel.classList.remove('active');
        });
        button.classList.add('active');
        document.getElementById("tab-".concat(tab)).classList.add('active');
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/acf-11-instalation.js":
/*!******************************************!*\
  !*** ./js/modules/acf-11-instalation.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_11_instalation: () => (/* binding */ init_acf_11_instalation)
/* harmony export */ });
/* harmony import */ var _helpers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers.js */ "./js/modules/helpers.js");

function init_acf_11_instalation() {
  // Fixed on Scroll
  if (document.querySelector('.acf-11-instalation-2')) {
    var section = document.querySelector('.acf-11-instalation-2');
    var sidebar = section.querySelector('.data-sidebar');
    if (window.matchMedia("(min-width: 1199px)").matches) {
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.sidebar_scroll)(sidebar, section, scroll);
    }
    var tabButtons = section.querySelectorAll('.faq-tab-button');
    var tabPanels = section.querySelectorAll('.faq-tab-panel');
    tabButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        var tab = button.getAttribute('data-tab');
        console.log(tab);
        tabButtons.forEach(function (btn) {
          return btn.classList.remove('active');
        });
        tabPanels.forEach(function (panel) {
          return panel.classList.remove('active');
        });
        button.classList.add('active');
        document.getElementById("tab-".concat(tab)).classList.add('active');
        var offset_top = getOffsetTop(section.querySelector(' .data-col:nth-child(1)'));
        if (window.matchMedia("(min-width: 1199px)").matches) {
          (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.sidebar_scroll)(sidebar, section, false, offset_top);
        }
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/acf-12-blog.js":
/*!***********************************!*\
  !*** ./js/modules/acf-12-blog.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_12_blog: () => (/* binding */ init_acf_12_blog)
/* harmony export */ });
/* harmony import */ var _helpers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers.js */ "./js/modules/helpers.js");

function init_acf_12_blog() {
  // acf-12-blog
  if (document.querySelector('.acf-12-blog')) {
    // blog_page_load_posts
    var blog_page_load_posts = function blog_page_load_posts(page_new) {
      var page = 1;
      var category = '';
      if (page_new) {
        page = parseInt(page_new) + 1;
      }
      category = section.getAttribute('data-cat');
      var data_request = {
        action: 'blog_page_load_posts',
        page: page,
        category: category
      };
      if (section.querySelector('.data-list')) {
        section.querySelector('.data-list').classList.add('active');
      }
      load_more.querySelector('button').setAttribute('disabled', 'disabled');
      load_more.querySelector('button').classList.add('active');
      load_more.querySelector('button').textContent = 'Loading';
      var xhr = new XMLHttpRequest();
      xhr.open('POST', wcl_obj.ajax_url, true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      xhr.onload = function (data) {
        if (xhr.status >= 200 && xhr.status < 400) {
          var data = JSON.parse(xhr.responseText);
          load_more.querySelector('button').classList.remove('active');
          load_more.querySelector('button').removeAttribute('disabled');
          if (page_new) {
            section.querySelector('.data-list').insertAdjacentHTML('beforeend', data.posts);
            section.querySelector('.data-load-more').innerHTML = data.button;
          } else {
            section.querySelector('.data-list').innerHTML = data.posts;
            section.querySelector('.data-load-more').innerHTML = data.button;
          }
          if (section.querySelector('.data-list').classList.contains('active')) {
            section.querySelector('.data-list').classList.remove('active');
          }
          var offset_top = (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.getOffsetTop)(section.querySelector('.data-col:nth-child(2)'));
          if (window.matchMedia("(min-width: 1199px)").matches) {
            (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.sidebar_scroll)(sidebar, section, scroll, offset_top, section.querySelector('.data-list-out'));
          }
        }
        ;
      };
      data_request = new URLSearchParams(data_request).toString();
      xhr.send(data_request);
    };
    var section = document.querySelector('.acf-12-blog');
    var load_more = section.querySelector('.data-load-more');
    var sidebar = section.querySelector('.cmp-6-sidebar');
    if (window.matchMedia("(min-width: 1199px)").matches) {
      (0,_helpers_js__WEBPACK_IMPORTED_MODULE_0__.sidebar_scroll)(sidebar, section, scroll, '', section.querySelector('.data-list-out'));
    }

    // load_more
    if (load_more) {
      load_more.addEventListener("click", function (e) {
        e.preventDefault();
        if (e.target.classList.contains('data-load-more-btn')) {
          if (e.target.getAttribute("disable") == 'disable') {
            return false;
          }
          var self = e.target;
          var page = e.target.getAttribute("data-page");
          self.classList.add('mod-active');
          blog_page_load_posts(page);
        }
      });
    }
  }
}

/***/ }),

/***/ "./js/modules/acf-3-blog.js":
/*!**********************************!*\
  !*** ./js/modules/acf-3-blog.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_3_blog: () => (/* binding */ init_acf_3_blog)
/* harmony export */ });
function init_acf_3_blog() {
  // acf-3-blog
  if (document.querySelector('.acf-3-blog')) {
    var sections = document.querySelectorAll('.acf-3-blog');
    sections.forEach(function (section) {
      var swiper = new Swiper(section.querySelector('.data-slider'), {
        slidesPerView: 'auto',
        speed: 400,
        spaceBetween: 30,
        breakpoints: {
          0: {
            spaceBetween: 20
          },
          767: {
            spaceBetween: 30
          }
        }
      });
      swiper.on('slideChange', function () {
        swiper.el.closest('.data-slider-out').classList.remove('last-slide');
      });
      swiper.on('reachEnd', function () {
        setTimeout(function () {
          swiper.el.closest('.data-slider-out').classList.add('last-slide');
        }, 1);
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/acf-4-faq.js":
/*!*********************************!*\
  !*** ./js/modules/acf-4-faq.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_4_faq: () => (/* binding */ init_acf_4_faq)
/* harmony export */ });
function init_acf_4_faq() {
  // acf-4-faq
  if (document.querySelector('.acf-4-faq')) {
    var section = document.querySelector('.acf-4-faq');
    var faqItems = section.querySelectorAll('.data-item');
    faqItems.forEach(function (item) {
      var question = item.querySelector('.data-item-question');
      var answer = item.querySelector('.data-item-answer');
      question.addEventListener('click', function () {
        section.querySelectorAll('.data-item').forEach(function (element) {
          if (item != element) {
            element.classList.remove('active');
            element.querySelector('.data-item-answer').style.maxHeight = 0;
          }
        });
        item.classList.toggle('active');
        if (item.classList.contains('active')) {
          answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
          answer.style.maxHeight = 0;
        }
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/acf-5-gallery.js":
/*!*************************************!*\
  !*** ./js/modules/acf-5-gallery.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_5_gallery: () => (/* binding */ init_acf_5_gallery)
/* harmony export */ });
function init_acf_5_gallery() {
  // acf-5-gallery
  if (document.querySelector('.acf-5-gallery')) {
    var sections = document.querySelectorAll('.acf-5-gallery');
    Fancybox.bind("[data-fancybox='gallery']", {
      infinite: false,
      Toolbar: {
        display: ["zoom", "download", "close"]
      }
    });
    sections.forEach(function (section) {
      var swiper = new Swiper(section.querySelector('.data-slider'), {
        slidesPerView: 'auto',
        loop: true,
        speed: 400,
        spaceBetween: 30,
        centeredSlides: true,
        initialSlide: 1,
        navigation: {
          nextEl: section.querySelector('.mod-next'),
          prevEl: section.querySelector('.mod-prev')
        },
        pagination: {
          el: section.querySelector('.swiper-pagination'),
          clickable: true
        },
        breakpoints: {
          0: {
            spaceBetween: 20
          },
          767: {
            spaceBetween: 30
          }
        }
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/acf-6-testimonials.js":
/*!******************************************!*\
  !*** ./js/modules/acf-6-testimonials.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_acf_6_testimonials: () => (/* binding */ init_acf_6_testimonials)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function init_acf_6_testimonials() {
  // acf-6-testimonials
  if (document.querySelector('.acf-6-testimonials')) {
    var sections = document.querySelectorAll('.acf-6-testimonials');
    sections.forEach(function (section) {
      var swiper = new Swiper(section.querySelector('.data-slider'), _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty({
        slidesPerView: 2,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false
        },
        speed: 400,
        spaceBetween: 98
      }, "speed", 600), "autoHeight", true), "navigation", {
        nextEl: section.querySelector('.mod-next'),
        prevEl: section.querySelector('.mod-prev')
      }), "pagination", {
        el: section.querySelector('.swiper-pagination'),
        clickable: true
      }), "breakpoints", {
        0: {
          slidesPerView: 1,
          spaceBetween: 30
        },
        767: {
          spaceBetween: 60,
          slidesPerView: 1
        },
        1200: {
          slidesPerView: 2,
          spaceBetween: 98
        },
        1600: {
          spaceBetween: 98
        }
      }));
    });
  }
}

/***/ }),

/***/ "./js/modules/helpers.js":
/*!*******************************!*\
  !*** ./js/modules/helpers.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   check_state_configurator: () => (/* binding */ check_state_configurator),
/* harmony export */   close_popup: () => (/* binding */ close_popup),
/* harmony export */   getCookie: () => (/* binding */ getCookie),
/* harmony export */   getModelData: () => (/* binding */ getModelData),
/* harmony export */   getOffsetTop: () => (/* binding */ getOffsetTop),
/* harmony export */   setCookie: () => (/* binding */ setCookie),
/* harmony export */   sidebar_scroll: () => (/* binding */ sidebar_scroll),
/* harmony export */   updatePopupWithSelectedModelAndYear: () => (/* binding */ updatePopupWithSelectedModelAndYear)
/* harmony export */ });
// getOffsetTop
function getOffsetTop(element) {
  var offsetTop = 0;
  while (element) {
    offsetTop += element.offsetTop;
    element = element.offsetParent;
  }
  return offsetTop;
}

// sidebar_scroll
function sidebar_scroll(sidebar, section) {
  var scroll = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  var sidebar_offset = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
  var content_item = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : '';
  var offsetTop = getOffsetTop(sidebar);
  if (sidebar_offset) {
    offsetTop = sidebar_offset;
  }
  var sidebar_top = offsetTop;
  var content = '';
  if (content_item == '') {
    content = section.querySelector('.data-tabs');
  } else {
    content = content_item;
  }
  var sidebar_bot = offsetTop + content.clientHeight;
  sidebar_bot = sidebar_bot - sidebar.clientHeight;
  var sidebar_bot_2 = content.clientHeight - sidebar.clientHeight;
  if (sidebar_bot_2 < 0) {
    sidebar_bot_2 = 0;
  }
  var scrolled = window.scrollY;
  if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
    sidebar.classList.add('active');
    sidebar.classList.remove('active-2');
    sidebar.style.top = '15px';
  } else {
    if (scrolled >= sidebar_top - 15) {
      sidebar.classList.remove('active');
      sidebar.classList.add('active-2');
      sidebar.style.top = sidebar_bot_2 + 'px';
    } else {
      sidebar.classList.remove('active');
      sidebar.style.top = '0';
    }
  }
  if (scroll) {
    window.addEventListener('scroll', function (e) {
      sidebar_bot = offsetTop + content.clientHeight;
      sidebar_bot = sidebar_bot - sidebar.clientHeight;
      sidebar_bot_2 = content.clientHeight - sidebar.clientHeight;
      if (sidebar_bot_2 < 0) {
        sidebar_bot_2 = 0;
      }
      var scrolled = window.scrollY;
      if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
        sidebar.classList.add('active');
        sidebar.classList.remove('active-2');
        sidebar.style.top = '15px';
      } else {
        if (scrolled >= sidebar_top - 15) {
          sidebar.classList.remove('active');
          sidebar.classList.add('active-2');
          sidebar.style.top = sidebar_bot_2 + 'px';
        } else {
          sidebar.classList.remove('active');
          sidebar.style.top = '0';
        }
      }
    });
  }
}

// getModelData
function getModelData(slug) {
  return window.teslaModels.find(function (model) {
    return model.slug === slug;
  });
}

// updatePopupWithSelectedModelAndYear
function updatePopupWithSelectedModelAndYear() {
  var selectedModelSlug = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  var selectedYear = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
  var resetToCurrent = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  var selectedModel = getModelData(selectedModelSlug);
  var section = document.querySelector('.cmp-1-models');
  if (resetToCurrent) {
    var _selectedModelSlug = getCookie('selectedModel');
    var _selectedYear = getCookie('selectedYear');
    var _selectedModel = getModelData(_selectedModelSlug);
    if (_selectedModelSlug && _selectedYear) {
      if (_selectedModel) {
        section.querySelectorAll('.model').forEach(function (model) {
          model.classList.remove('active');
          model.classList.remove('open');
          if (model.dataset.slug === _selectedModel.slug) {
            model.classList.add('active');
          }
        });
        section.querySelectorAll('.year').forEach(function (yearBtn) {
          yearBtn.classList.remove('active');
        });
        var yearBtn = section.querySelector(".model.active .year-selection [data-year=\"" + _selectedYear + "\"]");
        if (yearBtn) {
          yearBtn.classList.add('active');
        }
      }
    }
  }
  if (selectedModel) {
    document.querySelectorAll('.model').forEach(function (model) {
      model.classList.remove('active');
      model.classList.remove('open');
      if (model.dataset.slug === selectedModel.slug) {
        model.classList.add('active');
      }
    });
    var modelYears = selectedModel.years || [];
    section.querySelectorAll('.year').forEach(function (yearBtn) {
      yearBtn.classList.remove('active');
    });
    var yearSelectionBlock = document.querySelector(".model.active .year-selection");
    if (yearSelectionBlock) {
      if (!selectedYear) {
        selectedYear = getCookie("selectedYear-".concat(selectedModelSlug)) || modelYears[0];
      }
      yearSelectionBlock.querySelectorAll('.year').forEach(function (yearBtn) {
        if (yearBtn.dataset.year === selectedYear) {
          yearBtn.classList.add('active');
        }
      });
      setCookie('selectedYear', selectedYear, 7);
    }
  }
}

// close_popup
function close_popup() {
  var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
  if (document.querySelector('.sct-header').querySelector('.data-nav').classList.contains('active')) {
    document.querySelector('.sct-header').classList.remove('active');
    document.querySelector('.sct-header').querySelector('.data-nav').classList.remove('active');
  }
  document.querySelector('.cmp-4-popup .cmp4-close img').click();
  updatePopupWithSelectedModelAndYear('', '', true);
  if (event.target && event.target.closest('.js-popup-open') && document.querySelector('.cmp-4-popup.active')) {
    var first = document.querySelector('.cmp-4-popup.active');
    var target_popup_id = event.target.closest('.js-popup-open').getAttribute('data-target');
    var second = document.querySelector('[data-id="' + target_popup_id + '"]');
    document.querySelector('.cmp-4-popup.active').classList.remove('active');
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
function check_state_configurator() {
  if (document.querySelector('.acf-1-configurator')) {
    var section = document.querySelector('.acf-1-configurator');
    if (window.state_1) {
      if (section.querySelector('.data-thumbnail-slider .selected')) {
        if (section.querySelector('.data-b4.mod-one').classList.contains('state-active')) {
          section.querySelector('.data-b4.mod-one').classList.remove('state-active');
          section.querySelector('.data-b4.mod-one').classList.add('active');
        }
        window.state_2 = true;
        if (window.matchMedia("(max-width: 1025px)").matches) {
          if (section.querySelector('.data-b3.mod-mobile').classList.contains('state-disabled')) {
            section.querySelector('.data-b3.mod-mobile').classList.remove('state-disabled');
          }
        } else {
          var mobileNodes = section.querySelectorAll('.data-b3:not(.mod-mobile)');
          if (mobileNodes[0].classList.contains('state-disabled')) {
            mobileNodes[0].classList.remove('state-disabled');
          }
        }
      } else {
        if (section.querySelector('.data-b4.mod-one')) {
          section.querySelector('.data-b4.mod-one').classList.add('state-active');
        }
      }
    }
    if (window.state_2) {
      var b3_item = '';
      if (window.matchMedia("(max-width: 1025px)").matches) {
        b3_item = section.querySelector('.data-b3.mod-mobile');
      } else {
        var _mobileNodes = section.querySelectorAll('.data-b3:not(.mod-mobile)');
        b3_item = _mobileNodes[0];
      }
      if (b3_item.querySelector('.data-b3-item.selected')) {
        if (b3_item.querySelector('.data-b4.mod-two').classList.contains('state-active')) {
          b3_item.querySelector('.data-b4.mod-two').classList.remove('state-active');
          b3_item.querySelector('.data-b4.mod-two').classList.add('active');
        }
        window.state_configurator = 2;
        window.state_3 = true;
        if (section.querySelector('.data-b5').classList.contains('state-disabled')) {
          section.querySelector('.data-b5').classList.remove('state-disabled');
        }
      } else {
        if (b3_item.querySelector('.data-b4.mod-two')) {
          b3_item.querySelector('.data-b4.mod-two').classList.add('state-active');
        }
      }
    }
    if (window.state_3) {
      if (section.querySelector('.data-b5-item.selected')) {
        if (section.querySelector('.data-b4.mod-three').classList.contains('state-active')) {
          section.querySelector('.data-b4.mod-three').classList.remove('state-active');
          section.querySelector('.data-b4.mod-three').classList.add('active');
        }
      } else {
        if (section.querySelector('.data-b4.mod-three')) {
          section.querySelector('.data-b4.mod-three').classList.add('state-active');
        }
      }
    }
  }
}

// setCookie
function setCookie(name, value, days) {
  var d = new Date();
  d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// getCookie
function getCookie(name) {
  var nameEq = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i].trim();
    if (c.indexOf(nameEq) === 0) {
      return c.substring(nameEq.length, c.length);
    }
  }
  return "";
}

/***/ }),

/***/ "./js/modules/popup.js":
/*!*****************************!*\
  !*** ./js/modules/popup.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_popup: () => (/* binding */ init_popup)
/* harmony export */ });
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helpers */ "./js/modules/helpers.js");

function init_popup() {
  // js-popup-open
  if (document.querySelector('.js-popup-open')) {
    var section = document.querySelector('.js-popup-open');
    if (document.querySelector('.cmp-4-popup')) {
      var items = document.querySelectorAll('.js-popup-open');
      items.forEach(function (element) {
        element.addEventListener('click', function (e) {
          e.preventDefault();
          var target_popup_id = this.getAttribute('data-target');
          var target_popup = document.querySelector('[data-id="' + target_popup_id + '"]');
          if (target_popup.classList.contains('active')) {
            target_popup.classList.remove('active');
            document.querySelector('body').classList.remove('overflow-hidden');
            document.querySelector('html').classList.remove('overflow-hidden');
            document.querySelectorAll('.cmp-4-popup').forEach(function (element) {
              element.classList.add('mod-transit');
            });
            setTimeout(function () {
              document.querySelectorAll('.cmp-4-popup.mod-transit').forEach(function (element) {
                element.classList.remove('mod-transit');
              });
            }, 1);
            return;
          }
          if (target_popup) {
            if (document.querySelector('.sct-header').querySelector('.data-nav').classList.contains('active')) {
              document.querySelector('.sct-header').classList.remove('active');
              document.querySelector('.sct-header').querySelector('.data-nav').classList.remove('active');
            }
            setTimeout(function () {
              target_popup.classList.add('active');
              document.querySelector('body').classList.add('overflow-hidden');
              document.querySelector('html').classList.add('overflow-hidden');
            }, 1);
          }
        });
      });
    }
  }

  // // cmp-3-shipping-calculator
  if (document.querySelector('.cmp-3-shipping-calculator')) {
    var _section = document.querySelector('.cmp-3-shipping-calculator');
    _section.addEventListener('click', function (e) {
      if (e.target.closest('button[type="submit"]')) {
        if (document.querySelector('.cmp-4-popup.active')) {
          document.querySelector('.cmp-4-popup.active').classList.remove('active');
          document.querySelector('body').classList.remove('overflow-hidden');
          document.querySelector('html').classList.remove('overflow-hidden');
        }
      }
    });
  }

  // // cmp-4-popup
  if (document.querySelector('.cmp-4-popup')) {
    var _items = document.querySelectorAll('.cmp-4-popup');
    document.addEventListener('click', function (event) {
      var click = false;
      if (!event.target.closest('.cmp-4-popup') && !event.target.closest('.select2-container') && document.querySelector('.cmp-4-popup.active')) {
        click = true;
        if (event.target.closest('.js-popup-open')) {
          var first = document.querySelector('.cmp-4-popup.active');
          var target_popup_id = event.target.closest('.js-popup-open').getAttribute('data-target');
          var second = document.querySelector('[data-id="' + target_popup_id + '"]');
          document.querySelector('.cmp-4-popup.active').classList.remove('active');
          if (first == second) {
            document.querySelector('body').classList.remove('overflow-hidden');
            document.querySelector('html').classList.remove('overflow-hidden');
          }
        } else {
          document.querySelector('.cmp-4-popup.active').classList.remove('active');
          document.querySelector('body').classList.remove('overflow-hidden');
          document.querySelector('html').classList.remove('overflow-hidden');
        }
      }
    });
    _items.forEach(function (element) {
      element.querySelectorAll('.js-close').forEach(function (close) {
        close.addEventListener('click', function (e) {
          element.classList.remove('active');
          (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.close_popup)(e);
        });
      });
      element.querySelector('.cmp4-overlay').addEventListener('click', function (e) {
        element.classList.remove('active');
        (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.close_popup)(e);
      });
      element.querySelector('.cmp4-inner-out').addEventListener('click', function (e) {
        if (!e.target.closest('.cmp4-inner')) {
          element.classList.remove('active');
          (0,_helpers__WEBPACK_IMPORTED_MODULE_0__.close_popup)(e);
        }
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/single-product.js":
/*!**************************************!*\
  !*** ./js/modules/single-product.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_single_product: () => (/* binding */ init_single_product)
/* harmony export */ });
function init_single_product() {
  var offset_top = 0;
  if (document.querySelector('body.single-product')) {
    // sct-single-product-info
    if (document.querySelector('.sct-single-product-info')) {
      var thumbSliderEl = document.querySelector('.thumb-slider'); // Единственный thumb-slider

      var thumbSlider = new Swiper(thumbSliderEl, {
        loop: false,
        slidesPerView: 5,
        spaceBetween: 15
      });
      document.querySelectorAll('.sct-single-product-info .main-slider').forEach(function (mainSliderEl) {
        var mainSlider = new Swiper(mainSliderEl, {
          loop: false,
          navigation: {
            nextEl: mainSliderEl.querySelector('.mod-next'),
            prevEl: mainSliderEl.querySelector('.mod-prev')
          }
        });
        if (mainSliderEl.classList.contains('mod-one')) {
          // Функция смены изображения по variation_id
          var showVariationImage = function showVariationImage(variation_id) {
            if (window.matchMedia("(min-width: 1199px)").matches) {
              var targetSlide = mainSliderEl.querySelector(".swiper-slide[data-variation-id=\"".concat(variation_id, "\"]"));
              if (targetSlide) {
                var index = Array.from(targetSlide.parentElement.children).indexOf(targetSlide);
                mainSlider.slideTo(index);
              }
            } else {
              var _targetSlide = document.querySelector(".main-slider.mod-two .swiper-slide[data-variation-id=\"".concat(variation_id, "\"]"));
              if (_targetSlide) {
                var _index = Array.from(_targetSlide.parentElement.children).indexOf(_targetSlide);
                document.querySelector(".main-slider.mod-two").swiper.slideTo(_index);
              }
            }
          };
          // Только mod-one управляет thumb-slider
          mainSlider.on('slideChange', function () {
            thumbSlider.slideTo(mainSlider.activeIndex);
          });

          // Клик по thumb-slider двигает только main-slider.mod-one
          thumbSliderEl.querySelectorAll('.swiper-slide').forEach(function (thumb, index) {
            thumb.addEventListener('click', function () {
              mainSlider.slideTo(index);
            });
          });
          jQuery('form.variations_form').on('found_variation', function (event, variation) {
            if (variation && variation.variation_id) {
              showVariationImage(variation.variation_id);
            }
          });
          jQuery('form.variations_form').on('reset_data', function () {
            showVariationImage(0);
          });
        }
      });
    }
  }
  if (document.querySelector('body.single-product')) {
    document.addEventListener('DOMContentLoaded', function () {
      var customResetButton = document.getElementById('custom-reset-button');
      if (customResetButton) {
        customResetButton.addEventListener('click', function () {
          var resetButton = document.querySelector('.reset_variations');
          if (resetButton) {
            resetButton.click();
          }
        });
      }
    });
    jQuery(document).ready(function ($) {
      var quantityValue = $('#quantity-value');
      var woocommerceQuantityInput = $('.woocommerce .quantity .qty');
      var addToCartButton = $('.single_add_to_cart_button');
      var currentQuantity = parseInt(quantityValue.text(), 10);
      $('.minus-btn').click(function () {
        if (currentQuantity > 1) {
          currentQuantity--;
          quantityValue.text(currentQuantity);
          woocommerceQuantityInput.val(currentQuantity);
        }
      });
      $('.plus-btn').click(function () {
        currentQuantity++;
        quantityValue.text(currentQuantity);
        woocommerceQuantityInput.val(currentQuantity);
      });
      $('.data-add-to-cart .cmp-button.mod-red').click(function (e) {
        e.preventDefault();
        addToCartButton.trigger('click');
      });
    });
  }
  if (document.querySelector('body.single-product')) {
    jQuery(document).ready(function ($) {
      $('.data-variation-item').on('click', function () {
        if ($(this).hasClass('unavailable')) {
          return;
        }
        document.querySelector('.variations_form').classList.add('active');
        var variationId = $(this).data('variation-id');
        var variationName = $(this).data('variation-name');
        $('input.variation_id').val(variationId).trigger('change');
        var select = $('#finish');
        var options = select.find('option');
        options.each(function () {
          if ($(this).text() === variationName) {
            select.val($(this).val()).trigger('change');
          }
        });
        $('.data-variation-item').removeClass('selected');
        $(this).addClass('selected');
        setTimeout(function () {
          offset_top = getOffsetTop(document.querySelector('.single-product .woocommerce-tabs .data-col:first-child'));
        }, 250);
      });
    });
  }

  // getOffsetTop
  function getOffsetTop(element) {
    var offsetTop = 0;
    while (element) {
      offsetTop += element.offsetTop;
      element = element.offsetParent;
    }
    return offsetTop;
  }

  // wcl-acf-block-12
  function sidebar_scroll(sidebar, section) {
    var scroll = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
    var sidebar_offset = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '';
    var content_item = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : '';
    offset_top = getOffsetTop(sidebar);
    if (sidebar_offset) {
      offset_top = sidebar_offset;
    }
    console.log(offset_top);
    var sidebar_top = offset_top;
    var content = '';
    if (content_item == '') {
      content = section.querySelector('.data-tabs');
    } else {
      content = content_item;
    }
    var sidebar_bot = offset_top + content.clientHeight;
    sidebar_bot = sidebar_bot - sidebar.clientHeight;
    var sidebar_bot_2 = content.clientHeight - sidebar.clientHeight;
    if (sidebar_bot_2 < 0) {
      sidebar_bot_2 = 0;
    }
    var scrolled = window.scrollY;
    console.log(scrolled);
    if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
      sidebar.classList.add('active');
      sidebar.classList.remove('active-2');
      sidebar.style.top = '15px';
    } else {
      if (scrolled >= sidebar_top - 15) {
        sidebar.classList.remove('active');
        sidebar.classList.add('active-2');
        sidebar.style.top = sidebar_bot_2 + 'px';
      } else {
        sidebar.classList.remove('active');
        sidebar.style.top = '0';
      }
    }
    if (scroll) {
      window.addEventListener('scroll', function (e) {
        //   offset_top = getoffset_top(sidebar);

        sidebar_top = offset_top;
        sidebar_bot = offset_top + content.clientHeight;
        sidebar_bot = sidebar_bot - sidebar.clientHeight;
        sidebar_bot_2 = content.clientHeight - sidebar.clientHeight;
        if (sidebar_bot_2 < 0) {
          sidebar_bot_2 = 0;
        }
        var scrolled = window.scrollY;
        if (scrolled >= sidebar_top - 15 && scrolled <= sidebar_bot - 15) {
          sidebar.classList.add('active');
          sidebar.classList.remove('active-2');
          sidebar.style.top = '15px';
        } else {
          if (scrolled >= sidebar_top - 15) {
            sidebar.classList.remove('active');
            sidebar.classList.add('active-2');
            sidebar.style.top = sidebar_bot_2 + 'px';
          } else {
            sidebar.classList.remove('active');
            sidebar.style.top = '0';
          }
        }
      });
    }
  }

  // Fixed on Scroll
  if (document.querySelector('.single-product .woocommerce-tabs .data-sidebar')) {
    var sidebar = document.querySelector('.single-product .woocommerce-tabs .data-sidebar');
    var section = document.querySelector('.single-product div.product .woocommerce-tabs');
    if (window.matchMedia("(min-width: 1200px)").matches) {
      sidebar_scroll(sidebar, section, true, '', section.querySelector('.data-col:nth-child(2)'));
    }
    document.querySelectorAll('.single-product div.product .woocommerce-tabs ul.tabs li').forEach(function (element) {
      element.addEventListener('click', function (e) {
        setTimeout(function () {
          var offset_top = getOffsetTop(section.querySelector('.data-col:nth-child(1)'));
          if (window.matchMedia("(min-width: 1200px)").matches) {
            sidebar_scroll(sidebar, section, false, offset_top, section.querySelector('.data-col:nth-child(2)'));
          }
        }, 1);
      });
    });
  }
}

/***/ }),

/***/ "./js/modules/woocommerce-cart.js":
/*!****************************************!*\
  !*** ./js/modules/woocommerce-cart.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_woocommerce_cart: () => (/* binding */ init_woocommerce_cart)
/* harmony export */ });
function init_woocommerce_cart() {
  // cmp-2-cart
  if (document.querySelector('.cmp-2-cart')) {
    var section = document.querySelector('.cmp-2-cart');
    document.body.addEventListener('click', function (event) {
      if (event.target.closest('.remove-item')) {
        event.preventDefault();
        var item = event.target.closest('.data-item');
        item.classList.add('active');
        var cartItemKey = item.dataset.cartItemKey;
        var cartItemElement = item;
        fetch(wcl_obj.ajax_url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            action: 'custom_remove_cart_item',
            cart_item_key: cartItemKey
          })
        }).then(function (response) {
          return response.json();
        }).then(function (data) {
          if (data.success) {
            cartItemElement.remove();
            var subtotalValueElement = document.querySelector('.data-subtotal .woocommerce-Price-amount.amount bdi');
            if (subtotalValueElement) {
              subtotalValueElement.innerHTML = data.data.new_subtotal;
            }
            var cartItemCountElement = document.querySelector('.sct-header .data-cart-count');
            if (cartItemCountElement) {
              if (data.data.cart_item_count > 0) {
                cartItemCountElement.textContent = data.data.cart_item_count;
              } else {
                cartItemCountElement.remove();
              }
            }
            var updateCartButton = document.querySelector('[name="update_cart"]');
            console.log(updateCartButton);
            if (updateCartButton) {
              updateCartButton.click();
              jQuery(function ($) {
                $(document.body).trigger('wc_update_cart');
              });
            }
          } else {
            alert('Failed to remove item from cart');
          }
        })["catch"](function (error) {
          console.error('Error:', error);
        });
      }
    });
  }
}

/***/ }),

/***/ "./js/modules/woocommerce.js":
/*!***********************************!*\
  !*** ./js/modules/woocommerce.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   init_woocommerce: () => (/* binding */ init_woocommerce)
/* harmony export */ });
function init_woocommerce() {
  var updateCartTimeout;
  document.body.addEventListener('click', function (event) {
    if (event.target && event.target.closest('.minus-btn')) {
      var quantityInput = event.target.closest('.data-quantity').querySelector('input');
      if (quantityInput) {
        var currentQuantity = parseInt(quantityInput.value, 10);
        if (currentQuantity > 1) {
          currentQuantity--;
          quantityInput.value = currentQuantity;
          handleCartUpdate(quantityInput);
        }
      }
    }
  });
  document.body.addEventListener('click', function (event) {
    if (event.target && event.target.closest('.plus-btn')) {
      var quantityInput = event.target.closest('.data-quantity').querySelector('input');
      if (quantityInput) {
        var currentQuantity = parseInt(quantityInput.value, 10);
        currentQuantity++;
        quantityInput.value = currentQuantity;
        handleCartUpdate(quantityInput);
      }
    }
  });
  function handleCartUpdate(quantityInput) {
    clearTimeout(updateCartTimeout);
    updateCartTimeout = setTimeout(function () {
      updateCart(quantityInput);
    }, 500);
  }
  function triggerChangeEvent(element) {
    var event = new Event('change', {
      bubbles: true,
      cancelable: true
    });
    element.dispatchEvent(event);
  }
  function updateCart(quantityInput) {
    console.log('Обновляем корзину с количеством:', quantityInput.value);
    var mainQuantity = quantityInput.closest('.product-quantity').querySelector('.qty');
    var quantity = quantityInput.value;
    mainQuantity.value = quantity;
    triggerChangeEvent(mainQuantity);
    var updateCartButton = document.querySelector('[name="update_cart"]');
    if (updateCartButton) {
      updateCartButton.click();
    }
  }
  if (document.querySelector('.woocommerce-page')) {
    var section = document.querySelector('.woocommerce-page');
    document.addEventListener('change', function (e) {
      if (e.target.matches('input[type="radio"]')) {
        e.target.closest('form').querySelectorAll('input[type="radio"]').forEach(function (radio) {
          var label = radio.closest('label');
          if (radio.checked) {
            label === null || label === void 0 || label.classList.add('active');
          } else {
            label === null || label === void 0 || label.classList.remove('active');
          }
        });
      }
      if (e.target.matches('input[type="checkbox"]')) {
        var label = e.target.closest('label');
        if (e.target.checked) {
          label === null || label === void 0 || label.classList.add('active');
        } else {
          label === null || label === void 0 || label.classList.remove('active');
        }
      }
    });
    section.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(function (element) {
      if (element.matches('input[type="radio"]')) {
        element.closest('form').querySelectorAll('input[type="radio"]').forEach(function (element_2) {
          if (element_2.checked) {
            if (element_2.closest('label')) {
              element_2.closest('label').classList.add('active');
            }
          } else {
            if (element_2.closest('label')) {
              element_2.closest('label').classList.remove('active');
            }
          }
        });
      } else {
        if (element.checked) {
          if (element.closest('label')) {
            element.closest('label').classList.add('active');
          }
        } else {
          if (element.closest('label')) {
            element.closest('label').classList.remove('active');
          }
        }
      }
    });
  }

  // woocommerce-checkout
  if (document.querySelector('.woocommerce-checkout')) {
    var _section = document.querySelector('.woocommerce-checkout');
    var coupon_elem = _section.querySelector('.data-coupone input[name="coupon_code"]');
    var coupone_block = _section.querySelector('.data-coupone');
    if (_section.querySelector('.data-coupone')) {
      var container = _section;
      container.addEventListener('click', function (event) {
        var target = event.target;

        // Проверяем, что клик произошёл по чекбоксу
        if (target.matches('.promo-checkbox')) {
          var couponeBlock = container.querySelector('.data-coupone');
          var couponElem = document.querySelector('.data-coupone input[name="coupon_state"]');
          if (coupone_block.querySelector('.data-coupone-note')) {
            coupone_block.querySelector('.data-coupone-note').remove();
          }
          if (target.checked) {
            couponeBlock.classList.add('active');
            if (couponElem) {
              couponElem.setAttribute('required', '');
            }
          } else {
            couponeBlock.classList.remove('active');
            if (couponElem) {
              couponElem.removeAttribute('required');
            }
          }
        }
      });
      _section.querySelector('.wcl-cmp-button-2').addEventListener("click", function (e) {
        e.preventDefault();
        var coupon_code = coupone_block.querySelector('[name="coupon_code"]').value;
        var data_request = {
          action: 'order_coupone_apply',
          coupon_code: coupon_code
        };
        if (coupone_block.querySelector('.data-coupone-note')) {
          coupone_block.querySelector('.data-coupone-note').remove();
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', wcl_obj.ajax_url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.onload = function (data) {
          if (xhr.status >= 200 && xhr.status < 400) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            jQuery(document.body).trigger('update_checkout');
            if (data.message) {
              var class_ = '';
              if (data.success) {
                class_ = 'mod-success';
              } else {
                class_ = 'mod-error';
              }
              var tag = '<div class="data-coupone-note ' + class_ + '">' + data.message + '</div>';
              coupone_block.querySelector('.data-coupone-inner').insertAdjacentHTML('beforeend', tag);
              if (data.success) {
                document.querySelector('.woocommerce-checkout .woocommerce-checkout').classList.add('mod-coupon');
                var $subtotalRow = jQuery('.woocommerce-checkout-review-order-table .cart-subtotal').last();
                $subtotalRow.after(data.new_row_html);
              }
            }
          }
          ;
        };
        data_request = new URLSearchParams(data_request).toString();
        xhr.send(data_request);
      });
    }
  }

  // cmp-2-cart
  if (document.querySelector('.cmp-2-cart')) {
    var _section2 = document.querySelector('.cmp-2-cart');
    document.body.addEventListener('click', function (event) {
      if (event.target.closest('.remove-item')) {
        event.preventDefault();
        var item = event.target.closest('.data-item');
        item.classList.add('active');
        var cartItemKey = item.dataset.cartItemKey;
        var cartItemElement = item;
        fetch(wcl_obj.ajax_url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            action: 'custom_remove_cart_item',
            cart_item_key: cartItemKey
          })
        }).then(function (response) {
          return response.json();
        }).then(function (data) {
          if (data.success) {
            cartItemElement.remove();
            var subtotalValueElement = document.querySelector('.data-subtotal .woocommerce-Price-amount.amount bdi');
            if (subtotalValueElement) {
              subtotalValueElement.innerHTML = data.data.new_subtotal;
            }
            var cartItemCountElement = document.querySelector('.sct-header .data-cart-count');
            if (cartItemCountElement) {
              if (data.data.cart_item_count > 0) {
                cartItemCountElement.textContent = data.data.cart_item_count;
              } else {
                cartItemCountElement.remove();
              }
            }
          } else {
            alert('Failed to remove item from cart');
          }
        })["catch"](function (error) {
          console.error('Error:', error);
        });
      }
    });
  }
}

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!********************!*\
  !*** ./js/main.js ***!
  \********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_helpers_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/helpers.js */ "./js/modules/helpers.js");
/* harmony import */ var _modules_acf_1_configurator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/acf-1-configurator */ "./js/modules/acf-1-configurator.js");
/* harmony import */ var _modules_acf_3_blog_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/acf-3-blog.js */ "./js/modules/acf-3-blog.js");
/* harmony import */ var _modules_acf_4_faq_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/acf-4-faq.js */ "./js/modules/acf-4-faq.js");
/* harmony import */ var _modules_acf_5_gallery_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/acf-5-gallery.js */ "./js/modules/acf-5-gallery.js");
/* harmony import */ var _modules_acf_6_testimonials__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/acf-6-testimonials */ "./js/modules/acf-6-testimonials.js");
/* harmony import */ var _modules_popup__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./modules/popup */ "./js/modules/popup.js");
/* harmony import */ var _modules_single_product_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./modules/single-product.js */ "./js/modules/single-product.js");
/* harmony import */ var _modules_woocommerce_cart_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./modules/woocommerce-cart.js */ "./js/modules/woocommerce-cart.js");
/* harmony import */ var _modules_woocommerce_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./modules/woocommerce.js */ "./js/modules/woocommerce.js");
/* harmony import */ var _modules_acf_10_faq_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./modules/acf-10-faq.js */ "./js/modules/acf-10-faq.js");
/* harmony import */ var _modules_acf_11_instalation_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./modules/acf-11-instalation.js */ "./js/modules/acf-11-instalation.js");
/* harmony import */ var _modules_acf_12_blog_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./modules/acf-12-blog.js */ "./js/modules/acf-12-blog.js");














var ready = function ready(callback) {
  if (document.readyState != "loading") callback();else document.addEventListener("DOMContentLoaded", callback);
};
ready(function () {
  /*
  * Prevent CF7 form duplication emails
  */
  var cf7_forms_submit = document.querySelectorAll('.wpcf7-form .wpcf7-submit');
  if (cf7_forms_submit) {
    cf7_forms_submit.forEach(function (element) {
      element.addEventListener('click', function (e) {
        var form = element.closest('.wpcf7-form');
        if (form.classList.contains('submitting')) {
          e.preventDefault();
        }
      });
    });
  }

  /* SCRIPTS GO HERE */

  window.teslaModels = JSON.parse(document.querySelector('.tesla-models').getAttribute('data-tesla-models'));
  window.state_configurator = false;
  window.state_1 = true;
  window.state_2 = false;
  window.state_3 = false;
  window.mainSlider;
  window.thumbnailSlider;
  (0,_modules_helpers_js__WEBPACK_IMPORTED_MODULE_0__.check_state_configurator)();
  (0,_modules_acf_1_configurator__WEBPACK_IMPORTED_MODULE_1__.init_acf_1_configurator)();
  (0,_modules_acf_4_faq_js__WEBPACK_IMPORTED_MODULE_3__.init_acf_4_faq)();
  (0,_modules_acf_5_gallery_js__WEBPACK_IMPORTED_MODULE_4__.init_acf_5_gallery)();
  (0,_modules_acf_6_testimonials__WEBPACK_IMPORTED_MODULE_5__.init_acf_6_testimonials)();
  (0,_modules_acf_3_blog_js__WEBPACK_IMPORTED_MODULE_2__.init_acf_3_blog)();
  (0,_modules_popup__WEBPACK_IMPORTED_MODULE_6__.init_popup)();
  (0,_modules_single_product_js__WEBPACK_IMPORTED_MODULE_7__.init_single_product)();
  (0,_modules_woocommerce_cart_js__WEBPACK_IMPORTED_MODULE_8__.init_woocommerce_cart)();
  (0,_modules_woocommerce_js__WEBPACK_IMPORTED_MODULE_9__.init_woocommerce)();
  (0,_modules_acf_10_faq_js__WEBPACK_IMPORTED_MODULE_10__.init_acf_10_faq)();
  (0,_modules_acf_11_instalation_js__WEBPACK_IMPORTED_MODULE_11__.init_acf_11_instalation)();
  (0,_modules_acf_12_blog_js__WEBPACK_IMPORTED_MODULE_12__.init_acf_12_blog)();

  // Fixed on Scroll
  if (document.querySelector('.single-post .data-sidebar')) {
    var section = document.querySelector('.single-post .sct-single');
    var sidebar = document.querySelector('.single-post .data-sidebar');
    if (window.matchMedia("(min-width: 1199px)").matches) {
      (0,_modules_helpers_js__WEBPACK_IMPORTED_MODULE_0__.sidebar_scroll)(sidebar, section, true, '', section.querySelector('.data-content'));
    }
  }

  // single-product div.product .woocommerce-tabsacf-10-faq
  if (document.querySelector('.single-product div.product .woocommerce-tabs')) {
    var updateClasses = function updateClasses() {
      var isAtStart = tabs.scrollLeft === 0;
      var isAtEnd = tabs.scrollLeft + tabs.clientWidth >= tabs.scrollWidth - 1;
      tabs.parentElement.classList.toggle("mod-left", isAtStart);
      tabs.parentElement.classList.toggle("mod-right", isAtEnd);
    };
    var _section = document.querySelector('.single-product div.product .woocommerce-tabs');
    var tabs = document.querySelector(".woocommerce div.product .woocommerce-tabs ul.tabs");
    if (!tabs) return;
    updateClasses();
    tabs.addEventListener("scroll", updateClasses);
  }

  // acf-11-instalation-2
  if (document.querySelector('.acf-11-instalation-2')) {
    var _updateClasses = function _updateClasses() {
      var isAtStart = _tabs.scrollLeft === 0;
      var isAtEnd = _tabs.scrollLeft + _tabs.clientWidth >= _tabs.scrollWidth - 1;
      _tabs.parentElement.classList.toggle("mod-left", isAtStart);
      _tabs.parentElement.classList.toggle("mod-right", isAtEnd);
    };
    var _section2 = document.querySelector('.acf-11-instalation-2');
    var _tabs = _section2.querySelector(".data-cats");
    if (!_tabs) return;
    _updateClasses();
    _tabs.addEventListener("scroll", _updateClasses);
  }

  // acf-10-faq
  if (document.querySelector('.acf-10-faq')) {
    var _updateClasses2 = function _updateClasses2() {
      var isAtStart = _tabs2.scrollLeft === 0;
      var isAtEnd = _tabs2.scrollLeft + _tabs2.clientWidth >= _tabs2.scrollWidth - 1;
      _tabs2.parentElement.classList.toggle("mod-left", isAtStart);
      _tabs2.parentElement.classList.toggle("mod-right", isAtEnd);
    };
    var _section3 = document.querySelector('.acf-10-faq');
    var _tabs2 = _section3.querySelector(".data-cats");
    if (!_tabs2) return;
    _updateClasses2();
    _tabs2.addEventListener("scroll", _updateClasses2);
  }

  // Fixed on Scroll
  if (document.querySelector('.data-btn-menu')) {
    document.querySelectorAll('.data-btn-menu').forEach(function (element) {
      element.addEventListener('click', function (e) {
        if (document.querySelector('.sct-header').classList.contains('active')) {
          //   this.classList.remove('active')
          document.querySelector('.sct-header').classList.remove('active');
          document.querySelector('body, html').classList.remove('overflow-hidden');
        } else {
          //   this.classList.add('active')
          document.querySelector('.sct-header').classList.add('active');
          document.querySelector('body, html').classList.add('overflow-hidden');
        }
      });
    });
  }
});
jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
  var cartCount = fragments['div.widget_shopping_cart_content'].split('<span class=\"quantity\">');
  var TotalCount = 0;
  for (var index = 1; index < cartCount.length; index++) {
    var item = cartCount[index];
    var ItemCount = item.split(' &times;')[0];
    TotalCount += parseInt(ItemCount);
  }
  var $cart = jQuery('.sct-header .data-cart');
  var $cartCount = $cart.find('.data-cart-count');
  if ($cartCount.length === 0) {
    jQuery('<span class="data-cart-count">' + TotalCount + '</span>').appendTo($cart.find('.data-cart-inner'));
  } else {
    $cartCount.text(TotalCount);
  }
});
jQuery(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
  jQuery.ajax({
    url: wcl_obj.ajax_url,
    type: 'POST',
    data: {
      action: 'update_cart_popup',
      cart_hash: cart_hash
    },
    success: function success(response) {
      if (response.success) {
        jQuery('.cmp-2-cart.custom-popup').html(response.data.cart_html);
        var totalCount = response.data.cart_count;
        jQuery('.sct-header .data-cart-count').text(totalCount);
      }
    },
    error: function error() {
      console.log('Error updating the cart');
    }
  });
});
jQuery(document).ready(function ($) {
  $(document.body).on('updated_cart_totals', function () {
    var totalQuantity = 0;
    $('.woocommerce .quantity .qty').each(function () {
      totalQuantity += parseInt($(this).val(), 10);
    });
    if (totalQuantity > 0) {
      $('.sct-cart .js-b1-title').text('You Have ' + totalQuantity + ' Items In Your Cart');
    } else {
      $('.sct-cart .js-b1-title').text('Your Cart is Empty');
    }
    var cartItemCountElement = $('.sct-header .data-cart-count');
    if (cartItemCountElement.length > 0) {
      if (totalQuantity > 0) {
        cartItemCountElement.text(totalQuantity);
      } else {
        cartItemCountElement.remove();
      }
    }
  });
});
jQuery(document).ready(function ($) {
  function checkEmptyCart() {
    var cartItems = $('.woocommerce-cart-form__cart-item.cart_item');
    if (cartItems.length === 0) {
      var cartIcon = $('.sct-header .data-cart-count');
      if (cartIcon.length > 0) {
        cartIcon.remove();
      }
    }
  }
  $(document.body).on('updated_cart_totals removed_from_cart', function () {
    checkEmptyCart();
    var checkInterval = setInterval(function () {
      checkEmptyCart();
    }, 100);
  });

  // Отлавливаем завершение обновления корзины
  $(document.body).on('updated_wc_div', function () {
    jQuery.ajax({
      url: wcl_obj.ajax_url,
      type: 'POST',
      data: {
        action: 'update_cart_popup'
      },
      success: function success(response) {
        if (response.success) {
          jQuery('.cmp-2-cart.custom-popup').html(response.data.cart_html);
          var totalCount = response.data.cart_count;
          jQuery('.sct-header .data-cart-count').text(totalCount);
        }
      },
      error: function error() {
        console.log('Error updating the cart');
      }
    });
  });
});
jQuery(document.body).on('checkout_error', function () {
  jQuery('html, body').stop();
});
jQuery(document).ajaxComplete(function () {
  if (jQuery('body').hasClass('woocommerce-cart')) {
    jQuery('html, body').stop();
  }
});
jQuery(document).on('click', '.woocommerce .remove', function (e) {
  e.preventDefault();
  var parentItem = jQuery(e.target).closest('.woocommerce-cart-form__cart-item ');
  console.log(parentItem);
  parentItem.find('a.remove')[0].click();
});
jQuery(document).ready(function ($) {
  // Проверяем, есть ли элементы в списке отзывов
  if ($('.commentlist .review').length === 0) {
    // Если нет отзывов, убираем margin у контейнера с отзывами
    $('#reviews').css('margin', '0');
  }
});
document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.generate-pdf')) {
    document.querySelectorAll('.generate-pdf').forEach(function (button) {
      button.addEventListener('click', function (e) {
        var _document$querySelect;
        e.preventDefault();
        var jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF();

        // Установка шрифта и стиля
        doc.setFont('helvetica', 'bold').setFontSize(24);

        // Извлечение текста
        var titleText = ((_document$querySelect = document.querySelector('.acf-11-instalation .data-b2-title')) === null || _document$querySelect === void 0 ? void 0 : _document$querySelect.textContent.trim()) || '';

        // Опции страницы
        var pageWidth = doc.internal.pageSize.width;
        var margin = 20;

        // Вывод текста в центр страницы
        doc.text(titleText, pageWidth / 2, 20, {
          align: 'center',
          maxWidth: pageWidth - 2 * margin
        });
        var startY = 30;
        var table = document.querySelector('.data-b2-table');
        doc.autoTable({
          html: table,
          startY: startY,
          styles: {
            fontSize: 14,
            cellPadding: 6,
            lineHeight: 1.55,
            textColor: [255, 255, 255],
            fillColor: [0, 0, 0]
          },
          headStyles: {
            fillColor: [233, 168, 38],
            textColor: [0, 0, 0],
            fontStyle: 'bold',
            fontSize: 18,
            lineWidth: 0.15,
            lineColor: [255, 255, 255]
          },
          bodyStyles: {
            fillColor: [0, 0, 0],
            textColor: [255, 255, 255],
            fontSize: 14
          },
          alternateRowStyles: {
            fillColor: [40, 40, 40]
          },
          columnStyles: {
            0: {
              cellWidth: 'auto'
            },
            1: {
              cellWidth: 'auto'
            }
          },
          didDrawCell: function didDrawCell(data) {
            if (data.row.index === data.table.body.length - 1) {
              doc.setLineWidth(0);
            }
          }
        });
        doc.save('table_specs.pdf');
      });
    });
  }
});
jQuery(document).ready(function ($) {
  var submitButton = $('.woocommerce #review_form #respond .form-submit input');
  var fileInput = $('#cr_review_image');
  var uploadCheckInterval;
  function checkUploadStatus() {
    var allImages = $('.cr-upload-images-containers ');
    var uploadedImages = allImages.filter('.cr-upload-ok');

    // console.log(uploadedImages)

    if (allImages.length > 0 && allImages.length === uploadedImages.length) {
      submitButton.prop('disabled', false);
    } else {
      submitButton.prop('disabled', true);
    }
    if (document.querySelector('.cr-upload-images-status-error')) {
      submitButton.prop('disabled', false);
    }
  }
  fileInput.on('change', function () {
    uploadCheckInterval = setInterval(checkUploadStatus, 1000);
    submitButton.prop('disabled', true);
  });
  $('#review_form').on('submit', function (e) {
    var allImages = $('.cr-upload-images-containers .cr-upload-images-container');
    var uploadedImages = allImages.filter('.cr-upload-ok');
    if (allImages.length > 0 && allImages.length !== uploadedImages.length) {
      e.preventDefault();
      alert('Please wait until all images have finished loading before submitting the form..');
    }
  });
});
})();

/******/ })()
;