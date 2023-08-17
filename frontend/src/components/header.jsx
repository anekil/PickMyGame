import {LoginButton, LogoutButton} from "./buttons";

export const HeaderAuth = (session) => {
    return (
        <>
            <p>Hello {session.user.username}!</p>
            <img
                src={ session.user.profile_image == null
                    ? process.env.DEFAULT_PROFILE_IMAGE
                    : session.user.profile_image }
                width={100}
                height={100}
                alt={"profile image"}
            />
            <LogoutButton />
        </>
    );
};

export const HeaderUnauth = () => {
    return (
        <>
            <LoginButton />
        </>
    );
};