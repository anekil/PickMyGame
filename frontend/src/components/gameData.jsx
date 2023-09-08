"use client"
import { useSearchParams } from "next/navigation";
import {Card, CardBody, CardFooter, CardHeader, Chip} from "@nextui-org/react";
import {Grid, ImageList, ImageListItem} from "@mui/material";

export const GameData = () => {
    const searchParams = useSearchParams();
    const data = JSON.parse(searchParams.get('game'));

    const name = (<h1>{data.name}</h1>);
    const rating = ( <>
        { data.total_rating != null ?  <>
            <p>Rating: </p>
            <h2>{data.total_rating}</h2> </>: <></>
        } </>);
    const summary = (<>{data.summary != null ? <p>{data.summary}</p>  : <></> }</>);
    const url = ( <>
        { data.url != null
            ? <a href={data.url}>Link to {data.name}'s page</a> : <></>
        } </>);
    const genres = ( <>
        { data.genres != null ? <>
            <h3>Genres:</h3>
            {data.genres.map(item => <Chip key={item}>{item}</Chip>)} </> : <></>
        } </>);
    const themes = ( <>
        { data.themes != null ? <>
            <h3>Themes:</h3>
            {data.themes.map(item => <Chip key={item}>{item}</Chip>)} </> : <></>
        } </>);
    const keywords = ( <>
        { data.keywords != null ? <>
            <h3>Keywords:</h3>
            {data.keywords.map(item =>
                <Chip variant={"bordered"} key={item}>{item}</Chip>)} </> : <></>
        } </>);
    const platforms = ( <>
        { data.platforms != null ? <>
            <h3>Platforms:</h3>
            {data.platforms.map(item =>
                <Chip variant={"bordered"} key={item}>{item}</Chip>)} </> : <></>
        } </>);
    const cover = (<>
        { data.cover != null ?
            <Card><img src={data.cover.url} alt={"data image"} width={120} height={120}/></Card> : <></>
        }</>);
    const screenshots = (<>
        { data.screenshots != null ?
            <Card>
                <CardHeader><h3>Screenshots</h3></CardHeader>
                <CardBody>
                    <ImageList cols={6} gap={8}>
                        {data.screenshots.map((item, index) => (
                            <ImageListItem key={index}>
                                <img
                                    src={item}
                                    alt={`screenshot-${index}`}
                                    loading="lazy"
                                />
                            </ImageListItem>
                        ))}
                    </ImageList>
                </CardBody> </Card> : <></>
        }
    </>);
    const multiplayer = ( <>
        { data.multiplayer_modes != null ?
            <div>
                <p>onlinemax: {data.multiplayer_modes.onlinemax}</p>
                <p>offlinemax: {data.multiplayer_modes.offlinemax}</p>
                <p>campaigncoop: {data.multiplayer_modes.campaigncoop}</p>
                <p>lancoop: {data.multiplayer_modes.lancoop}</p>
                <p>offlinecoop: {data.multiplayer_modes.offlinecoop}</p>
                <p>onlinecoop: {data.multiplayer_modes.onlinecoop}</p>
            </div> : <></>
        }
    </>);

    const description = (
        <Card>
            <CardBody>
                {name}
                {summary}
                {url}
                {rating}
            </CardBody>
        </Card> );
    const tags = (
        <Card>
            <CardBody>
                <Grid container
                      direction="row"
                      justifyContent="space-around"
                      alignItems="center">
                    <Grid item>{genres}</Grid>
                    <Grid item>{themes}</Grid>
                    <Grid item>{keywords}</Grid>
                </Grid>
            </CardBody>
        </Card> );

    return (
        <>
            <Grid container
                  direction="row"
                  alignItems="center">
                <Grid item>{description}</Grid>
                <Grid item>{cover}</Grid>
            </Grid>
            {tags}
            {screenshots}
            {multiplayer}
        </>
    );
}