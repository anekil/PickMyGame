import SearchForm from "../../components/searchForm.jsx";

const initialValues = {
    genres: ""
    /*title: '',
    players: 4,
    playtime: [10, 180],
    categories: [],
    mechanics: [],*/
};

export default async function Page() {
    return (
        <main>
            <SearchForm initialValues={initialValues} />
        </main>
    );
}
