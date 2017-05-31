import $ from 'jquery';
import { getView } from './services';
import init from './controller';
import { findCity }  from './services';

function navbar() {
  findCity().then(function (data) {
    var view = getView('navbar')
    var template = init(view, {
      city: data.name,
    });
    var navbars = $('ps-navbar');
    navbars = template.replaceAll(navbars);
  });
}

function initComponents() {
  navbar();
}

export default initComponents;
