import { go } from './routing';
import { findCity } from './services';
import '../main.scss';

findCity().then(function(data) {
  if(data === null)
    go('city');
  else
    go('index');
})
