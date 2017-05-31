import $ from 'jquery';
import { getView } from './services';
import init from './controller';

function navbar(data) {
  var view = getView('navbar')
  var template = init(view, {
    city: data.city,
  });
  var navbars = $('ps-navbar');
  navbars = template.replaceAll(navbars);
}

function initComponents(data) {
  navbar(data);
}

export default initComponents;
