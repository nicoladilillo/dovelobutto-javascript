import $ from 'jquery';
import { getView } from './service';
import init from './controller';

function createNavbar() {
  var view = getView('navbar')
  var template = init(view);
  var navbars = $('navbar');
  navbars = template.replaceAll(navbars);
}

function initComponents() {
  createNavbar();
}

export default initComponents;
