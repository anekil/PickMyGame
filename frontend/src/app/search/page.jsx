"use client";
import React from 'react';
import { Formik, Form, Field, ErrorMessage } from 'formik';
import Slider from '@mui/material/Slider';

const SearchForm = () => {
    // Set the initial values for the form fields
    const initialValues = {
        title: '',
        minPlayers: 1,
        maxPlayers: 4,
        minDuration: 30,
        maxDuration: 120,
        categories: []
    };

    // This function is called when the form is submitted
    const handleSubmit = (values) => {
        // Display form data in an alert
        alert(JSON.stringify(values, null, 2));
    };

    // The component starts here
    return (
        // We're using Formik to manage the form
        <Formik initialValues={initialValues} onSubmit={handleSubmit}>
            {/* Inside the Formik component, we define the form */}
            <Form>
                {/* Inside the form, we define the form fields */}

                {/* For example, a text input field for the game title */}
                <label htmlFor="title">Game Title</label>
                <Field type="text" id="title" name="title" />
                <ErrorMessage name="title" component="div" />

                {/* Using Material-UI Slider for minPlayers */}
                <label htmlFor="minPlayers">Min Players</label>
                {/* The Field component is used to wrap the Slider */}
                <Field name="minPlayers">
                    {/* We're using the Slider component */}
                    {({ field }) => (
                        <Slider
                            {...field}
                            value={field.value}
                            onChange={(event, newValue) => {
                                // When the slider changes, we update the form value
                                field.onChange({ target: { name: field.name, value: newValue } });
                            }}
                            min={1}
                            max={10}
                        />
                    )}
                </Field>

                {/* Similar implementation for maxPlayers */}

                {/* Checkbox inputs for categories */}
                <label>Categories</label>
                {/* Each checkbox is wrapped in a Field */}
                <Field name="categories" type="checkbox" value="strategy" />
                <Field name="categories" type="checkbox" value="party" />
                {/* Add other category options */}

                {/* The submit button */}
                <button type="submit">Search</button>
            </Form>
        </Formik>
    );
};

// The SearchForm component is exported for use in other parts of the app
export default SearchForm;
