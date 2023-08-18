'use client'
import swr from 'swr'
import axios from "axios";
import React from "react";
import {CheckboxGroup, Checkbox} from "@nextui-org/react";


// TODO docker address
const fetcher = axios.create({ baseURL: 'http://127.0.0.1:8000/api/'});

const listItems = async (handle) => {
    const result = await fetcher.get(handle, { headers: { accept: "application/json" } });
    return result.data;
}

const ApiList = (handle) =>  {
    handle += '?page=1';
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

    const result  = items.map(item =>
        <Checkbox value={item.api_id}>{item.name}</Checkbox>
    );

    return (
        <>{result}</>
    );
}

function SelectList(option) {
    const [groupSelected, setGroupSelected] = React.useState([]);

    return (
        <>
            <p className="text-default-500">Selected: {groupSelected.join(",")}</p>
            <div className="flex flex-col gap-4 h-[500px]">
                <CheckboxGroup
                    label={"Select " + option}
                    color="warning"
                    value={groupSelected}
                    onValueChange={setGroupSelected}
                >
                    { ApiList(option) }
                </CheckboxGroup>
            </div>
        </>
    );
}

export const SelectMechanicsList = () => {
    return (
        SelectList("mechanics")
    );
}

export const SelectCategoriesList = () => {
    return (
        SelectList("categories")
    );
}