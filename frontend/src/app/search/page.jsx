import SearchForm from "../../components/searchForm.jsx";
import {HeaderAuth, HeaderUnauth} from "../../components/header";
import {getServerSession} from "next-auth";
import {authOptions} from "../../lib/auth";

export default async function Page() {
    const session = await getServerSession(authOptions)
    let authorized = session != null && session.user != null;

    return (
        <main>
            { authorized ? (<>
                <HeaderAuth {...session} />
            </>) : (
                <HeaderUnauth />
            )}
            <SearchForm />
        </main>
    );
}
