"use client";

import { signIn, signOut } from "next-auth/react";
import {Button} from "@mui/material";
import Link from "next/link";
import React from "react";
import useParameters from "@/components/store/searchParameters";

export function SubmitButton() {
    const state = useParameters()

    const handleSubmit = async (event) => {
        event.preventDefault();

        let data = {
            name: state.title,
            min_players: state.players,
            max_players: state.players,
            min_playtime: state.playtime[0],
            max_playtime: state.playtime[1],
            categories: state.categories,
            mechanics: state.mechanics
        };

        console.log(data);

        const jsonData = JSON.stringify(data);
        //const url = process.env.BACKEND_URL + 'search';
        const url = 'http://127.0.0.1:8000/api/' + 'search';

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
        state.clearStore();
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

export const SearchPageButton = () => {
    return <Link href="/home/aneta/Documents/PickMyBoardGame/frontend/src/components/searchForm">Search games</Link>;
};