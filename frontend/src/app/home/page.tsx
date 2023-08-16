import { Hello } from "@/components/hello";
import { getServerSession } from "next-auth";
import { authOptions } from "@/lib/auth";

export default async function Home() {
    const session = await getServerSession(authOptions)

    return (
        <main>
            <div>
                <Hello {...session} />
            </div>
        </main>
    );
}
