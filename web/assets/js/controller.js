function init($page, data) {
  if(!data) data = {};

  $page.find('.js--search-form').off('submit').on('submit', function(e) {
    e.preventDefault();
    var productName = this.name.value;
    searchOne(productName).then(function (product) {
      if (product.bin) {
        go('found', {
          name: product.name,
          binId: product.bin.id,
          binName: product.bin.name,
        })
      }
      else {
        go('not-found', {
          name: product.name,
        })
      }
    });
  });

}
