import {useRouter} from "next/navigation";

export const GameData = () => {
    const router = useRouter();
    const data = JSON.parse(router.query.game);

    return (
        <div>
            <h1>{data.name}</h1>
            <img src={data.image_url} alt={"data image"} width={120} height={120}/>
            <p>Players: {data.min_players}-{data.max_players}</p>
            <p>Playtime: {data.min_playtime}-{data.max_playtime}</p>
            { data.average_user_rating != null
                ? <p>User rating: {data.average_user_rating}</p> : <></>
            }
            <ul>
                <p>Categories:</p>
                {data.categories.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ul>
            <ol>
                <p>Mechanics:</p>
                {data.mechanics.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ol>
            { data.description != null
                ? <p>Description: {data.description}</p> : <></>
            }
            { data.rules_url != null
                ? <a href={data.rules_url}>Link to rules</a> : <></>
            }
        </div>
    );
}