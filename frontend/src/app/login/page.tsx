'use client';

function LoginButton(){
    function handleClick() {
        alert('Clicked');
    }

    return(
        <button onClick={handleClick}>
            Login
        </button>
    )
}

export default function Home() {
    return (
        <div>
            <LoginButton />
        </div>
    );
}
