

export function init_acf_4_faq() {
    // acf-4-faq
    if (document.querySelector('.acf-4-faq')) {
        const section = document.querySelector('.acf-4-faq');
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
    }
}
