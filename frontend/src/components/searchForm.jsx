"use client";
import React, { createContext } from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import {OptionsList} from "./lists";
import { useRouter } from 'next/navigation'
import {Button} from "@mui/material";

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
        alert(JSON.stringify(values))
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
                <div>
                    <label htmlFor="title">Game Title</label>
                    <Field type="text" id="title" name="title" />
                    <ErrorMessage name="title" component="div" />
                </div>

                <div>
                    <OptionContext.Provider value="genres">
                        <label>Genres</label>
                        <OptionsList />
                    </OptionContext.Provider>
                </div>

                <div>
                    <OptionContext.Provider value="themes">
                        <label>Themes</label>
                        <OptionsList />
                    </OptionContext.Provider>
                </div>

                <div>
                    <OptionContext.Provider value="platforms">
                        <label>Platforms</label>
                        <OptionsList />
                    </OptionContext.Provider>
                </div>
                <Button variant="contained" type="submit">Search</Button>
            </Form>
        </Formik>
    );
};

export default SearchForm;
