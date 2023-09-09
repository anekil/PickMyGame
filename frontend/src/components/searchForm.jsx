"use client";
import React, { createContext } from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import {OptionsList} from "./lists";
import { useRouter } from 'next/navigation'
import { Grid } from "@mui/material";
import {Button, Card, CardBody, CardFooter, CardHeader} from "@nextui-org/react";

const initialValues = {
    title: "",
    genres: [],
    platforms: [],
    themes: []
};

export const OptionContext = createContext("");

const SearchForm = () => {
    const router = useRouter();
    const handleSubmit = async (values) => {
        const url = "http://localhost:8000/api/search";
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: JSON.stringify(values),
        };
        const response = await fetch(url, options);
        const game = await response.json();
        const data = JSON.stringify(game);
        alert(data)
        router.push( `/about?game=${data}`);
    };

    return (
        <Formik initialValues={initialValues} onSubmit={(values) => {handleSubmit(values)}}>
            <Form>
                <Card>
                    <CardHeader className="flex items-center justify-center h-full">
                        <h2>What game would you like to play?</h2>
                    </CardHeader>

                    <CardBody>
                        <div>
                            <h2>Game Title</h2>
                            <Field type="text" id="title" name="title" />
                        </div>
                        <Grid container
                              direction="row"
                              justifyContent="space-evenly"
                              alignItems="stretch"
                              spacing={3}>
                            <Grid item>
                                <div className="card-content max-h-60 overflow-y-auto">
                                    <OptionContext.Provider value="genres">
                                        <h2>Genres</h2>
                                        <OptionsList />
                                    </OptionContext.Provider>
                                </div>
                            </Grid>
                            <Grid item>
                                <div className="card-content max-h-60 overflow-y-auto">
                                    <OptionContext.Provider value="themes">
                                        <h2>Themes</h2>
                                        <OptionsList />
                                    </OptionContext.Provider>
                                </div>
                            </Grid>
                            <Grid item>
                                <div className="card-content max-h-60 overflow-y-auto">
                                    <OptionContext.Provider value="platforms">
                                        <h2>Platforms</h2>
                                        <OptionsList />
                                    </OptionContext.Provider>
                                </div>
                            </Grid>
                        </Grid>
                    </CardBody>
                    <CardFooter className="flex items-center justify-center h-full">
                        <Button variant="solid" color="primary" type="submit" className="mx-auto">Search</Button>
                    </CardFooter>
                </Card>
            </Form>
        </Formik>
    );
};

export default SearchForm;
