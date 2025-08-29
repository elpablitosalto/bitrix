document.addEventListener('DOMContentLoaded', function () {
  initClickShowMore();
})


function initClickShowMore() {
  const moreItemsButtons = document.querySelectorAll('.js_more_items');

  moreItemsButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      const idNav = button.getAttribute('data-id-nav');
      const NavNum = button.getAttribute('data-nav-num');
      let NavPageNomer = parseInt(button.getAttribute('data-page-nomer'), 10);
      const NavPageCount = parseInt(button.getAttribute('data-max-page'), 10);

      const btn = document.getElementById(idNav);
      const content = document.querySelector('.js_nav_result_' + NavNum);

      const nav = {
          this_page: NavPageNomer,
          max_page: NavPageCount
      };

      if (!btn.classList.contains('button_state_loading') && content) {
        btn.classList.add('button_state_loading');

        if (nav.this_page < nav.max_page) {
          nav.this_page++;
          const url = window.location.pathname + window.location.search;

          const data = new URLSearchParams();
          data.append('PAGEN_' + NavNum, nav.this_page);
          data.append('AJAX_LOAD', 'Y');

          fetch(url, {
              method: 'POST',
              body: data
          })
          .then(response => response.text())
          .then(responseText => {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = responseText;

            const newContent = tempDiv.querySelector('.js_nav_result_' + NavNum).innerHTML;
            content.insertAdjacentHTML('beforeend', newContent);

            const navStringElement = document.querySelector('.js_nav_string_' + NavNum);
            navStringElement.innerHTML = tempDiv.querySelector('.js_nav_string_' + NavNum).innerHTML;

            initClickShowMore();
            btn.classList.remove('button_state_loading');
          })
          .catch(error => {
            console.error('Error:', error);
            btn.classList.remove('button_state_loading');
          });
        }
      }
    });
  });
}
