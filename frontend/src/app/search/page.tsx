import { ApiList } from "@/components/lists";

export default async function Home() {

    return (
        <main>
            <div>
                <h1>Mechanics</h1>
                <ApiList {...JSON.parse("{\"option\":\"mechanics\"}")} />
                <h1>Categories</h1>
                <ApiList {...JSON.parse("{\"option\":\"categories\"}")} />
            </div>
        </main>
    );
}


