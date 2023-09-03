"use client";

import { signIn, signOut } from "next-auth/react";
import {Button} from "@mui/material";
import Link from "next/link";
import React from "react";

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
    return <Link href="/search">Search games</Link>;
};