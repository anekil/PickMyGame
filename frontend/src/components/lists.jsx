'use client'
import swr from 'swr'
import axios from "axios";
import React from "react";
import {CheckboxGroup, Checkbox} from "@nextui-org/react";
import { useContext } from 'react';
import {OptionContext} from "./searchComponents";
import useParameters from "@/components/store/searchParameters";

const fetcher = axios.create({ baseURL: 'http://127.0.0.1:8000/api/'});

const listItems = async (handle) => {
    const result = await fetcher.get(handle, { headers: { accept: "application/json" } });
    return result.data;
}

const ApiList = () =>  {
    const option = useContext(OptionContext);
    let handle = option +'?page=1';
    console.log("list:" + handle)
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
        <Checkbox value={item.api_id} key={item.api_id}>{item.name}</Checkbox>
    );
}

export function SelectList(name) {
    const [groupSelected, setGroupSelected] = React.useState([]);
    const option = useContext(OptionContext);

    const handleChange = (value) => {
        setGroupSelected(value);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        useParameters((state) => state.setMechanicsOrCategories(option, groupSelected.join(",")));
        onSubmit({ [name]: groupSelected.join(",") }); // Adjust inputValue based on your actual logic
    };

    return (
        <>
            <p className="text-default-500">Selected: {groupSelected.join(",")}</p>
            <div className="flex flex-col gap-4 h-[500px]">
                <CheckboxGroup
                    name={ name }
                    label={"Select " + option}
                    color="warning"
                    value={groupSelected}
                    onChange={handleChange}
                    onSubmit={handleSubmit}
                >
                    { ApiList(option) }
                </CheckboxGroup>
            </div>
        </>
    );
}
