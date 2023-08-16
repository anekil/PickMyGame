export const UserSession = (session) => {

    return (
        <>
            <h1>Client Session</h1>
            { session != null ? (<>
                <p>Hello {session.user.username}!</p>
                <br/>
                {session.user.profile_image != null ? (
                    <img
                        src={session.user.profile_image}
                        width={100}
                        height={100}
                        alt={"profile image"}
                    />
                ) : (
                    <>no image</>
                )}
                <pre>{JSON.stringify(session, null, 2)}</pre>
            </>) : (
                <a>unauthenticated</a>
            )}
        </>
    );
};
