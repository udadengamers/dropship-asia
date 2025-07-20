/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/scroll.js ***!
  \********************************/
var page = 1;
if ($("#itemLoad").length > 0) {
  $(window).on('scroll', function () {
    if ($(window).scrollTop() + $(window).height() + 25 >= $(document).height()) {
      page++;
      loadMoreData(page);
    }
  });
}
function loadMoreData(page) {
  // console.log('sad')
  var url;
  var serach = $('input[name="search"]').val();
  var category = $.urlParam('category');
  var tab = $.urlParam('tab');
  url = '?page=' + page;
  if (serach) {
    url = '?page=' + page + '&search=' + serach;
  }
  if (category) {
    url = '?page=' + page + '&category=' + category;
  }
  if (tab) {
    url = '?page=' + page + '&tab=' + tab;
  }
  var ids = $('input[name="ids"]').map(function () {
    return parseInt($(this).val(), 10); // convert to integer
  }).get();
  $.ajax({
    url: url,
    type: "get",
    data: {
      ids: ids
    },
    // pass the ids variable as data
    beforeSend: function beforeSend() {
      $('.ajax-load').show();
    }
  }).done(function (data) {
    // console.log(data.html)
    if (data.html == "") {
      $('.ajax-load').html("No more items found");
      return;
    }
    $('.ajax-load').hide();
    $("#itemLoad").append(data.html);
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    console.log(jqXHR, ajaxOptions, thrownError);
    alert('server not responding...');
  });
}
$.urlParam = function (name) {
  var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
  if (results == null) {
    return null;
  } else {
    return decodeURIComponent(results[1].replace(/\+/g, " "));
  }
};
/******/ })()
;