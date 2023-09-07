'use client'
import swr from 'swr'
import axios from "axios";
import React from "react";
import { useContext } from 'react';
import {Field} from "formik";
import {OptionContext} from "./searchForm";

const fetcher = axios.create({ baseURL: 'http://127.0.0.1:8000/api/'});

const listItems = async (handle) => {
    const result = await fetcher.get(handle, { headers: { accept: "application/json" } });
    return result.data;
}

export const OptionsList = () =>  {
    const option = useContext(OptionContext);
    let handle = option;
    const {data: items, isLoading, error} = swr(handle, listItems);

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
        <label>
            <Field type="checkbox" name={option} value={item.api_id}/>
            {item.name}
        </label>
    );
}
