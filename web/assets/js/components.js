function createNavbar() {
  getView('navbar').then(function(view) {
    var template = init(view);
    var navbars = $('navbar');
    navbars = template.replaceAll(navbars);
  });
}

function initComponents() {
  createNavbar();
}
