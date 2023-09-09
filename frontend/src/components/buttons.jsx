"use client";

import { signIn, signOut } from "next-auth/react";
import {Button} from "@nextui-org/react";
import Link from "next/link";
import React from "react";

export const LoginButton = () => {
    return (
        <Button variant="ghost" color="primary" onClick={() => signIn()}>Sign in</Button>
    );
};

export const RegisterButton = () => {
    return (
        <Link href="/register">
            <Button variant="ghost" color="primary">Register</Button>
        </Link>
    );
};

export const LogoutButton = () => {
    return (
        <Button variant="ghost" color="primary" onClick={() => signOut()}>Sign out</Button>
    );
};

export const ProfileButton = () => {
    return (<Link href="/profile">
        <Button variant="ghost" color="primary">Profile</Button>
    </Link>);
};

export const SearchPageButton = () => {
    return (
    <Link href="/search">
        <Button variant="solid" color="primary">Search games</Button>
    </Link>
    );
};