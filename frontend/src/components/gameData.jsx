"use client"
import { useSearchParams } from "next/navigation";

export const GameData = () => {
    const searchParams = useSearchParams();
    const data = JSON.parse(searchParams.get('game'));

    return (
        <div>
            <h1>{data.name}</h1>
            { data.cover.url != null
                ? <img src={data.image_url} alt={"data image"} width={120} height={120}/> : <></>
            }
            { data.summary != null
                ? <p>Summary: {data.summary}</p> : <></>
            }
            <p>Rating: {data.total_rating}</p>
            <ul>
                <p>Categories:</p>
                {data.genres.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ul>
            <ol>
                <p>Themes:</p>
                {data.themes.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ol>
            <ul>
                <p>Keywords:</p>
                {data.keywords.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ul>
            <ul>
                <p>Platforms:</p>
                {data.platforms.map(item =>
                    <li key={item}>{item}</li>
                )}
            </ul>

            { data.multiplayer_modes != null
                    ?   <div>
                        <p>onlinemax: {data.multiplayer_modes.onlinemax}</p>
                        <p>offlinemax: {data.multiplayer_modes.offlinemax}</p>
                        <p>campaigncoop: {data.multiplayer_modes.campaigncoop}</p>
                        <p>lancoop: {data.multiplayer_modes.lancoop}</p>
                        <p>offlinecoop: {data.multiplayer_modes.offlinecoop}</p>
                        <p>onlinecoop: {data.multiplayer_modes.onlinecoop}</p>
                    </div>
                    : <></>
            }

            <p>Screenshots:</p>
            {data.screenshots.map((item, index) => (
                <img key={index} src={item.url} alt={`screenshot-${index}`} width={120} height={120} />
            ))}

            { data.url != null
                ? <a href={data.url}>Link to {data.name}'s page</a> : <></>
            }
        </div>
    );
}