import { getServerSession } from "next-auth";
import { authOptions } from "@/lib/auth";
import {HeaderAuth} from "@/components/header";

export default async function Home() {
    const session = await getServerSession(authOptions)

    return (
        <main>
            <div>
                <HeaderAuth {...session} />
            </div>
        </main>
    );
}
