import $ from 'jquery';
import { getView } from './services';
import init from './controller';
import initComponents from './components';

function go(page, data) {
  var view = getView(page);
  var html = init(view, data);
  $('main').html(html);
  initComponents();
}

export { go };
