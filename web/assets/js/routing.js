function go(page, data) {
  getView(page).then(function (view) {
    var html = init(view, data);
    $('main').html(html);
    initComponents();
  })
}
