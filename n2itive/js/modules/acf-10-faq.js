

export function init_acf_10_faq() {
    // acf-10-faq
    if (document.querySelector('.acf-10-faq')) {
        const section = document.querySelector('.acf-10-faq');
        const faqItems = section.querySelectorAll('.data-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.data-item-question');
            const answer = item.querySelector('.data-item-answer');

            question.addEventListener('click', () => {
                section.querySelectorAll('.data-item').forEach(element => {
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

        const tabButtons = document.querySelectorAll('.faq-tab-button');
        const tabPanels = document.querySelectorAll('.faq-tab-panel');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tab = button.getAttribute('data-tab');
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanels.forEach(panel => panel.classList.remove('active'));
                button.classList.add('active');
                document.getElementById(`tab-${tab}`).classList.add('active');
            });
        });
    }
}


