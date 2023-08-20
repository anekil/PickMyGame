"use client";

import { signIn, signOut } from "next-auth/react";
import {Button} from "@mui/material";
import Link from "next/link";
import React from "react";
import {useParametersStore} from "@/components/searchParameters";

export function SubmitButton() {
    const handleSubmit = async (event) => {
        event.preventDefault();
        const data = {
            min_players: useParametersStore((state) => state.players),
            max_players: useParametersStore((state) => state.players),
            min_playtime: useParametersStore((state) => state.playtime[0]),
            max_playtime: useParametersStore((state) => state.playtime[1]),
            categories: useParametersStore((state) => state.categories),
            mechanics: useParametersStore((state) => state.mechanics)
        };

        const jsonData = JSON.stringify(data);
        const url = process.env.BACKEND_URL + 'search';

        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: jsonData,
        };

        const response = await fetch(url, options);
        const result = await response.json();
        console.log(result);
        useParametersStore((state) => state.clearStore());
    }

    return (
        <Button variant="contained" type="submit" onClick={handleSubmit}>Submit</Button>
    );
}

export const LoginButton = () => {
    return (
        <Button variant="contained" onClick={() => signIn()}>Sign in</Button>
    );
};

export const RegisterButton = () => {
    return (
        <Link href="/register" style={{ marginRight: 10 }}>
            Register
        </Link>
    );
};

export const LogoutButton = () => {
    return (
        <Button variant="outlined" onClick={() => signOut()}>Sign out</Button>
    );
};

export const ProfileButton = () => {
    return <Link href="/profile">Profile</Link>;
};
