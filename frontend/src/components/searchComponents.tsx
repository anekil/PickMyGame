"use client";

import {InputProps, Slider} from "@mui/material";
import {Card, CardBody, CardHeader, Divider, Input} from "@nextui-org/react";
import React, {ComponentType} from "react";
import {SearchIcon} from "@nextui-org/shared-icons";
import { createContext, useContext } from 'react';
import {SelectList} from "@/components/lists";

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
        <div>
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
        </div>
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

const PlayersNumberInput = () => {
    const [value, setValue] = React.useState(2);

    const handleSubmit = (event: any) => {
        event.preventDefault();
    };

    return (
        <Slider
            onChange={(_, val) => setValue(val as number)}
            aria-label="Players"
            valueLabelDisplay="on"
            step={1}
            marks
            min={1}
            max={10}
        />
    );
};

const PlaytimeInput = () => {
    const [value, setValue] = React.useState<number[]>([10, 20]);

    return (
        <Slider
            getAriaLabel={() => 'Playtime range'}
            value={value}
            onChange={(_, val) => setValue(val as number[])}
            valueLabelDisplay="on"
        />
    );
};

