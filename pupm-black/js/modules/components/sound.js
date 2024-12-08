// // sound.js
// import { setCookie, getCookie } from './cookies';

// Функция для установки куки
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Функция для получения куки
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

const soundStatus = {
    dex_paid: getCookie('dex_paid_sound') === 'true' || false,
    live_stream: getCookie('live_stream_sound') === 'true' || false,
    big_buys: getCookie('big_buys_sound') === 'true' || false,
};



export function toggleSound(tableClass) {
    soundStatus[tableClass] = !soundStatus[tableClass];  // Переключаем статус
    saveSoundStatus(tableClass);  // Сохраняем в куки
    updateIcon(tableClass);  // Обновляем иконки
}

function saveSoundStatus(tableClass) {
    setCookie(`${tableClass}_sound`, soundStatus[tableClass].toString(), 7); // Сохраняем на 7 дней
}

export function updateIcon(tableClass) {
    const icons = document.querySelectorAll(`.${tableClass} .data-b1-icon`);
    icons.forEach(icon => {
        if (soundStatus[tableClass]) {
            icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-up.svg`;
            icon.classList.add('mod-enable');
            icon.classList.remove('mod-disable');
        } else {
            icon.querySelector('img').src = `${wcl_obj.template_url}/img/volume-off.svg`;
            icon.classList.remove('mod-enable');
            icon.classList.add('mod-disable');
        }
    });
}

export function checkAndPlaySoundForTable(tableClass) {
    if (soundStatus[tableClass]) {
        playSoundForTable();
    }
}

function playSoundForTable() {
    let soundFileUrl = wcl_obj.sound_file_url;
    const audio = new Audio(soundFileUrl);
    audio.volume = 0.5;
    audio.play();
}