import * as React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import './Login.scss';
import { registerComponent } from '../../component.loader';

const Login : React.FC<{}> = props => {
    
    const [email, setEmail] = React.useState('');
    const [password, setPassword] = React.useState('');

    const handleSubmit = async (event: any) => {
        event.preventDefault();
        const data = {
            "email": email,
            "password": password,
        }
        await fetch('/api/v1/custom/login/verify', {
            method: 'POST',
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => window.location.reload())
        .catch(error => console.log(error));
    }

    return <form style={{width: '200px'}} >   
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
            onClick={handleSubmit}
        >
            Login
        </button>
    </form>;
}

const LoggedIn : React.FC<{}> = props => {

    const handleClick = async () => {
        await fetch('/api/v1/custom/login/logOut', {
            method: 'POST',
            headers: {"Content-Type": "application/json"},
        })
        .then(() => window.location.reload())
        .catch(error => console.log(error));
    }
    return <><button onClick={handleClick}>Log Out</button></>
}

registerComponent('login', (element, parameters )=> {
    const { loggedIn } = parameters;
    const component = loggedIn ? <LoggedIn /> : <Login />
    
    ReactDOMClient.createRoot(element).render(component);
});