"use client";
import { createContext } from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import Slider from '@mui/material/Slider';
import {OptionsList} from "./lists";

export const OptionContext = createContext("");

const SearchForm = () => {
    const initialValues = {
        title: '',
        players: 4,
        playtime: [10, 180],
        categories: [],
        mechanics: [],
    };

    const handleSubmit = (values) => {
        alert(JSON.stringify(values, null, 2));
    };

    return (
        <Formik initialValues={initialValues} onSubmit={handleSubmit}>
            <Form>
                <div>
                    <label htmlFor="title">Game Title</label>
                    <Field type="text" id="title" name="title" />
                    <ErrorMessage name="title" component="div" />
                </div>

                <div>
                    <label htmlFor="players">Players</label>
                    <Field name="players">
                        {({ field }) => (
                            <Slider
                                {...field}
                                value={field.value}
                                onChange={(event, newValue) => {
                                    field.onChange({ target: { name: field.name, value: newValue } });
                                }}
                                min={1}
                                max={14}
                                marks={true}
                                valueLabelDisplay="auto"
                            />
                        )}
                    </Field>
                </div>

                <div>
                    <label htmlFor="playtime">Playtime</label>
                    <Field name="playtime">
                        {({ field }) => (
                            <Slider
                                {...field}
                                value={field.value}
                                onChange={(event, newValue) => {
                                    field.onChange({ target: { name: field.name, value: newValue } });
                                }}
                                min={10}
                                max={180}
                                valueLabelDisplay="auto"
                            />
                        )}
                    </Field>
                </div>

                <div>
                    <OptionContext.Provider value="categories">
                        <label>Categories</label>
                        <OptionsList />
                    </OptionContext.Provider>
                </div>

                <div>
                    <OptionContext.Provider value="mechanics">
                        <label>Mechanics</label>
                        <OptionsList />
                    </OptionContext.Provider>
                </div>

                <div>
                    <button type="submit">Search</button>
                </div>
            </Form>
        </Formik>
    );
};

export default SearchForm;
