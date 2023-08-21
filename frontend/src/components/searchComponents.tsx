"use client";

import {Card, CardBody, CardHeader, Divider} from "@nextui-org/react";
import React, {ComponentType} from "react";
import { createContext } from 'react';
import {SelectList} from "@/components/lists";
import {SubmitButton} from "@/components/buttons";
import {InputProps} from "@mui/base";
import {PlayersNumberInput, PlaytimeInput, SearchGameInput} from "@/components/inputComponents";

type CardProps = {
    Input: ComponentType<InputProps>
    title: string
    name: string
};

const InputCard = ({ title, name, Input, }: CardProps) => {
    return (
        <Card>
            <CardHeader className="flex gap-3">
                <h1>{ title }</h1>
            </CardHeader>
            <Divider/>
            <CardBody>
                <Input name={ name } />
            </CardBody>
        </Card>
    );
}

export const OptionContext = createContext("");
export const SearchForm = () => {

    return (
        <form>
            <InputCard Input={SearchGameInput} title="Game name" name="title"/>
            <div className="gap-2 grid grid-cols-3 grid-rows-1">
                <InputCard Input={PlayersNumberInput} title="Players number" name="players"/>
                <InputCard Input={PlaytimeInput} title="Playtime range" name="playtime"/>
            </div>
            <div className="gap-2 grid grid-cols-2 grid-rows-1">
                <OptionContext.Provider value="categories">
                    <InputCard Input={SelectList} title="Categories" name="categories"/>
                </OptionContext.Provider>
                <OptionContext.Provider value="mechanics">
                    <InputCard Input={SelectList} title="Mechanics" name="mechanics"/>
                </OptionContext.Provider>
            </div>
            <SubmitButton />
        </form>
    )
}
