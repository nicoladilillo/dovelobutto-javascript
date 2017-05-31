import $ from 'jquery';
import index from '../views/index.mustache';
import found from '../views/found.mustache';
import navbar from '../views/navbar.mustache';
import email from '../views/email.mustache';
import notFound from '../views/not-found.mustache';
import city from '../views/city.mustache';

function detsroyCity() {
  return $.ajax('/destroy');
}

function findCity() {
  return $.getJSON('/city').then(
    function(response) {
      return response.data;
  });
}

function selectCity(name) {
  return $.getJSON('/searchcity', {
    name: name
  }).then(function(response) {
    return response.data;
  });
}

function selectOne(name) {
  return selectCity(name).then(function (data) {
    return data[0];
  });
}

function saveProduct(name, email) {
  return $.ajax('/email', {
    contentType: 'application/json',
    data: JSON.stringify({
      email: email,
      name: name,
    }),
    method: 'post',
  });
}

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
    city: city,
  };

  return views[name];
}

export { getView, search, searchOne, saveProduct, selectCity, findCity, selectOne, detsroyCity};
