import * as React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import './Login.scss';
import { registerComponent } from '../../component.loader';

const Login : React.FC<{}> = props => {
    
    const [email, setEmail] = React.useState('');
    const [password, setPassword] = React.useState('');

    return <form style={{width: '200px'}}>   
        <label className='form-label mt-2' htmlFor="email-input">Email</label>
        <input
            required
            className='form-control'
            value={email}
            type="email"
            onChange={(event)=> setEmail(event.target.value)}
            name="email-input" 
            id="email-input" 
        />
        <label className='form-label mt-2' htmlFor="password-input">Password</label>
        <input 
            required
            className='form-control'
            value={password}
            onChange={(event)=> setPassword(event.target.value)}
            type="password" 
            name="password-input" 
            id="password-input" 
        />
        <button 
            type='submit'
            className='btn btn-primary mt-2'
        >
            Login
        </button>
    </form>;
}

registerComponent('login', (element)=> {
    ReactDOMClient.createRoot(element).render(<Login />);
});