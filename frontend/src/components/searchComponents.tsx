"use client";

import {InputProps, Slider} from "@mui/material";
import {Card, CardBody, CardHeader, Divider, Input} from "@nextui-org/react";
import React, {ComponentType} from "react";
import {SearchIcon} from "@nextui-org/shared-icons";
import {SelectCategoriesList, SelectMechanicsList} from "@/components/lists";

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

export const SearchForm = () => {
    return (
        <div>
            <InputCard Input={SearchGameInput} name={"Game name"}/>
            <div className="gap-2 grid grid-cols-3 grid-rows-1">
                <InputCard Input={PlayersNumberInput} name={"Players number"}/>
                <InputCard Input={PlaytimeInput} name={"Playtime range"}/>
            </div>
            <div className="gap-2 grid grid-cols-2 grid-rows-1">
                <InputCard Input={SelectMechanicsList} name={"Mechanics"}/>
                <InputCard Input={SelectCategoriesList} name={"Categories"}/>
            </div>
        </div>
    );
}

function valuetext(value: number) {
    return `${value}`;
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

    return (
        <Slider
            aria-label="Players"
            defaultValue={2}
            getAriaValueText={valuetext}
            valueLabelDisplay="on"
            step={1}
            marks
            min={1}
            max={10}
        />
    );
};

const PlaytimeInput = () => {
    const [value, setValue] = React.useState<number[]>([20, 37]);
    const handleChange = (event: Event, newValue: number | number[]) => {
        setValue(newValue as number[]);
    };

    return (
        <Slider
            getAriaLabel={() => 'Playtime range'}
            value={value}
            onChange={handleChange}
            valueLabelDisplay="on"
            getAriaValueText={valuetext}
        />
    );
};

