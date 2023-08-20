"use client";

import {InputProps, Slider} from "@mui/material";
import {Card, CardBody, CardHeader, Divider, Input} from "@nextui-org/react";
import React, {ComponentType} from "react";
import {SearchIcon} from "@nextui-org/shared-icons";
import { createContext } from 'react';
import {SelectList} from "@/components/lists";
import {useParametersStore} from "@/components/searchParameters";
import {SubmitButton} from "@/components/buttons";

type CardProps = {
    Input: ComponentType<InputProps>;
    name: string
};

const InputCard = ({ name, Input, }: CardProps) => {
    return (
        <Card>
            <CardHeader className="flex gap-3">
                <h1>{ name }</h1>
            </CardHeader>
            <Divider/>
            <CardBody>
                <Input />
            </CardBody>
        </Card>
    );
}

export const OptionContext = createContext("");
export const SearchForm = () => {

    return (
        <form>
            <InputCard Input={SearchGameInput} name={"Game name"}/>
            <div className="gap-2 grid grid-cols-3 grid-rows-1">
                <InputCard Input={PlayersNumberInput} name={"Players number"}/>
                <InputCard Input={PlaytimeInput} name={"Playtime range"}/>
            </div>
            <div className="gap-2 grid grid-cols-2 grid-rows-1">
                <OptionContext.Provider value="categories">
                    <InputCard Input={SelectList} name={"Categories"}/>
                </OptionContext.Provider>
                <OptionContext.Provider value="mechanics">
                    <InputCard Input={SelectList} name={"Mechanics"}/>
                </OptionContext.Provider>
            </div>
            <SubmitButton />
        </form>
    );
}


const SearchGameInput = () => {
    return (
        <Input
            type="text"
            placeholder="Enter game name"
            labelPlacement="outside"
            endContent={
                <SearchIcon className="text-2xl text-default-400 pointer-events-none flex-shrink-0" />
            }
        />
    );
}

function PlayersNumberInput() {
    const [value, setValue] = React.useState(2);

    const handleChange = (event: Event, value: number | number[], activeThumb: number) => {
        setValue(value as number);
    };

    const handleSubmit = (event : React.FormEvent<HTMLSpanElement>) => {
        event.preventDefault();
        useParametersStore((state) => state.setPlayers(value));
    };

    return (
        <Slider
            onChange={handleChange}
            onSubmit={handleSubmit}
            aria-label="Players"
            valueLabelDisplay="on"
            step={1}
            marks
            min={1}
            max={10}
        />
    );
}

function PlaytimeInput() {
    const [value, setValue] = React.useState<number[]>([10, 20]);

    const handleChange = (event: Event, value: number | number[], activeThumb: number) => {
        setValue(value as number[]);
    };

    const handleSubmit = (event : React.FormEvent<HTMLSpanElement>) => {
        event.preventDefault();
        useParametersStore((state) => state.setPlaytime(value));
    };

    return (
        <Slider
            onChange={handleChange}
            onSubmit={handleSubmit}
            getAriaLabel={() => 'Playtime range'}
            value={value}
            valueLabelDisplay="on"
        />
    );
}

