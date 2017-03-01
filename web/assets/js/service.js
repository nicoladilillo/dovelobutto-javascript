var PRODUCT_URL = 'https://dovelobutto.herokuapp.com/products';

function search(name) {
  return $.getJSON(PRODUCT_URL, {
    name: name
  }).then(function(response) {
    return response.data;
  });
}

function searchOne(name) {
  return search(name).then(function (data) {
    return data[0];
  });
}
