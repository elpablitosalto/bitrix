//TODO демонстрационная функция

(function () {
  function setInnerHTML(elm, html) {
    elm.innerHTML = html;

    Array.from(elm.querySelectorAll("script")).forEach((oldScriptEl) => {
      const newScriptEl = document.createElement("script");

      Array.from(oldScriptEl.attributes).forEach((attr) => {
        newScriptEl.setAttribute(attr.name, attr.value);
      });

      const scriptText = document.createTextNode(oldScriptEl.innerHTML);
      newScriptEl.appendChild(scriptText);

      oldScriptEl.parentNode.replaceChild(newScriptEl, oldScriptEl);
    });
  }

  function getTokens(content) {
    return content.innerHTML.match(/\[FORM\s+?(.*?)\/\]/g) || [];
  }

  function getAttributes(token = '') {
    return (
      token.replace('\t', '').replace('/]', '').match(/(\S+)=["']?((?:.(?!["']?\s+(?:\S+)=|\s*\/?[>"']))+.)["']?/g) || []
    );
  }

  function getParams(attributes = []) {
    let result = {}

    attributes.map(attribute => {
      const item = attribute.split('=')

      console.log('value', item)
      if (item.length === 2) {
        const value = item[1].trim().substring(1, item[1].length - 1),
          key = item[0].toUpperCase()
        if (value) {
          result[key] = value
        }
      }
    })

    return result
  }

  document.addEventListener("DOMContentLoaded", function () {
    const content = document.querySelector(".article__main")

    if (content) {
      const tokens = getTokens(content);

      if (tokens.length) {
        console.log('tokens', tokens)
        tokens.map(token => {
          const attributes = getAttributes(token)

          if (attributes.length) {
            const params = getParams(attributes)

            var form_data = new FormData();

            for (var key in params) {
              form_data.append(key, params[key]);
            }

            BX.ajax({
              url: "/form-handler.php",
              data: form_data,
              method: "POST",
              dataType: "html",
              timeout: 30,
              async: true,
              start: true,
              cache: false,
              processData: false,
              preparePost: false,
              onsuccess: function (data) {
                setInnerHTML(content, content.innerHTML.replace(token, data));
              },
              onfailure: function (data) {
                console.error(data);
              },
            });
          }
        })
      }
    }
  })

  document.addEventListener("formSubmit", function (e) {
    console.log("formSubmit", e.detail);
  });

}
)()

function updateParamUrl(param, paramValue) {
  let currentUrl = new URL(window.location.href);
  currentUrl.searchParams.set(param, paramValue);
  history.pushState({}, '', currentUrl);
}

function goToAnchor(anchor) {
  var loc = document.location.toString().split('#')[0];
  document.location = loc + '#' + anchor;
  return false;
}

function scrollToAnchorId(anchor) {
  var anchor = $("#" + anchor);
  $("html, body").animate({
    scrollTop: anchor.offset().top
  }, 1000);
}

function scrollToAnchorClass(anchor, offset = 0) {
  var anchor = $("." + anchor);
  $("html, body").animate({
    scrollTop: (anchor.offset().top - offset)
  }, 1000);
}

$(document).ready(function () {
  initPagination();
});

function initPagination() {
  initClickPagination();
  initClickShowMore();
}

function initClickPagination() {
  $('.js_pagination_link').on('click', function (e) {
    e.preventDefault();
    var NavNum = $(this).data('nav-num');
    var data = new Object();
    var add_url_param_name = $(this).data('add-url-param-name');
    var add_url_param_value = $(this).data('add-url-param-value');
    $.ajax({
      dataType: 'html',
      url: $(this).attr('href'),
      data: data,
      success: function (r) {
        var append = $('<div>' + r + '</div>').find('.js_nav_result_' + NavNum).html();
        $('.js_nav_result_' + NavNum).html(append);
        $('.js_nav_string_' + NavNum).html($('<div>' + r + '</div>').find('.js_nav_string_' + NavNum).html());
        scrollToAnchorClass('js_nav_result_' + NavNum, 100);
        updateParamUrl(add_url_param_name, add_url_param_value);
        initPagination();
      }
    });
    return false;
  });
}

function initClickShowMore() {
  $('.js_more_items').on('click', function (e) {
    e.preventDefault();
    var idNav = $(this).data('id-nav');
    var NavNum = $(this).data('nav-num');
    var NavPageNomer = $(this).data('page-nomer');
    var NavPageCount = $(this).data('max-page');
    var add_url_param_name = $(this).data('add-url-param-name');
    var add_url_param_value = $(this).data('add-url-param-value');

    //alert(NavNum);

    var btn = $('#' + idNav);
    var content = $('.js_nav_result_' + NavNum);
    var nav = {
      this_page: NavPageNomer,
      max_page: NavPageCount
    };

    if (!btn.hasClass('loading') && content.length > 0) {

      btn.addClass('loading');
      if (nav.this_page < nav.max_page) {
        nav.this_page++;
        var url = window.location.pathname + window.location.search;
        //alert(url);
        var data = new Object();
        data['PAGEN_' + NavNum] = nav.this_page;
        data['AJAX_LOAD'] = 'Y';
        $.ajax({
          dataType: 'html',
          url: url,
          data: data,
          success: function (r) {
            console.log(NavNum);
            //alert('.js_nav_result_' + NavNum);
            var append = $('<div>' + r + '</div>').find('.js_nav_result_' + NavNum).html();
            //alert(append);
            //console.log(append);
            var scrollClass = 'js_append_' + NavNum + '_' + nav.this_page;
            $('.js_nav_result_' + NavNum).append('<span class="' + scrollClass + '"></span>' + append);
            $('.js_nav_string_' + NavNum).html($('<div>' + r + '</div>').find('.js_nav_string_' + NavNum).html());
            scrollToAnchorClass(scrollClass, 100);
            updateParamUrl(add_url_param_name, add_url_param_value);
            initPagination();
            btn.removeClass('loading');

          }
        });
      }
    }
    return false;
  });
}