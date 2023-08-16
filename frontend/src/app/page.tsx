import {
    LoginButton,
    LogoutButton,
    ProfileButton,
    RegisterButton,
} from "@/components/buttons";
import { User } from "@/components/user";
import { getServerSession } from "next-auth";
import { authOptions } from "@/lib/auth";

export default async function Home() {
    const session = await getServerSession(authOptions)

    return (
        <main>
            <div>
                <LoginButton />
                <RegisterButton />
                <LogoutButton />
                <ProfileButton />

                <h1>Server Session</h1>
                {session != null ? (
                    <pre>{JSON.stringify(session, null, 2)}</pre>
                ) : (
                    <>no session</>
                )}
                <User {...session} />
            </div>
        </main>
    );
}
