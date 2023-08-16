import {LoginButton, LogoutButton} from "./buttons";

export const Hello = (session) => {
    const authorized = session != null && session.user != null;

    return (
        <>
            <h1>Hello</h1>
            { authorized ? (<>
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
            </>) : (
                <LoginButton />
            )}
        </>
    );
};
