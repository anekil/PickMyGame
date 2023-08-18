import { SearchForm } from "@/components/searchComponents";
import {Button} from "@mui/material";
import React from "react";

export default async function Home() {

    const handleSubmit = async (event) => {
        event.preventDefault()
        const data = {
            first: event.target.first.value,
            last: event.target.last.value,
        }

        const jsonData = JSON.stringify(data)
        const url = process.env.BACKEND_URL + 'search'

        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json'
            },
            body: jsonData,
        }

        const response = await fetch(url, options)
        const result = await response.json()
        console.log(result)
    }

    return (
        <main>
            <form>
                <SearchForm />
                <Button type="submit">Submit</Button>
            </form>
        </main>
    );
}


