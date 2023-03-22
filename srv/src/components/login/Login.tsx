import * as React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import './Login.scss';
import { registerComponent } from '../../component.loader';

const Login : React.FC<{}> = props => {
    return <div><p>Login Component here.</p></div>;
}

registerComponent('login', (element)=> {
    ReactDOMClient.createRoot(element).render(<Login />);
});