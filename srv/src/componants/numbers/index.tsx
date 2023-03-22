import * as React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import './index.scss'
import '../../component.loader';
import { registerComponent } from '../../component.loader';
type AppProps = { num: number };


const Numbers = ({num}: AppProps) => <h1 className={"test"}>Total Number: {num}</h1>;

registerComponent('number', (element, parameters) => {
    console.log(parameters.tis);
    
    ReactDOMClient.createRoot(element).render(<Numbers num={714564234}/>);
});
