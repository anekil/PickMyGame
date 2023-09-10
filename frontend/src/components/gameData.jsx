"use client"
import { useSearchParams } from "next/navigation";
import {Card, CardBody, CardHeader, Chip} from "@nextui-org/react";
import {Grid, ImageList, ImageListItem} from "@mui/material";

export const GameData = () => {
    const searchParams = useSearchParams();
    const data = JSON.parse(searchParams.get('game'));

    const name = (<h1>{data.name}</h1>);
    const rating = (<>{ data.total_rating != null ? <h2>Rating: {data.total_rating}</h2> : <></> } </>);
    const summary = (<>{data.summary != null ? <p>{data.summary}</p> : <></> } </>);
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
            <Card><img src={data.cover} alt={"data image"} className="w=1/3"/></Card> : <></>
        }</>);
    const screenshots = (<>
        { data.screenshots != null ?
            <Card className="w-3/4 m-20">
                <CardHeader><h3>Screenshots</h3></CardHeader>
                <CardBody>
                    <ImageList cols={12} gap={8}>
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

    const description = (
        <Card>
            <CardBody>
                <Grid container
                      direction="row"
                      justifyContent="space-between"
                      alignItems="stretch"
                      spacing={3}>
                    <Grid item>{name}</Grid>
                    <Grid item>{rating}</Grid>
                </Grid>
                {url}
                {summary}
                <Grid container
                      direction="row"
                      justifyContent="space-between"
                      alignItems="stretch"
                      spacing={3}>
                    <Grid item>{genres}</Grid>
                    <Grid item>{themes}</Grid>
                    <Grid item>{keywords}</Grid>
                    <Grid item>{platforms}</Grid>
                </Grid>
            </CardBody>
        </Card>);

    return (
        <>
            <Grid container
                  direction="row"
                  justifyContent="space-around"
                  alignItems="center">
                <Grid item className="w-1/2">{description}</Grid>
                <Grid item>{cover}</Grid>
            </Grid>
            {screenshots}
        </>
    );
}