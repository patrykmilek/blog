import React, { useState } from 'react';

function ExampleComponent() {
    const [message, setMessage] = useState('Hello from React!');

    return (
        <div>
            <h1>{message}</h1>
        </div>
    );
}

export default ExampleComponent;
