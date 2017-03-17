function handleProduct(product) {
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
}

function init(template, data) {
  if(!data) data = {};

  var html = Mustache.render(template, data);
  
  var $page = $(html);
  $page.find('.js--search-form').off('submit').on('submit', function(e) {
    e.preventDefault();
    var productName = this.name.value;
    searchOne(productName).then(function (product) {
      handleProduct(product);
    });
  });

  $page.find('.js--autocomplete').autocomplete({
    source: function(request, response) {
      search(request.term).then(function(data) {
        for (var i = 0; i < data.length; i++) {
          data[i].label = data[i].name;
        }
        response(data);
      });
    },
    select: function(e, ui) {
      handleProduct(ui.item);
    },
  });

  return $page;
}
