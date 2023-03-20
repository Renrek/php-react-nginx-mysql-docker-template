
import * as React from 'react';
import * as  ReactDOM from 'react-dom';
import './index.scss'
type AppProps = { num: number };

export const Index = ({num}: AppProps) => <h1 className={"test"}>Total Number: {num}</h1>;
