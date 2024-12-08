// copyToClipboard.js

// Функция для копирования текста в буфер обмена
function copyToClipboard(text) {
    const dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}

// Основная логика для управления уведомлениями
function initializeCopyButtons() {
    const timeouts = {}; // Объект для хранения таймаутов

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.data-b2-item-ca-btn');
        if (button && !event.target.closest('.data-b2-item-ca-copy-notify')) {
            const item = button.parentElement;
            const notify = item.querySelector('.data-b2-item-ca-copy-notify');
            const dataMint = item.querySelector('.data-b2-item-ca-field').getAttribute('data-mint');

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
                const dataMint = notify.parentElement.previousElementSibling.getAttribute('data-mint');
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
    const timeouts = {}; // Объект для хранения таймаутов

    document.addEventListener('click', function (event) {
        // Ищем кнопку по общему классу
        const button = event.target.closest('.data-ca-btn');
        if (button && !event.target.closest('.data-ca-copy-notify')) {
            const item = button.parentElement;
            const notify = item.querySelector('.data-ca-copy-notify'); // Общий класс для всех уведомлений
            const dataMint = item.querySelector('.data-ca-field').getAttribute('data-mint'); // Общий класс для поля с data-mint

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
                const dataMint = notify.closest('.data-ca-item').querySelector('.data-ca-field').getAttribute('data-mint');
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
export { initializeCopyButtons };