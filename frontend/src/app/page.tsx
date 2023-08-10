'use client';

import { useState } from 'react';

const products = [
    { title: 'Cabbage', isFruit: false, id: 1 },
    { title: 'Garlic', isFruit: false, id: 2 },
    { title: 'Apple', isFruit: true, id: 3 },
];

function ShoppingList() {
    const listItems = products.map(product =>
        <li
            key={product.id}
            style={{
                color: product.isFruit ? 'magenta' : 'darkgreen'
            }}
        >
            {product.title}
        </li>
    );

    return (
        <ul>{listItems}</ul>
    );
}

function MyButton() {
    const [count, setCount] = useState(0);
    function handleClick() {
        setCount(count + 1);
        alert('You clicked me ' + count + ' times!');
    }

    return (
        <button onClick={handleClick}>
            Clicked {count} times
        </button>
    );
}

function AboutPage() {
    return (
        <>
            <h1>About</h1>
            <p>Hello there.<br />How do you do?</p>
        </>
    );
}

export default function Home() {
    return (
        <div>
            <h1>Welcome to my app</h1>
            <MyButton/>
            <MyButton/>
            <MyButton/>
            <AboutPage/>
            <ShoppingList/>
        </div>
    );
}
