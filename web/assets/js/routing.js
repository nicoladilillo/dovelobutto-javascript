function go(page, data) {
  $('.page').hide();
  $('#page-' + page).show();

  init($('#page-' + page), data);
}
