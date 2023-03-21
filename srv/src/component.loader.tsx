console.log('in component loader');

interface IComponentCallback {
    (element: HTMLElement, parameters: any) : void;
}

const componentMap = new Map<string, IComponentCallback>();

export const registerComponent = (id: string, callback: IComponentCallback) => {
    componentMap.set(id, callback);
}

document.addEventListener('DOMContentLoaded', () => {
    const targetElements = document.body.querySelectorAll('.react-component');
    targetElements.forEach( element => {
        const component = element.attributes.getNamedItem('data-component')!.value!;
        //const data = element.attributes.getNamedItem('data-parameters')!.value!;
        const parameters = {};//JSON.parse(Buffer.from(data).toString('base64')) ?? 'null';

        const componentCallback = componentMap.get(component);
        if (componentCallback) {
            componentCallback(element as HTMLElement, parameters as any);
        } else {
            console.log('Unknown component request' + component);
        }

        
        element.classList.remove('react-component');
        element.classList.add('loaded');
    });
});