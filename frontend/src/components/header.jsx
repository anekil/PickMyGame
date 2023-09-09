"use client"
import {LoginButton, LogoutButton} from "./buttons";
import {Avatar} from "@nextui-org/react";
import {Grid} from "@mui/material";

export const HeaderAuth = (session) => {
    return (
        <div style={{position: 'absolute', top: '20px', right: '30px',}}>
            <Grid container
                  direction="column"
                  justifyContent="space-evenly"
                  alignItems="flex-end"
                  columns={2}
                  spacing={2}>
                <Grid item><p>Hello {session.user.username}!</p></Grid>
                <Grid item><Avatar src={ session.user.profile_image == null
                                        ? process.env.DEFAULT_PROFILE_IMAGE
                                        : session.user.profile_image }
                                   className="w-20 h-20 text-large" /></Grid>
                <Grid item><LogoutButton /></Grid>
            </Grid>
        </div>
    );
};

export const HeaderUnauth = () => {
    return (
        <div style={{position: 'absolute', top: '20px', right: '30px',}}>
            <LoginButton />
        </div>
    );
};