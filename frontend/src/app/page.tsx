import { getServerSession } from "next-auth";
import { authOptions } from "@/lib/auth";
import { HeaderAuth, HeaderUnauth } from "@/components/header";
import { HomeAuth, HomeUnauth } from "@/components/home";

export default async function Home() {
    const session = await getServerSession(authOptions)
    let authorized = session != null && session.user != null;

    return (
        <main>
            <div>
                { authorized ? (<>
                    <HeaderAuth {...session} />
                </>) : (
                    <HeaderUnauth />
                )}

                { authorized ? (<>
                    <HomeAuth />
                </>) : (
                    <HomeUnauth />
                )}
            </div>
        </main>
    );
}
