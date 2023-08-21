import {Input} from "@nextui-org/react";
import {SearchIcon} from "@nextui-org/shared-icons";
import React from "react";
import useParameters from "./store/searchParameters";
import {Slider} from "@mui/material";


export const SearchGameInput = (name) => {
    return (
        <Input
            name={ name }
            type="text"
            placeholder="Enter game name"
            labelPlacement="outside"
            endContent={
                <SearchIcon className="text-2xl text-default-400 pointer-events-none flex-shrink-0" />
            }
        />
    );
}

export function PlayersNumberInput(name) {
    const [value, setValue] = React.useState(2);

    const handleChange = (event, value, activeThumb) => {
        setValue(value);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        useParameters((state) => state.setPlayers(value));
    };

    return (
        <Slider
            name={ name }
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

export function PlaytimeInput(name) {
    const [value, setValue] = React.useState([10, 20]);

    const handleChange = (event, value, activeThumb) => {
        setValue(value);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        useParameters((state) => state.setPlaytime(value));
    };

    return (
        <Slider
            name={ name }
            onChange={handleChange}
            onSubmit={handleSubmit}
            getAriaLabel={() => 'Playtime range'}
            value={value}
            valueLabelDisplay="on"
        />
    );
}

