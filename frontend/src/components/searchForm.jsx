"use client";
import React, { createContext } from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import Slider from '@mui/material/Slider';
import {OptionsList} from "./lists";
import { useRouter } from 'next/navigation'
import {Button} from "@mui/material";
import Link from "next/link";

export const OptionContext = createContext("");

const SearchForm = ({ initialValues }) => {
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

        alert(JSON.stringify(game))
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

                {/*<div>*/}
                {/*    <label htmlFor="players">Players</label>*/}
                {/*    <Field name="players">*/}
                {/*        {({ field }) => (*/}
                {/*            <Slider*/}
                {/*                {...field}*/}
                {/*                value={field.value}*/}
                {/*                onChange={(event, newValue) => {*/}
                {/*                    field.onChange({ target: { name: field.name, value: newValue } });*/}
                {/*                }}*/}
                {/*                min={1}*/}
                {/*                max={14}*/}
                {/*                marks={true}*/}
                {/*                valueLabelDisplay="auto"*/}
                {/*            />*/}
                {/*        )}*/}
                {/*    </Field>*/}
                {/*</div>*/}

                {/*<div>*/}
                {/*    <label htmlFor="playtime">Playtime</label>*/}
                {/*    <Field name="playtime">*/}
                {/*        {({ field }) => (*/}
                {/*            <Slider*/}
                {/*                {...field}*/}
                {/*                value={field.value}*/}
                {/*                onChange={(event, newValue) => {*/}
                {/*                    field.onChange({ target: { name: field.name, value: newValue } });*/}
                {/*                }}*/}
                {/*                min={10}*/}
                {/*                max={180}*/}
                {/*                valueLabelDisplay="auto"*/}
                {/*            />*/}
                {/*        )}*/}
                {/*    </Field>*/}
                {/*</div>*/}

                {/*<div>*/}
                {/*    <OptionContext.Provider value="categories">*/}
                {/*        <label>Categories</label>*/}
                {/*        <OptionsList />*/}
                {/*    </OptionContext.Provider>*/}
                {/*</div>*/}

                {/*<div>*/}
                {/*    <OptionContext.Provider value="mechanics">*/}
                {/*        <label>Mechanics</label>*/}
                {/*        <OptionsList />*/}
                {/*    </OptionContext.Provider>*/}
                {/*</div>*/}

                <Button variant="contained" type="submit">Search</Button>
            </Form>
        </Formik>
    );
};

export default SearchForm;
