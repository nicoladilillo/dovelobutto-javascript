import $ from 'jquery';
import { getView, findCity } from './services';
import init from './controller';
import initComponents from './components';

function go(page, data) {
  findCity().then(function (city) {
    var view;
    if ( city === null ) {
      view = getView('city');
    } else {
      view = getView(page);
    }

    var html = init(view, data);
    $('main').html(html);

    if ( city ) {
      initComponents({
        city: city.name,
      });
    }
  })
}

export { go };
