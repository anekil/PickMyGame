'use client'
import swr from 'swr'
import axios from "axios";

const fetcher = axios.create({ baseURL: 'http://127.0.0.1:8000/api/'});

export const listItems = async (handle) => {
    const result = await fetcher.get(handle, { headers: { accept: "application/json" } });
    return result.data;
}

export const ApiList = (handle) =>  {
    handle = handle["option"] + '?page=1';
    console.log(handle);
    const {data: items, isLoading, error} = swr(handle, listItems);

    if (error) return "An error has occurred";
    if (isLoading) return "Loading...";

    console.log(items);

    const result = items.map(item =>
        <li
            key={item.api_id}
        >
            {item.name}
        </li>
    );

    return (
        <ul>{result}</ul>
    );
}
