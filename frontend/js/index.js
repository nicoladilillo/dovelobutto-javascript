import { go } from './routing';
import { city } from './services';
import '../main.scss';

city().then( function (data) {
  if(data === null)
    go('city');
  else
    go('index');
})
