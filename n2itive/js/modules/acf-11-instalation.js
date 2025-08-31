

import { sidebar_scroll } from './helpers.js';


export function init_acf_11_instalation() {
      // Fixed on Scroll
      if (document.querySelector('.acf-11-instalation-2')) {
        let section = document.querySelector('.acf-11-instalation-2')
        let sidebar = section.querySelector('.data-sidebar')

        if (window.matchMedia("(min-width: 1199px)").matches) {
            sidebar_scroll(sidebar, section, scroll);
        }

        const tabButtons = section.querySelectorAll('.faq-tab-button');
        const tabPanels = section.querySelectorAll('.faq-tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tab = button.getAttribute('data-tab');
                console.log(tab)

                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.remove('active'));

                button.classList.add('active');
                document.getElementById(`tab-${tab}`).classList.add('active');

                let offset_top = getOffsetTop(section.querySelector(' .data-col:nth-child(1)'));

                if (window.matchMedia("(min-width: 1199px)").matches) {
                    sidebar_scroll(sidebar, section, false, offset_top);
                }
            });
        });
    }
}


