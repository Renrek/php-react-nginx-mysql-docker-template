import * as React from 'react';
import * as ReactDOMClient from 'react-dom/client';
import './index.scss'
import '../../component.loader';
import { registerComponent } from '../../component.loader';
type AppProps = { num: number };


const Index = ({num}: AppProps) => <h1 className={"test"}>Total Number: {num}</h1>;

registerComponent('number', (element : any, parameters : any) => {
    ReactDOMClient.createRoot(element).render(<Index num={714564234}/>);
});

