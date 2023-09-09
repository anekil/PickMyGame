'use client'
import swr from 'swr'
import axios from "axios";
import React from "react";
import { useContext } from 'react';
import {Field} from "formik";
import {OptionContext} from "./searchForm";
import {Checkbox, FormControlLabel} from "@mui/material";
import {Divider} from "@nextui-org/react";


const fetcher = axios.create({ baseURL: 'http://127.0.0.1:8000/api/'});

const listItems = async (handle) => {
    const result = await fetcher.get(handle, { headers: { accept: "application/json" } });
    return result.data;
}

export const OptionsList = () =>  {
    const option = useContext(OptionContext);
    const {data: items, isLoading, error} = swr(option, listItems);

    if (error) return (
        <p>
            An error has occurred
        </p>
    );

    if (isLoading) return (
        <p>
            Loading...
        </p>
    );

    return items.map(item =>
        <div key={item.api_id}>
            <label>
                <Field type="checkbox"
                       name={option}
                       value={`${item.api_id}`}
                       as={FormControlLabel}
                       control={<Checkbox />} />
                {item.name}
            </label>
        </div>
    );
}
