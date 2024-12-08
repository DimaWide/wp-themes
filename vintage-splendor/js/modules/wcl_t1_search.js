

// wcl_t1_search

function wcl_t1_search() {
	if (document.querySelector('.wcl-t1-search')) {
		let sections = document.querySelectorAll('.wcl-t1-search');

		sections.forEach(element => {
			element.querySelector('input').addEventListener('focus', function (e) {
				e.target.closest('.wcl-t1-search').classList.add('active')
			})

			element.querySelector('input').addEventListener('focusout', function (e) {
				e.target.closest('.wcl-t1-search').classList.remove('active')
			})
		});
	}
}

export default wcl_t1_search;
