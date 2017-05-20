import $ from 'jquery';
import index from '../views/index.mustache';
import found from '../views/found.mustache';
import navbar from '../views/navbar.mustache';
import email from '../views/email.mustache';
import notFound from '../views/not-found.mustache';

var PRODUCT_URL = 'https://dovelobutto.herokuapp.com/products';

function search(name) {
  return $.getJSON('/search', {
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

function getView(name) {
  var views = {
    index: index,
    found: found,
    navbar: navbar,
    email: email,
    'not-found': notFound,
  };

  return views[name];
}

export { getView, search, searchOne };
