import "./main.scss";
//import bootstrap from 'bootstrap';
import {Index} from './views/pages/index';
import * as React from 'react';
import * as  ReactDOM from 'react-dom';


ReactDOM.render(<Index num={1234}/>, document.getElementById("target"));


console.log('In main.entry.tsx');

