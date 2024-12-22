/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./js/modules/components/copyToClipboard.js":
/*!**************************************************!*\
  !*** ./js/modules/components/copyToClipboard.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initializeCopyButtons: () => (/* binding */ initializeCopyButtons)
/* harmony export */ });
// copyToClipboard.js

// Функция для копирования текста в буфер обмена
function copyToClipboard(text) {
  var dummy = document.createElement("textarea");
  document.body.appendChild(dummy);
  dummy.value = text;
  dummy.select();
  document.execCommand("copy");
  document.body.removeChild(dummy);
}

// Основная логика для управления уведомлениями
function initializeCopyButtons() {
  var timeouts = {}; // Объект для хранения таймаутов

  document.addEventListener('click', function (event) {
    var button = event.target.closest('.data-b2-item-ca-btn');
    if (button && !event.target.closest('.data-b2-item-ca-copy-notify')) {
      var item = button.parentElement;
      var notify = item.querySelector('.data-b2-item-ca-copy-notify');
      var dataMint = item.querySelector('.data-b2-item-ca-field').getAttribute('data-mint');
      copyToClipboard(dataMint);

      // Переключаем класс 'active'
      notify.classList.toggle('active');

      // Очистка предыдущего таймаута для этого уведомления
      if (timeouts[dataMint]) {
        clearTimeout(timeouts[dataMint]);
      }

      // Устанавливаем новый таймаут для скрытия уведомления
      timeouts[dataMint] = setTimeout(function () {
        if (notify.classList.contains('active')) {
          notify.classList.remove('active');
        }
        delete timeouts[dataMint]; // Удаляем таймаут после его выполнения
      }, 900);
    } else {
      // Удаляем класс 'active' у всех активных уведомлений, если клик был вне элемента с кнопкой
      document.querySelectorAll('.data-b2-item-ca-copy-notify.active').forEach(function (notify) {
        var dataMint = notify.parentElement.previousElementSibling.getAttribute('data-mint');
        if (timeouts[dataMint]) {
          clearTimeout(timeouts[dataMint]); // Очищаем таймаут, если он есть
          delete timeouts[dataMint]; // Удаляем таймаут из объекта
        }
        notify.classList.remove('active');
      });
    }
  });
}

// Основная логика для управления уведомлениями
function initializeCopyButtons_2() {
  var timeouts = {}; // Объект для хранения таймаутов

  document.addEventListener('click', function (event) {
    // Ищем кнопку по общему классу
    var button = event.target.closest('.data-ca-btn');
    if (button && !event.target.closest('.data-ca-copy-notify')) {
      var item = button.parentElement;
      var notify = item.querySelector('.data-ca-copy-notify'); // Общий класс для всех уведомлений
      var dataMint = item.querySelector('.data-ca-field').getAttribute('data-mint'); // Общий класс для поля с data-mint

      copyToClipboard(dataMint); // Функция копирования в буфер обмена

      // Переключаем класс 'active'
      notify.classList.add('active');

      // Очистка предыдущего таймаута для этого уведомления
      if (timeouts[dataMint]) {
        clearTimeout(timeouts[dataMint]);
      }

      // Устанавливаем новый таймаут для скрытия уведомления
      timeouts[dataMint] = setTimeout(function () {
        if (notify.classList.contains('active')) {
          notify.classList.remove('active');
        }
        delete timeouts[dataMint]; // Удаляем таймаут после его выполнения
      }, 900);
    } else {
      // Удаляем класс 'active' у всех активных уведомлений, если клик был вне элемента с кнопкой
      document.querySelectorAll('.data-ca-copy-notify.active').forEach(function (notify) {
        var dataMint = notify.closest('.data-ca-item').querySelector('.data-ca-field').getAttribute('data-mint');
        if (timeouts[dataMint]) {
          clearTimeout(timeouts[dataMint]); // Очищаем таймаут, если он есть
          delete timeouts[dataMint]; // Удаляем таймаут из объекта
        }
        notify.classList.remove('active');
      });
    }
  });
}
document.addEventListener('DOMContentLoaded', function () {
  initializeCopyButtons_2();
});

// Экспортируем функцию инициализации


/***/ }),

/***/ "./js/modules/components/sound.js":
/*!****************************************!*\
  !*** ./js/modules/components/sound.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   checkAndPlaySoundForTable: () => (/* binding */ checkAndPlaySoundForTable),
/* harmony export */   toggleSound: () => (/* binding */ toggleSound),
/* harmony export */   updateIcon: () => (/* binding */ updateIcon)
/* harmony export */ });
// // sound.js
// import { setCookie, getCookie } from './cookies';

// Функция для установки куки
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Функция для получения куки
function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}
var soundStatus = {
  dex_paid: getCookie('dex_paid_sound') === 'true' ? true : getCookie('dex_paid_sound') ? false : true,
  live_stream: getCookie('live_stream_sound') === 'true' ? true : getCookie('live_stream_sound') ? false : true,
  big_buys: false
};
function toggleSound(tableClass) {
  soundStatus[tableClass] = !soundStatus[tableClass]; // Переключаем статус
  saveSoundStatus(tableClass); // Сохраняем в куки
  updateIcon(tableClass); // Обновляем иконки
}
function saveSoundStatus(tableClass) {
  setCookie("".concat(tableClass, "_sound"), soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
}
function updateIcon(tableClass) {
  var icons = document.querySelectorAll(".".concat(tableClass, " .data-b1-icon"));
  icons.forEach(function (icon) {
    if (soundStatus[tableClass]) {
      icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-up.svg");
      icon.classList.add('mod-enable');
      icon.classList.remove('mod-disable');
    } else {
      icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-off.svg");
      icon.classList.remove('mod-enable');
      icon.classList.add('mod-disable');
    }
  });
}
function checkAndPlaySoundForTable(tableClass) {
  if (soundStatus[tableClass]) {
    playSoundForTable(tableClass);
  }
}
function playSoundForTable(tableClass) {
  var soundFileUrl = '';
  if (tableClass == 'dex_paid') {
    soundFileUrl = wcl_obj.sound_for_dex_paid;
  } else if (tableClass == 'live_stream') {
    soundFileUrl = wcl_obj.sound_for_livestream;
  }
  var audio = new Audio(soundFileUrl);
  audio.volume = 0.1;
  audio.play();
}

/***/ }),

/***/ "./js/modules/components/tableManager.js":
/*!***********************************************!*\
  !*** ./js/modules/components/tableManager.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BigBuysRow: () => (/* binding */ BigBuysRow),
/* harmony export */   DexPaidRow: () => (/* binding */ DexPaidRow),
/* harmony export */   LiveStreamRow: () => (/* binding */ LiveStreamRow),
/* harmony export */   TableManager: () => (/* binding */ TableManager),
/* harmony export */   TableRowBase: () => (/* binding */ TableRowBase)
/* harmony export */ });
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/* 
TableRowBase
 */
var TableRowBase = /*#__PURE__*/function () {
  function TableRowBase(data, templateUrl) {
    var tableType = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'default';
    _classCallCheck(this, TableRowBase);
    this.data = {
      name: data.name || 'N/A',
      mint: data.mint || 'N/A',
      usd_market_cap: data.usd_market_cap || 'N/A',
      symbol: data.symbol || 'N/A',
      sol_amount: data.sol_amount || 'N/A',
      image_uri: data.image_uri || 'N/A',
      tabletka: data.tabletka || '',
      twitter: data.twitter || '',
      telegram: data.telegram || '',
      website: data.website || '',
      market_cap: data.market_cap || 'N/A',
      holders_count: data.holders_count || 'N/A',
      reply_count: data.reply_count || 'N/A',
      created_timestamp: data.created_timestamp || 'N/A',
      buy_link_1: data.buy_link_1 || '',
      buy_link_2: data.buy_link_2 || '',
      buy_link_3: data.buy_link_3 || '',
      buy_link_4: data.buy_link_4 || '',
      market_cap_usd: data.market_cap_usd || 'N/A'
    };
    this.templateUrl = templateUrl, this.tableType = tableType;
  }
  return _createClass(TableRowBase, [{
    key: "formatValue",
    value: function formatValue(value) {
      return value !== 'N/A' ? value : 'N/A';
    }
  }, {
    key: "getMarketCapHtmlBigBuys",
    value: function getMarketCapHtmlBigBuys() {
      var marketCap = parseFloat(this.data.usd_market_cap);
      if (!isNaN(marketCap)) {
        // Round the market cap to 2 decimal places
        var roundedNumber = marketCap.toFixed(0);

        // Format the number with commas
        var formattedNumber = parseFloat(roundedNumber).toLocaleString('en-US', {
          minimumFractionDigits: 0
        }).replace(/,/g, ' ');

        // Build the HTML string
        var string = "$".concat(formattedNumber);

        // Return the HTML
        return "\n\t\t\t\t\t".concat(string, "\n\t\t\t");
      }
      return '';
    }
  }, {
    key: "formatSolAmount",
    value: function formatSolAmount() {
      var withSign = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var solAmount = parseFloat(this.data.sol_amount);
      if (!isNaN(solAmount)) {
        // Divide by 1,000,000,000
        var formattedAmount = (solAmount / 1000000000).toFixed(2);
        return "".concat(withSign ? '+' : '').concat(formattedAmount);
      }
      return '';
    }
  }, {
    key: "formatMint",
    value: function formatMint() {
      return this.data.mint.length > 8 ? "".concat(this.data.mint.slice(0, 4), "...").concat(this.data.mint.slice(-4)) : this.data.mint;
    }
  }, {
    key: "getTabletkaLink",
    value: function getTabletkaLink() {
      var mint = this.data.mint;
      if (mint) {
        var link = "https://pump.fun/".concat(mint);
        return link;
      }
      return '';
    }
  }, {
    key: "createSocialLinks",
    value: function createSocialLinks() {
      var _this = this;
      var socialLinks = [{
        link: this.getTabletkaLink(),
        image: 'social-tabletka.png',
        key: 'tabletka'
      }, {
        link: this.data.twitter,
        image: 'social-twitter.png',
        key: 'twitter'
      }, {
        link: this.data.telegram,
        image: 'social-telegram.png',
        key: 'telegram'
      }, {
        link: this.data.website,
        image: 'social-website.png',
        key: 'website'
      }];
      return socialLinks.map(function (_ref) {
        var link = _ref.link,
          image = _ref.image,
          key = _ref.key;
        var state = link ? 'mod-enabled' : 'mod-disabled';
        return "\n\t\t\t\t<div class=\"data-b2-item-social-item mod-".concat(key, " ").concat(state, "\">\n\t\t\t\t\t<a href=\"").concat(link ? link : '#', "\" target=\"_blank\" rel=\"noopener noreferrer\">\n\t\t\t\t\t\t<img src=\"").concat(_this.templateUrl, "/img/").concat(image, "\" alt=\"").concat(key, "\">\n\t\t\t\t\t</a>\n\t\t\t\t</div>\n\t\t\t");
      }).join('');
    }
  }, {
    key: "formatSolAmountBigBuys",
    value: function formatSolAmountBigBuys() {
      var solPrice = parseFloat(wcl_obj.current_sol_price); // Получаем цену SOL из локализованного объекта
      var solAmount = parseFloat(this.data.sol_amount); // Преобразуем solAmount в число

      if (!isNaN(solAmount) && !isNaN(solPrice)) {
        var usdValue = solAmount / 1000000000 * solPrice; // Вычисляем значение в долларах
        var valueDividedByThousand = usdValue;

        // Округляем значение до целого числа
        var roundedValue = Math.round(valueDividedByThousand);

        // Форматируем значение с запятыми (если необходимо)
        var formattedWithCommas = new Intl.NumberFormat('en-US').format(roundedValue);

        // Возвращаем отформатированное значение с суффиксом 'k', если значение больше 0
        return "".concat(formattedWithCommas);
      }
      return null; // Возвращаем null, если есть ошибка
    }
  }, {
    key: "formatMarketCap",
    value: function formatMarketCap() {
      var marketCap = parseFloat(this.data.usd_market_cap);
      if (this.tableType == 'DexPaid') {
        marketCap = parseFloat(this.data.market_cap_usd);
      }
      if (!isNaN(marketCap)) {
        return "$".concat(marketCap.toFixed(0).replace(/\d(?=(?:\d{3})+(?!\d))/g, '$&,').replace(/,/g, ' '));
      }
      return 'N/A';
    }
  }, {
    key: "formatHoldersCount",
    value: function formatHoldersCount() {
      return this.formatValue(this.data.holders_count);
    }
  }, {
    key: "formatReplyCount",
    value: function formatReplyCount() {
      return this.formatValue(this.data.reply_count);
    }
  }, {
    key: "formatCreatedTimestamp",
    value: function formatCreatedTimestamp() {
      var timestampInMs = this.data.created_timestamp; // Предполагается, что метка времени в миллисекундах
      var timestampInSeconds = timestampInMs / 1000; // Преобразуем в секунды

      var currentTimeInSeconds = Math.floor(Date.now() / 1000); // Текущее время в секундах
      var differenceInSeconds = currentTimeInSeconds - timestampInSeconds; // Разница во времени

      // Если разница меньше 60 секунд, возвращаем "<1 min ago"
      if (differenceInSeconds < 60) {
        return "<1 min ago";
      }
      var hours = Math.floor(differenceInSeconds / 3600); // Вычисляем часы
      var minutes = Math.floor(differenceInSeconds % 3600 / 60); // Вычисляем минуты

      // Форматируем результат
      var formatted = '';
      if (hours > 0) {
        formatted += "".concat(hours, " h ");
      }
      if (minutes > 0) {
        formatted += "".concat(minutes, " min ");
      }
      return formatted.trim() + ' ago';
    }

    // Method to generate HTML for buy links
  }, {
    key: "createBuyLinks",
    value: function createBuyLinks() {
      var _this2 = this;
      var buyLinksData = [{
        link: 'https://bullx.io/terminal?chainId=1399811149&address=' + this.data.mint + '&r=K0AUT6R77CH',
        image: 'buy-links-1.png'
      }, {
        link: 'https://t.me/paris_trojanbot?start=r-coinshill_up-' + this.data.mint,
        image: 'buy-links-2.png'
      }, {
        link: 'https://photon-sol.tinyastro.io/en/r/@pumpblack/' + this.data.mint,
        image: 'buy-links-3.png'
      }, {
        link: 'https://gmgn.ai/sol/token/SHQbIEUlt_' + this.data.mint,
        image: 'buy-links-4.png'
      }];
      return buyLinksData.map(function (item) {
        var state = item.link ? 'mod-enabled' : 'mod-disabled';
        return "\n\t\t\t\t<div class=\"data-b2-item-buy-links-item ".concat(state, "\">\n\t\t\t\t\t<a href=\"").concat(item.link, "\" target=\"_blank\">\n\t\t\t\t\t\t<img src=\"").concat(_this2.templateUrl, "/img/").concat(item.image, "\" alt=\"img\">\n\t\t\t\t\t</a>\n\t\t\t\t</div>\n\t\t\t");
      }).join('');
    }
  }]);
}();
var BigBuysRow = /*#__PURE__*/function (_TableRowBase) {
  function BigBuysRow() {
    _classCallCheck(this, BigBuysRow);
    return _callSuper(this, BigBuysRow, arguments);
  }
  _inherits(BigBuysRow, _TableRowBase);
  return _createClass(BigBuysRow, [{
    key: "createMobileView",
    value: function createMobileView() {
      return "\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-image\">\n\t\t\t\t\t".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-name\">\n\t\t\t\t\t").concat(this.formatValue(this.data.name), "\n\t\t\t\t</div>\n\t\t\t\t<div class=\"data-b2-item-sol mod-flex-center\">\n\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/solana-sol-logo.svg\" alt=\"img\">\n\t\t\t\t\t").concat(this.formatSolAmount(), "\n\t\t\t\t</div>\n\t\t\t\t<div class=\"data-b2-item-marketcap\">\n\t\t\t\t\t").concat(this.getMarketCapHtmlBigBuys(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-holders mod-flex-center\">\n\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/profile.svg\" alt=\"img\">\n\t\t\t\t\t").concat(this.formatHoldersCount(), "\n\t\t\t\t</div>\n\t\t\t\t<div class=\"data-b2-item-launch mod-flex-center\">\n\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/chat.svg\" alt=\"img\">\n\t\t\t\t\t").concat(this.formatReplyCount(), "\n\t\t\t\t</div>\n\t\t\t\t<div class=\"data-b2-item-launch\">\n\t\t\t\t\t").concat(this.formatCreatedTimestamp(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-social\">\n\t\t\t\t\t").concat(this.createSocialLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-buy-links\">\n\t\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t");
    }
  }, {
    key: "createDesktopView",
    value: function createDesktopView() {
      return "\n\t\t\t<td><div class=\"data-b2-item-image\">".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.name), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.symbol), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-usd mod-flex-center\"><img src=\"").concat(this.templateUrl, "/img/dollar-money-sign.svg\" alt=\"img\">").concat(this.formatSolAmountBigBuys(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-sol mod-flex-center\"><img src=\"").concat(this.templateUrl, "/img/solana-sol-logo.svg\" alt=\"img\">").concat(this.formatSolAmount(), "</div></td>\n\t\t\t<td>\n\t\t\t\t<div class=\"data-b2-item-ca\">\n\t\t\t\t\t<div class=\"data-b2-item-ca-field\" data-mint=\"").concat(this.data.mint, "\">").concat(this.formatMint(), "</div>\n\t\t\t\t\t<div class=\"data-b2-item-ca-btn\">\n\t\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/copy.svg\" alt=\"img\">\n\t\t\t\t\t\t<div class=\"data-b2-item-ca-copy-notify\">Copied</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</td>\n\t\t\t<td><div class=\"data-b2-item-social\">").concat(this.createSocialLinks(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-marketcap\">").concat(this.getMarketCapHtmlBigBuys(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-holders mod-flex-center\"><img src=\"").concat(this.templateUrl, "/img/profile.svg\" alt=\"img\">").concat(this.formatHoldersCount(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-launch mod-flex-center\"><img src=\"").concat(this.templateUrl, "/img/chat.svg\" alt=\"img\">").concat(this.formatReplyCount(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-launch\">").concat(this.formatCreatedTimestamp(), "</div></td>\n\t\t\t<td>\n\t\t\t  <div class=\"data-b2-item-buy-links\">\n\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t</div>\n\t\t</td>\n\t\t");
    }
  }]);
}(TableRowBase);
var DexPaidRow = /*#__PURE__*/function (_TableRowBase2) {
  function DexPaidRow() {
    _classCallCheck(this, DexPaidRow);
    return _callSuper(this, DexPaidRow, arguments);
  }
  _inherits(DexPaidRow, _TableRowBase2);
  return _createClass(DexPaidRow, [{
    key: "createMobileView",
    value: function createMobileView() {
      return "\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-image\">\n\t\t\t\t\t".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-name\">\n\t\t\t\t\t").concat(this.formatValue(this.data.name), "\n\t\t\t\t</div>\n\t\t\t\t\n\t\t\t\t<div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.symbol), "</div>\n\n\t\t\t\t<div class=\"data-b2-item-marketcap\">\n\t\t\t\t\t").concat(this.formatMarketCap(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t <div class=\"data-b2-item-ca\">\n\t\t\t\t\t<div class=\"data-b2-item-ca-field\" data-mint=\"").concat(this.data.mint, "\">").concat(this.formatMint(), "</div>\n\t\t\t\t\t<div class=\"data-b2-item-ca-btn\">\n\t\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/copy.svg\" alt=\"img\">\n\t\t\t\t\t\t<div class=\"data-b2-item-ca-copy-notify\">Copied</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-social\">\n\t\t\t\t\t").concat(this.createSocialLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-buy-links\">\n\t\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t");
    }
  }, {
    key: "createDesktopView",
    value: function createDesktopView() {
      return "\n\t\t\t<td><div class=\"data-b2-item-image\">".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.name), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.symbol), "</div></td>\n\t\t\t<td>\n\t\t\t\t<div class=\"data-b2-item-ca\">\n\t\t\t\t\t<div class=\"data-b2-item-ca-field\" data-mint=\"").concat(this.data.mint, "\">").concat(this.formatMint(), "</div>\n\t\t\t\t\t<div class=\"data-b2-item-ca-btn\">\n\t\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/copy.svg\" alt=\"img\">\n\t\t\t\t\t\t<div class=\"data-b2-item-ca-copy-notify\">Copied</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</td>\n\t\t\t<td><div class=\"data-b2-item-social\">").concat(this.createSocialLinks(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-marketcap\">").concat(this.formatMarketCap(), "</div></td>\n\t\t\t<td>\n\t\t\t  <div class=\"data-b2-item-buy-links\">\n\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t</div>\n\t\t\t</td>\n\t\t");
    }
  }]);
}(TableRowBase);
var LiveStreamRow = /*#__PURE__*/function (_TableRowBase3) {
  function LiveStreamRow() {
    _classCallCheck(this, LiveStreamRow);
    return _callSuper(this, LiveStreamRow, arguments);
  }
  _inherits(LiveStreamRow, _TableRowBase3);
  return _createClass(LiveStreamRow, [{
    key: "createMobileView",
    value: function createMobileView() {
      if (parseFloat(this.data.usd_market_cap) < 6000) {
        return '';
      }
      return "\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-image\">\n\t\t\t\t\t".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-name\">\n\t\t\t\t\t").concat(this.formatValue(this.data.name), "\n\t\t\t\t</div>\n\t\t\t\t\n\t\t\t\t<div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.symbol), "</div>\n\n\t\t\t\t<div class=\"data-b2-item-marketcap\">\n\t\t\t\t\t").concat(this.formatMarketCap(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t <div class=\"data-b2-item-ca\">\n\t\t\t\t\t<div class=\"data-b2-item-ca-field\" data-mint=\"").concat(this.data.mint, "\">").concat(this.formatMint(), "</div>\n\t\t\t\t\t<div class=\"data-b2-item-ca-btn\">\n\t\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/copy.svg\" alt=\"img\">\n\t\t\t\t\t\t<div class=\"data-b2-item-ca-copy-notify\">Copied</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t<div class=\"data-b3-row\">\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-social\">\n\t\t\t\t\t").concat(this.createSocialLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<div class=\"data-b3-col\">\n\t\t\t\t<div class=\"data-b2-item-buy-links\">\n\t\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t");
    }
  }, {
    key: "createDesktopView",
    value: function createDesktopView() {
      if (parseFloat(this.data.usd_market_cap) < 6000) {
        return '';
      }
      return "\n\t\t\t<td><div class=\"data-b2-item-image\">".concat(this.data.image_uri !== 'N/A' ? "<img src=\"".concat(this.data.image_uri, "\" alt=\"img\">") : 'No image available', "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.name), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-name\">").concat(this.formatValue(this.data.symbol), "</div></td>\n\t\t\t<td>\n\t\t\t\t<div class=\"data-b2-item-ca\">\n\t\t\t\t\t<div class=\"data-b2-item-ca-field\" data-mint=\"").concat(this.data.mint, "\">").concat(this.formatMint(), "</div>\n\t\t\t\t\t<div class=\"data-b2-item-ca-btn\">\n\t\t\t\t\t\t<img src=\"").concat(this.templateUrl, "/img/copy.svg\" alt=\"img\">\n\t\t\t\t\t\t<div class=\"data-b2-item-ca-copy-notify\">Copied</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</td>\n\t\t\t<td><div class=\"data-b2-item-social\">").concat(this.createSocialLinks(), "</div></td>\n\t\t\t<td><div class=\"data-b2-item-marketcap\">").concat(this.formatMarketCap(), "</div></td>\n\t\t\t<td>\n\t\t\t  <div class=\"data-b2-item-buy-links\">\n\t\t\t\t").concat(this.createBuyLinks(), "\n\t\t\t</div>\n\t\t\t</td>\n\t\t");
    }
  }]);
}(TableRowBase);
/* 
TableManager
 */
var TableManager = /*#__PURE__*/function () {
  function TableManager(tableType, templateUrl, rowType) {
    _classCallCheck(this, TableManager);
    this.tableType = tableType;
    this.isMobile = this.checkIfMobile(); // Determine if the device is mobile
    this.tableSelector = this.getTableSelector(tableType); // Get correct table selector
    this.table = document.querySelector(this.tableSelector); // Set the table based on the selector
    this.templateUrl = templateUrl;
    this.maxRows = this.getMaxRows(tableType); // Set maxRows dynamically
    this.rowType = rowType; // Тип строки (например, BigBuysRow, DexPaidRow)

    this.isPaused = false; // Переменная для отслеживания паузы
    this.buffer = []; // Буфер для хранения данных во время паузы
    this.maxBufferSize = 10; // Максимальный размер буфера
  }

  // Method to check if the device is mobile
  return _createClass(TableManager, [{
    key: "checkIfMobile",
    value: function checkIfMobile() {
      return window.innerWidth <= 1025; // Adjust the width as per your requirement
    }

    // Method to get the correct table selector based on table type and device type
  }, {
    key: "getTableSelector",
    value: function getTableSelector(tableType) {
      var selectors = {
        BigBuys: {
          desktop: '.sct-1-featured-fields.mod-big-buys .data-b2-table.mod-desktop-table tbody',
          mobile: '.sct-1-featured-fields.mod-big-buys .mod-mobile-table'
        },
        DexPaid: {
          desktop: '.sct-1-featured-fields.mod-dex-paid .data-b2-table.mod-desktop-table tbody',
          mobile: '.sct-1-featured-fields.mod-dex-paid .mod-mobile-table'
        },
        LiveStream: {
          desktop: '.sct-1-featured-fields.mod-new-livestream .data-b2-table.mod-desktop-table tbody',
          mobile: '.sct-1-featured-fields.mod-new-livestream .mod-mobile-table'
        }
      };

      // Return the appropriate selector based on the device type
      return this.isMobile ? selectors[tableType].mobile : selectors[tableType].desktop;
    }

    // Method to get maxRows based on table type and device type
  }, {
    key: "getMaxRows",
    value: function getMaxRows(tableType) {
      var maxRowsConfig = wcl_obj.tablesMaxRows; // Используем переданные данные

      // Return maxRows based on the table type and device type
      return this.isMobile ? maxRowsConfig[tableType].mobile : maxRowsConfig[tableType].desktop;
    }

    // Метод для паузы и возобновления добавления строк
  }, {
    key: "togglePause",
    value: function togglePause() {
      var _this3 = this;
      this.isPaused = !this.isPaused;
      if (!this.isPaused && this.buffer.length > 0) {
        // Если пауза отключена и есть данные в буфере, добавляем их в таблицу
        this.buffer.forEach(function (token) {
          return _this3.addRow(token);
        });
        this.buffer = []; // Очищаем буфер после добавления
      }
    }
  }, {
    key: "loadImageWithTimeout",
    value: function loadImageWithTimeout(imageElement, placeholderSrc) {
      var timeout = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 2000;
      var originalSrc = imageElement.getAttribute('src');

      // Создаем новый объект изображения
      var img = new Image();

      // Таймер для отслеживания загрузки
      var timer = setTimeout(function () {
        // Если изображение не загрузилось за 2 секунды, заменяем его на плейсхолдер
        imageElement.setAttribute('src', placeholderSrc);
        img.src = ''; // Остановить загрузку
      }, timeout);

      // Попытка загрузить изображение
      img.onload = function () {
        clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
        imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
      };
      img.onerror = function () {
        clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
        imageElement.setAttribute('src', placeholderSrc);
      };

      // Начинаем загрузку
      img.src = originalSrc;
    }
  }, {
    key: "addRow",
    value: function addRow(data) {
      var _this4 = this;
      if (this.isPaused) {
        if (this.buffer.length < this.maxBufferSize) {
          this.buffer.push(data);
        }
      } else {
        if (!this.table) {
          return;
        }
        var rowGenerator = new this.rowType(data, this.templateUrl, this.tableType);
        var row = '';
        if (this.isMobile) {
          row = rowGenerator.createMobileView();
        } else {
          row = rowGenerator.createDesktopView();
        }
        if (!row) {
          return;
        }
        var newRowElement = '';
        if (this.isMobile) {
          newRowElement = document.createElement('div');
          newRowElement.innerHTML = row;
          newRowElement.classList.add('data-b2-item', 'new-row');
        } else {
          newRowElement = document.createElement('tr');
          newRowElement.innerHTML = row;
          newRowElement.classList.add('data-b2-item', 'new-row');
        }

        // Теперь проверяем все изображения внутри newRowElement
        var images = newRowElement.querySelectorAll('.data-b2-item-image img');
        images.forEach(function (img) {
          fetch(img.src).then(function (response) {
            if (response.ok) {
              img.parentElement.classList.add('loaded');
            } else {
              img.parentElement.classList.add('not-loaded');
              img.src = wcl_obj.template_url + '/img/image-placeholder.png';
            }
          })["catch"](function (error) {
            img.parentElement.classList.add('not-loaded');
            img.src = wcl_obj.template_url + '/img/image-placeholder.png';
          });
        });
        var placeholder = wcl_obj.template_url + '/img/image-placeholder.png'; // Ссылка на плейсхолдер

        // Применяем функцию ко всем изображениям
        images.forEach(function (image) {
          _this4.loadImageWithTimeout(image, placeholder);
        });

        // Удаление последней строки, если достигли максимального количества строк
        if (this.isMobile) {
          if (this.table.children.length >= this.maxRows) {
            this.table.removeChild(this.table.lastElementChild);
          }
        } else {
          if (this.table.rows.length >= this.maxRows) {
            this.table.deleteRow(-1);
          }
        }
        this.table.insertBefore(newRowElement, this.table.firstChild);

        // Убираем класс анимации после окончания анимации
        setTimeout(function () {
          newRowElement.classList.remove('new-row');
        }, 1000); // Время анимации
      }
    }
  }, {
    key: "updateTable",
    value: function updateTable(dataArray) {
      var _this5 = this;
      this.table.innerHTML = '';
      dataArray.forEach(function (data) {
        return _this5.addRow(data);
      });
    }
  }]);
}(); // Экспортируем классы для использования в других модулях


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
// This entry need to be wrapped in an IIFE because it need to be isolated against other entry modules.
(() => {
/*!********************************!*\
  !*** ./js/modules/app-main.js ***!
  \********************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
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

  /* 
  sct-10-product
  */
  function loadImageWithTimeout(imageElement, placeholderSrc) {
    var timeout = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 2000;
    var originalSrc = imageElement.getAttribute('src');

    // Создаем новый объект изображения
    var img = new Image();

    // Таймер для отслеживания загрузки
    var timer = setTimeout(function () {
      // Если изображение не загрузилось за 2 секунды, заменяем его на плейсхолдер
      imageElement.setAttribute('src', placeholderSrc);
      imageElement.classList.add('not-found');
      img.src = ''; // Остановить загрузку
    }, timeout);

    // Попытка загрузить изображение
    img.onload = function () {
      clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
      imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
    };
    img.onerror = function () {
      clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
      imageElement.setAttribute('src', placeholderSrc);
      imageElement.classList.add('not-found');
    };

    // Начинаем загрузку
    img.src = originalSrc;
  }

  /* 
  tooltip
  */
  if (document.querySelector('.data-tooltip')) {
    var _section = document.querySelector('.data-tooltip');
    var items = document.querySelectorAll('.data-tooltip');
    items.forEach(function (element) {
      // Mouseover event to show the tooltip content
      element.addEventListener('mouseover', function () {
        element.classList.add('active');
      });

      // Mouseout event to hide the tooltip content
      element.addEventListener('mouseout', function () {
        if (element.classList.contains('active')) {
          element.classList.remove('active');
        }
      });
    });
  }

  /* 
  data-b2-item-image
  */
  if (document.querySelector('.data-b2-item-image')) {
    // loadImageWithTimeout
    var _loadImageWithTimeout = function _loadImageWithTimeout(imageElement, placeholderSrc) {
      var timeout = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 2000;
      var originalSrc = imageElement.getAttribute('src');

      // Создаем новый объект изображения
      var img = new Image();

      // Таймер для отслеживания загрузки
      var timer = setTimeout(function () {
        // Если изображение не загрузилось за 2 секунды, заменяем его на плейсхолдер
        imageElement.setAttribute('src', placeholderSrc);
        img.src = ''; // Остановить загрузку
      }, timeout);

      // Попытка загрузить изображение
      img.onload = function () {
        clearTimeout(timer); // Если изображение загрузилось, отменяем таймер
        imageElement.setAttribute('src', originalSrc); // Устанавливаем оригинальное изображение
      };
      img.onerror = function () {
        clearTimeout(timer); // Если ошибка, заменяем на плейсхолдер
        imageElement.setAttribute('src', placeholderSrc);
      };

      // Начинаем загрузку
      img.src = originalSrc;
    }; // Находим все изображения с классом 'data-b2-item-image'
    var _section2 = document.querySelector('.data-b2-item-image');
    var images = document.querySelectorAll('.data-b2-item-image img'); // Измените на нужный селектор, если необходимо
    var placeholder = wcl_obj.template_url + '/img/image-placeholder.png'; // Ссылка на плейсхолдер

    // Применяем функцию ко всем изображениям
    images.forEach(function (image) {
      _loadImageWithTimeout(image, placeholder);
    });
  }

  /* 
  data-b2-item-image
  */
  if (document.querySelector('.data-b2-item-image')) {
    var _section3 = document.querySelector('.data-b2-item-image');

    // Select all images with the data-b2-item-image attribute
    var _images = document.querySelectorAll('.data-b2-item-image img');
    _images.forEach(function (img) {
      fetch(img.src).then(function (response) {
        if (response.ok) {
          img.parentElement.classList.add('loaded');
        } else {
          img.parentElement.classList.add('not-loaded');
          img.src = wcl_obj.template_url + '/img/image-placeholder.png';
        }
      })["catch"](function (error) {
        img.parentElement.classList.add('not-loaded');
        img.src = wcl_obj.template_url + '/img/image-placeholder.png';
      });
    });
  }

  /* 
  sct-10-product
  */
  if (document.querySelector('.sct-10-product')) {
    // Track the current index in the shuffled array
    // Function to shuffle the array
    var shuffleArray = function shuffleArray(array) {
      for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        // Swap elements
        var _ref = [array[j], array[i]];
        array[i] = _ref[0];
        array[j] = _ref[1];
      }
      return array;
    }; // Function to get a random audio file URL without repetition
    var getRandomAudioFileUrl = function getRandomAudioFileUrl() {
      // Get the already played audio URLs from localStorage
      var playedFiles = JSON.parse(localStorage.getItem('playedFiles')) || [];
      if (currentIndex >= shuffledFiles.length) {
        // Reset the index and shuffle the array again when all files have been played
        currentIndex = 0;
        shuffledFiles = shuffleArray(audioFiles.slice());
      }
      var audioFileUrl;

      // Find the next audio file URL that hasn't been played
      while (currentIndex < shuffledFiles.length) {
        audioFileUrl = shuffledFiles[currentIndex]; // Get the next audio file URL

        if (!playedFiles.includes(audioFileUrl)) {
          // If this audio file hasn't been played, mark it as played
          playedFiles.push(audioFileUrl);
          localStorage.setItem('playedFiles', JSON.stringify(playedFiles)); // Update localStorage
          currentIndex++; // Increment the index for the next call
          return audioFileUrl; // Return the selected audio file URL
        }
        currentIndex++; // Increment index if the file has been played
      }

      // If all files have been played, reset the index and the played files list
      currentIndex = 0;
      localStorage.removeItem('playedFiles'); // Clear the played files
      return audioFileUrl; // Return null if all files have been played
    };
    // Function to play audio
    var playAudio = function playAudio() {
      audio.play();
    }; // Function to stop audio
    var stopAudio = function stopAudio() {
      audio.pause();
      audio.currentTime = 0; // Optional: Reset to the beginning
    };
    var toggleSound = function toggleSound(tableClass) {
      soundStatus[tableClass] = !soundStatus[tableClass]; // Переключаем статус
      saveSoundStatus(tableClass); // Сохраняем в куки
      updateIcon(tableClass); // Обновляем иконки

      if (soundStatus[tableClass] && audio.paused) {
        //playAudio(); // Play audio if it's paused
      } else {
        stopAudio(); // Stop audio if it's currently playing
      }
    };
    var saveSoundStatus = function saveSoundStatus(tableClass) {
      setCookie("".concat(tableClass), soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
    };
    var updateIcon = function updateIcon(tableClass) {
      var icons = _section4.querySelectorAll(".data-b1-icon");
      icons.forEach(function (icon) {
        if (soundStatus[tableClass]) {
          icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-up.svg");
          icon.classList.add('mod-enable');
          icon.classList.remove('mod-disable');
        } else {
          icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-off.svg");
          icon.classList.remove('mod-enable');
          icon.classList.add('mod-disable');
        }
      });
    }; // Show preloader
    var _section4 = document.querySelector('.sct-10-product');
    var soundFileUrl = wcl_obj.sound_url_check_paid;
    var audioContainer = document.getElementById('audio-container');
    var audioFiles = JSON.parse(audioContainer.getAttribute('data-audio-files'));
    var shuffledFiles = shuffleArray(audioFiles.slice()); // Create a shuffled copy of the audio files
    var currentIndex = 0;
    soundFileUrl = getRandomAudioFileUrl();
    var audio = new Audio(soundFileUrl);
    audio.volume = 0.7;
    var defaultValue = true; // Значение по умолчанию
    var dexPaidCookie = getCookie('dex_paid_page_sound');
    var soundStatus = {
      dex_paid_page_sound: dexPaidCookie === 'true' ? true : dexPaidCookie ? false : defaultValue
    };
    var preloader = _section4.querySelector('.preloader');
    preloader.style.display = 'flex'; // Show preloader

    var mint = _section4.getAttribute('data-mint');
    if (!mint) {
      return;
    }
    var data_request = {
      action: 'dex_paid_token_load',
      mint: mint
    };
    var xhr = new XMLHttpRequest();
    xhr.open('POST', wcl_obj.ajax_url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhr.onload = function (data) {
      if (xhr.status >= 200 && xhr.status < 400) {
        var data = JSON.parse(xhr.responseText);
        var status_dex_paid = data.status_dex_paid;
        if (data.token_for_screenshot.trim() === "") {
          _section4.querySelector('.data-b1').style.display = "none";
        } else {
          _section4.querySelector('.data-b1').style.display = "block";
        }
        setTimeout(function () {
          preloader.style.display = 'none'; // Hide preloader

          if (status_dex_paid && data.token_for_screenshot.trim() != "") {
            document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-dex_paid-active');
            document.querySelector('.sct-10-product.mod-generate').classList.add('mod-dex_paid-active');
            tsParticles_init();
          } else {
            document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-dex_paid-no-active');
            document.querySelector('.sct-10-product.mod-generate').classList.add('mod-dex_paid-no-active');
          }
          document.querySelector('.sct-10-product.mod-type-1').classList.add('mod-loaded');
          document.querySelector('.sct-10-product.mod-type-1 .data-inner').innerHTML = data.token;
          document.querySelector('.sct-10-product.mod-generate .data-inner').innerHTML = data.token_for_screenshot;
          init_btn_download();

          // Находим все изображения с классом 'data-b2-item-image'
          var images = document.querySelectorAll('.sct-10-product .data-img img'); // Измените на нужный селектор, если необходимо
          var placeholder = wcl_obj.template_url + '/img/pump-fun-icon.png'; // Ссылка на плейсхолдер

          // Применяем функцию ко всем изображениям
          images.forEach(function (image) {
            loadImageWithTimeout(image, placeholder);
          });
        }, 100);
        if (status_dex_paid && soundStatus.dex_paid_page_sound) {
          setTimeout(function () {
            playAudio();
          }, 0);
        }
        _section4.querySelectorAll('.data-b1-icon').forEach(function (icon) {
          icon.addEventListener('click', function () {
            return toggleSound('dex_paid_page_sound');
          });
        });
      }
      ;
    };
    data_request = new URLSearchParams(data_request).toString();
    xhr.send(data_request);
  }

  /* 
  js-dex-paid-page
  */
  if (document.querySelector('.js-dex-paid-page')) {
    // Function to play audio
    var _playAudio = function _playAudio() {
      _audio.play();
    }; // Function to stop audio
    var _stopAudio = function _stopAudio() {
      _audio.pause();
      _audio.currentTime = 0; // Optional: Reset to the beginning
    };
    var _toggleSound = function _toggleSound(tableClass) {
      _soundStatus[tableClass] = !_soundStatus[tableClass]; // Переключаем статус
      _saveSoundStatus(tableClass); // Сохраняем в куки
      _updateIcon(tableClass); // Обновляем иконки

      if (_soundStatus[tableClass] && _audio.paused) {
        //playAudio(); // Play audio if it's paused
      } else {
        _stopAudio(); // Stop audio if it's currently playing
      }
    };
    var _saveSoundStatus = function _saveSoundStatus(tableClass) {
      setCookie("".concat(tableClass), _soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
    };
    var _updateIcon = function _updateIcon(tableClass) {
      var icons = _section5.querySelectorAll(".data-b1-icon");
      icons.forEach(function (icon) {
        if (_soundStatus[tableClass]) {
          icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-up.svg");
          icon.classList.add('mod-enable');
          icon.classList.remove('mod-disable');
        } else {
          icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/volume-off.svg");
          icon.classList.remove('mod-enable');
          icon.classList.add('mod-disable');
        }
      });
    };
    var _section5 = document.querySelector('.js-dex-paid-page');
    var _soundFileUrl = wcl_obj.sound_url_check_paid;
    var _audio = new Audio(_soundFileUrl);
    _audio.volume = 0.7;
    var _defaultValue = true; // Значение по умолчанию
    var _dexPaidCookie = getCookie('dex_paid_page_sound');
    var _soundStatus = {
      dex_paid_page_sound: _dexPaidCookie === 'true' ? true : _dexPaidCookie ? false : _defaultValue
    };
    _section5.querySelectorAll('.data-b1-icon').forEach(function (icon) {
      icon.addEventListener('click', function () {
        return _toggleSound('dex_paid_page_sound');
      });
    });
    _updateIcon('dex_paid_page_sound');
  }

  /* 
  sct-3-form
  */
  if (document.querySelector('.sct-3-form')) {
    var section = document.querySelector('.sct-3-form');
    var urlParams = new URLSearchParams(window.location.search);
    var url_section = urlParams.get('section');
    section.querySelector('form').addEventListener('submit', function (event) {
      event.preventDefault();
      var actionUrl = this.action;
      var mintValue = this.mint.value;
      var errorMsg = document.querySelector('.data-form-note');
      if (errorMsg) {
        errorMsg.remove();
      }
      if (mintValue.length >= 42 && mintValue.length <= 44) {
        var fullUrl = actionUrl + '?mint=' + encodeURIComponent(mintValue);
        window.location.href = fullUrl;
      } else {
        errorMsg = document.createElement('div');
        errorMsg.classList.add('data-form-note');
        errorMsg.textContent = "Input must be between 42 and 44 characters.";
        var formInner = section.querySelector('.data-form-out');
        if (formInner) {
          formInner.appendChild(errorMsg);
        }
      }
    });
    if (url_section === "check-dexscreener-paid-status") {
      if (scrollTo) {
        var element = document.getElementById('check-dexscreener-paid-status');
        if (element) {
          var elementPosition = element.getBoundingClientRect().top + window.pageYOffset - 100;
          window.scrollTo({
            top: elementPosition,
            behavior: "smooth"
          });
        }
      }
    }
  }

  /* 
  sct-7-promote
   */
  if (document.querySelector('.sct-7-promote')) {
    var _section6 = document.querySelector('.sct-7-promote');
    var section_groove = document.querySelector('.sct-8-gooner');
    _section6.querySelector('form').addEventListener('submit', function (e) {
      e.preventDefault();
      var form = this;
      var mint = form.querySelector('input[name="mint"]').value;
      var errorMsg = document.querySelector('.data-form-note');
      if (errorMsg) {
        errorMsg.remove();
      }
      if (mint.length >= 42 && mint.length <= 44) {} else {
        errorMsg = document.createElement('div');
        errorMsg.classList.add('data-form-note');
        errorMsg.textContent = "Input must be between 42 and 44 characters.";
        var formInner = _section6.querySelector('.data-form-out');
        if (formInner) {
          formInner.appendChild(errorMsg);
        }
        return;
      }
      var data_request = {
        action: 'project_load_posts',
        mint: mint
      };

      // Show preloader
      var preloader = section_groove.querySelector('.preloader');
      preloader.style.display = 'flex'; // Show preloader

      section_groove.querySelector('.data-b1').innerHTML = '';
      if (!section_groove.classList.contains('active')) {
        section_groove.classList.add('active');
      }
      if (section_groove.querySelector('.data-inner')) {
        section_groove.querySelector('.data-inner').classList.add('active');
      }
      document.querySelector('.sct-8-gooner .data-link button').setAttribute('disabled', 'disabled');
      form.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled');
      form.querySelector('input[type="submit"]').classList.add('active');
      var xhr = new XMLHttpRequest();
      xhr.open('POST', wcl_obj.ajax_url, true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
      xhr.onload = function (data) {
        if (xhr.status >= 200 && xhr.status < 400) {
          var data = JSON.parse(xhr.responseText);
          form.querySelector('input[type="submit"]').classList.remove('active');
          form.querySelector('input[type="submit"]').removeAttribute('disabled');
          section_groove.querySelector('.data-b1').innerHTML = data.token;
          section_groove.setAttribute('data-mint', data.mint);
          if (section_groove.querySelector('.data-inner').classList.contains('active')) {
            section_groove.querySelector('.data-inner').classList.remove('active');
          }
          if (!data.token.trim()) {
            // Create the new markup
            var newMarkup = "\n                        <div class=\"data-b2\">\n                            <div class=\"data-b2-img\">\n                                <img src=\"".concat(wcl_obj.template_url, "/img/token-not-found.svg\" alt=\"img\">\n                            </div>\n\n                            <h2 class=\"data-b2-title\">\n                                Not Found\n                            </h2>\n                        </div>\n                        ");
            section_groove.querySelector('.data-b1').insertAdjacentHTML('beforeend', newMarkup);
          } else {
            document.querySelector('.sct-8-gooner .data-link button').removeAttribute('disabled');
          }
          preloader.style.display = 'none';
        }
        ;
      };
      data_request = new URLSearchParams(data_request).toString();
      xhr.send(data_request);
    });
  }

  /* 
  sct-10-product mod-active
  */
  function init_btn_download() {
    if (document.querySelector('.data-btn-download')) {
      document.querySelector('.data-btn-download').addEventListener('click', function (e) {
        e.preventDefault();
        html2canvas(document.querySelector('#product-to-img'), {
          useCORS: true,
          // Разрешить кросс-доменные изображения
          allowTaint: true // Разрешить таинственные изображения
        }).then(function (canvas) {
          var link = document.createElement('a');
          link.href = canvas.toDataURL('image/jpeg');
          link.download = 'pump_black_image.jpg'; // Название сохраняемого файла
          link.click();
        });
      });
    }
  }

  /* 
  sct-8-gooner
  */
  if (document.querySelector('.sct-8-gooner')) {
    var _section7 = document.querySelector('.sct-8-gooner');
    _section7.querySelector('.data-link button').addEventListener('click', function () {
      var self = this;
      var product = _section7.querySelector('.data-item.active');
      var notice = _section7.querySelector('.data-notice'); // Контейнер для отображения заметки

      if (!product) {
        if (!notice) {
          notice = document.createElement('div');
          notice.classList.add('data-notice');
          _section7.querySelector('.data-inner').appendChild(notice);
        }
        notice.textContent = 'Please select a plan to continue.';
      } else {
        var plan = product.getAttribute('data-plan');
        if (notice) {
          notice.remove();
        }
        var _mint = _section7.getAttribute('data-mint');
        var _data_request = {
          action: 'np_create_payment',
          mint: _mint,
          plan: plan
        };
        if (_section7.querySelector('.data-inner')) {
          _section7.querySelector('.data-inner').classList.add('active');
        }
        self.setAttribute('disabled', 'disabled');
        self.classList.add('active');
        var _xhr = new XMLHttpRequest();
        _xhr.open('POST', wcl_obj.ajax_url, true);
        _xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        _xhr.onload = function (data) {
          if (_xhr.status >= 200 && _xhr.status < 400) {
            var data = JSON.parse(_xhr.responseText);
            self.removeAttribute('disabled');
            self.classList.remove('active');
            if (_section7.querySelector('.data-inner').classList.contains('active')) {
              _section7.querySelector('.data-inner').classList.remove('active');
            }
            if (data.success) {
              window.location.href = data.data.payment_url;
            } else {
              if (!notice) {
                notice = document.createElement('div');
                notice.classList.add('data-notice');
                _section7.querySelector('.data-inner').appendChild(notice);
              }
              notice.textContent = data.data.error;
            }
          }
          ;
        };
        _data_request = new URLSearchParams(_data_request).toString();
        _xhr.send(_data_request);
      }
    });
    _section7.querySelectorAll('.data-item-inner').forEach(function (element) {
      element.addEventListener('click', function (e) {
        if (_section7.querySelector('.data-link button').classList.contains('active')) {
          return;
        }
        var self = element.parentElement;
        var notice = _section7.querySelector('.data-notice');
        _section7.querySelectorAll('.data-item').forEach(function (element) {
          element.classList.remove('active');
        });
        if (self.classList.contains('active')) {
          self.classList.remove('active');
        } else {
          self.classList.add('active');
        }
        if (notice) {
          notice.remove();
        }
      });
    });
  }

  /* 
  setCookie
  */
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  // Функция для получения куки
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  /* 
  wcl-tsparticles
  */
  function tsParticles_init() {
    if (document.querySelector('.wcl-tsparticles')) {
      var _section8 = document.querySelector('.wcl-tsparticles');
      if (true) {
        tsParticles.load('tsparticles', {
          fpsLimit: 60,
          fullScreen: {
            enable: false
          },
          particles: {
            number: {
              value: 0
            },
            color: {
              value: ["#B68EC1", "#D16B77", "#A23E4E", "#B59BCE", "#B49DCB", "#8A4CC0", "#C41E6D", "#B58BCC", "#D87D8D"]
            },
            shape: {
              type: ["square"]
            },
            opacity: {
              value: 1,
              animation: {
                enable: true,
                minimumValue: 0,
                speed: 1,
                startValue: "max",
                destroy: "min"
              }
            },
            size: {
              value: {
                min: 2,
                max: 13
              },
              random: {
                enable: true,
                minimumValue: 3
              }
            },
            links: {
              enable: false
            },
            line_linked: {
              enable: true,
              distance: 150,
              color: "#ffffff",
              opacity: 0.5,
              width: 1
            },
            life: {
              duration: {
                sync: true,
                value: 3
              },
              count: 1
            },
            move: {
              enable: true,
              gravity: {
                enable: true,
                acceleration: 111
              },
              speed: 15,
              decay: 0.3,
              direction: "top",
              random: false,
              straight: false,
              outModes: {
                "default": "destroy",
                top: "none"
              }
            },
            rotate: {
              value: {
                min: 0,
                max: 360
              },
              direction: "random",
              move: true,
              animation: {
                enable: true,
                speed: 60
              }
            },
            tilt: {
              enable: true,
              direction: "random",
              move: true,
              value: {
                min: 0,
                max: 360
              },
              animation: {
                enable: true,
                speed: 60
              }
            },
            roll: {
              enable: true,
              speed: {
                min: 15,
                max: 25
              }
            },
            wobble: {
              distance: 30,
              enable: true,
              move: true,
              speed: {
                min: -15,
                max: 15
              }
            }
          },
          emitters: [{
            direction: "top",
            rate: {
              delay: 0.2,
              quantity: 15
            },
            position: {
              x: 0,
              y: 0
            },
            size: {
              width: 28,
              height: 55
            },
            particles: {
              move: {
                angle: {
                  offset: -15,
                  value: 60
                }
              }
            }
          }, {
            direction: "bottom",
            rate: {
              delay: 0.2,
              quantity: 2
            },
            position: {
              x: 0,
              y: 0
            },
            size: {
              width: 25,
              height: 25
            },
            particles: {
              size: {
                value: {
                  min: 11,
                  max: 16
                },
                random: {
                  enable: true,
                  minimumValue: 11
                }
              },
              move: {
                gravity: {
                  enable: true,
                  acceleration: 100
                },
                speed: 25,
                decay: 0.3,
                direction: "random",
                random: true,
                straight: true,
                outModes: {
                  "default": "destroy",
                  top: "none"
                }
              }
            }
          }, {
            direction: "bottom",
            rate: {
              delay: 0.15,
              quantity: 15
            },
            position: {
              x: 0,
              y: 0
            },
            size: {
              width: 25,
              height: 88
            },
            particles: {
              move: {
                angle: {
                  offset: -15,
                  value: 60
                }
              }
            }
          },
          // right
          {
            direction: "top",
            rate: {
              delay: 0.2,
              quantity: 15
            },
            position: {
              x: 100,
              y: 0
            },
            size: {
              width: 25,
              height: 55
            },
            particles: {
              move: {
                angle: {
                  offset: -15,
                  value: 60
                }
              }
            }
          }, _defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty({
            direction: "none"
          }, "direction", "bottom"), "rate", {
            delay: 0.2,
            quantity: 2
          }), "position", {
            x: 100,
            y: 0
          }), "size", {
            width: 25,
            height: 25
          }), "particles", {
            size: {
              value: {
                min: 11,
                max: 16
              },
              random: {
                enable: true,
                minimumValue: 11
              }
            },
            move: {
              gravity: {
                enable: true,
                acceleration: 100
              },
              speed: 25,
              decay: 0.3,
              direction: "random",
              random: true,
              straight: true,
              outModes: {
                "default": "destroy",
                top: "none"
              }
            }
          }), {
            direction: "bottom",
            rate: {
              delay: 0.15,
              quantity: 15
            },
            position: {
              x: 100,
              y: 0
            },
            size: {
              width: 25,
              height: 88
            },
            particles: {
              move: {
                angle: {
                  offset: -15,
                  value: 60
                }
              }
            }
          }]
        });
      }
    }
  }
});
})();

// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!****************************************!*\
  !*** ./js/modules/app-table-fields.js ***!
  \****************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_tableManager__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/tableManager */ "./js/modules/components/tableManager.js");
/* harmony import */ var _components_copyToClipboard__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/copyToClipboard */ "./js/modules/components/copyToClipboard.js");
/* harmony import */ var _components_sound__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/sound */ "./js/modules/components/sound.js");
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }



document.addEventListener('DOMContentLoaded', function () {
  var tableManagerBigBuys = new _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.TableManager('BigBuys', wcl_obj.template_url, _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.BigBuysRow);
  var tableManagerDexPaid = new _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.TableManager('DexPaid', wcl_obj.template_url, _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.DexPaidRow);
  var tableManagerLiveStream = new _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.TableManager('LiveStream', wcl_obj.template_url, _components_tableManager__WEBPACK_IMPORTED_MODULE_0__.LiveStreamRow);

  /* 
  socket
  */
  var state = true;
  if (window.location.hostname === 'loc.pump.black') {
    state = false;
  }
  if (state === true) {
    createWebSocketWithProxy();
  } else {
    /* 
    Emulate Socket
    */
    if (document.querySelector('.home') || document.querySelector('.page-template-dex-paid-page')) {
      //	createProcessor(0, 1000);
    }
  }

  /* 
  createWebSocketWithProxy
  */
  function createWebSocketWithProxy() {
    var socket = new WebSocket('wss://site55.online:8080');
    socket.onopen = function () {
      //console.log('WebSocket connection opened with proxy');
    };
    socket.onmessage = function (event) {
      //console.log('Received message:', event.data);

      // Check if the data is a Blob
      if (event.data instanceof Blob) {
        var reader = new FileReader();
        reader.onload = function () {
          try {
            // Parse the result as JSON once the Blob is converted to text
            var jsonData = JSON.parse(reader.result);

            // Логирование полученного JSON
            //console.log('Message from server (parsed):', jsonData);

            // Generate row
            addRowAndPlaySound(jsonData);
          } catch (error) {
            console.error('Error parsing message as JSON:', error);
          }
        };
        // Read the Blob as text
        reader.readAsText(event.data);
      } else {
        //console.log('Received non-Blob message:', event.data);
      }
    };
    socket.onerror = function (error) {
      //console.error('WebSocket error:', error);
    };
    socket.onclose = function () {
      //console.log('WebSocket connection closed');
    };
  }

  /* 
  sct-1-featured-fields mod-big-buys
   */
  if (document.querySelector('.sct-1-featured-fields.mod-big-buys')) {
    var section = document.querySelector('.sct-1-featured-fields.mod-big-buys');
    section.querySelectorAll('.data-b1-icon').forEach(function (element) {
      element.addEventListener('click', function (e) {
        tableManagerBigBuys.togglePause();
        section.querySelectorAll('.data-b1-icon').forEach(function (icon) {
          if (icon.classList.contains('mod-pause')) {
            icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/play.svg");
            icon.classList.add('mod-play');
            icon.classList.remove('mod-pause');
          } else {
            icon.querySelector('img').src = "".concat(wcl_obj.template_url, "/img/pause.svg");
            icon.classList.remove('mod-play');
            icon.classList.add('mod-pause');
          }
        });
      });
    });
  }

  /* 
  Sound for fields
   */
  document.querySelectorAll('.dex_paid .data-b1-icon').forEach(function (icon) {
    icon.addEventListener('click', function () {
      return (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.toggleSound)('dex_paid');
    });
  });
  document.querySelectorAll('.live_stream .data-b1-icon').forEach(function (icon) {
    icon.addEventListener('click', function () {
      return (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.toggleSound)('live_stream');
    });
  });
  document.querySelectorAll('.big_buys .data-b1-icon').forEach(function (icon) {
    icon.addEventListener('click', function () {
      return (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.toggleSound)('big_buys');
    });
  });
  (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.updateIcon)('dex_paid');
  (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.updateIcon)('live_stream');
  (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.updateIcon)('big_buys');

  /* 
  initializeCopyButtons
  */
  (0,_components_copyToClipboard__WEBPACK_IMPORTED_MODULE_1__.initializeCopyButtons)();

  /* 
  addRowAndPlaySound
  */
  function addRowAndPlaySound(obj) {
    if (obj.token_type === 'big_buys') {
      if (document.querySelector('.mod-big-buys')) {
        tableManagerBigBuys.addRow(obj.token);
        if (!tableManagerBigBuys.isPaused) {
          (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.checkAndPlaySoundForTable)('big_buys');
        }
      }
    } else if (obj.token_type === 'dex_paid') {
      if (document.querySelector('.dex_paid')) {
        tableManagerDexPaid.addRow(obj.token);
        (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.checkAndPlaySoundForTable)('dex_paid');
      }
    } else if (obj.token_type === 'live_stream') {
      if (document.querySelector('.live_stream')) {
        tableManagerLiveStream.addRow(obj.token);
        (0,_components_sound__WEBPACK_IMPORTED_MODULE_2__.checkAndPlaySoundForTable)('live_stream');
      }
    }
  }

  /* 
  createProcessor
  */
  function createProcessor(initialIndex, intervalTime) {
    var index = initialIndex;
    function processNextObject() {
      var savedData = wcl_obj.tokenFields;
      if (savedData) {
        var objectArray = savedData;
        if (index < objectArray.length) {
          var obj = objectArray[index];
          addRowAndPlaySound(obj);
          index++;
          if (index >= objectArray.length) {
            index = 0;
          }
        } else {}
      } else {}
    }
    setInterval(processNextObject, intervalTime);
  }

  /* 
  sct-1-featured-fields mod-upcoming-fields
  */
  if (document.querySelector('.sct-1-featured-fields.mod-upcoming-fields')) {
    // Update the dateObject every second
    // Функция для обновления таймера
    var updateCountdown = function updateCountdown(item) {
      // Получаем дату запуска из атрибута data-launch
      var launchDate = new Date(item.getAttribute('data-launch')).getTime(); // время запуска события в миллисекундах
      var daysElem = item.querySelector('.days');
      var hoursElem = item.querySelector('.hours');
      var minutesElem = item.querySelector('.minutes');

      // Обновление таймера каждую секунду
      var countdownInterval = setInterval(function () {
        // Текущее время
        var now = dateObject.getTime(); // берем текущее время из dateObject, который обновляется каждую секунду
        var distance = launchDate - now; // разница между временем запуска и текущим временем

        if (distance > 0) {
          // Рассчитываем оставшиеся дни, часы и минуты
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var _hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
          var _minutes = Math.floor(distance % (1000 * 60 * 60) / (1000 * 60));

          // Обновляем DOM элементы
          daysElem.textContent = days;
          hoursElem.textContent = _hours;
          minutesElem.textContent = _minutes;
        } else {
          // Если время истекло, остановить таймер
          clearInterval(countdownInterval);
          daysElem.textContent = 0;
          hoursElem.textContent = 0;
          minutesElem.textContent = 0;
        }
      }, 1000); // Обновляем каждую секунду
    }; // Находим все элементы с классом 'data-b2-item' и запускаем таймер для каждого
    var _section = document.querySelector('.sct-1-featured-fields.mod-upcoming-fields.mod-desktop');
    var dateString = serverTimeUTC;

    // Split the date and time components
    var _dateString$split = dateString.split(' '),
      _dateString$split2 = _slicedToArray(_dateString$split, 2),
      datePart = _dateString$split2[0],
      timePart = _dateString$split2[1];
    var _datePart$split$map = datePart.split('-').map(Number),
      _datePart$split$map2 = _slicedToArray(_datePart$split$map, 3),
      year = _datePart$split$map2[0],
      month = _datePart$split$map2[1],
      day = _datePart$split$map2[2];
    var _timePart$split$map = timePart.split(':').map(Number),
      _timePart$split$map2 = _slicedToArray(_timePart$split$map, 3),
      hours = _timePart$split$map2[0],
      minutes = _timePart$split$map2[1],
      seconds = _timePart$split$map2[2];
    var dateObject = new Date(year, month - 1, day, hours, minutes, seconds); // month is 0-based

    var incrementDateByOneSecond = function incrementDateByOneSecond() {
      dateObject.setSeconds(dateObject.getSeconds() + 1); // Add one second to the current time
    };
    var intervalId = setInterval(incrementDateByOneSecond, 1000);
    var countdownItems = _section.querySelectorAll('.data-b2-item');

    // Если экран меньше 1025px, выбираем элементы для мобильной версии
    if (window.matchMedia("(max-width: 1025px)").matches) {
      countdownItems = document.querySelector('.sct-1-featured-fields.mod-upcoming-fields.mod-mobile').querySelectorAll('.data-b2-item');
    }

    // Запускаем функцию для каждого элемента таймера
    countdownItems.forEach(function (item) {
      return updateCountdown(item);
    });
  }
});
})();

/******/ })()
;