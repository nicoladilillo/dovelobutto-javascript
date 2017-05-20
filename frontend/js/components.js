import $ from 'jquery';
import { getView } from './services';
import init from './controller';

function navbar() {
  var view = getView('navbar')
  var template = init(view);
  var navbars = $('ps-navbar');
  navbars = template.replaceAll(navbars);
}

function initComponents() {
  navbar();
}

export default initComponents;
