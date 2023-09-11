"use client"
import { Card, CardBody } from "@nextui-org/react";
import { SearchPageButton } from "./buttons";

export const HomeAuth = () => {
    return (
        <Card>
            <CardBody className="grid place-items-center">
                <iframe src="https://ntmaker.gfto.ru/newneontexten/?image_height=200&image_width=600&image_font_shadow_width=30&image_font_size=80&image_background_color=18181B&image_text_color=38AAFF&image_font_shadow_color=0070F0&image_url=&image_text=Pick my Game&image_font_family=Nickainley&" frameborder='no' scrolling='no' width="600" height="200"></iframe>
                <SearchPageButton />
            </CardBody>
        </Card>
    );
};

export const HomeUnauth = () => {
    return (
        <Card>
            <CardBody className="grid place-items-center">
                <iframe src="https://ntmaker.gfto.ru/newneontexten/?image_height=200&image_width=600&image_font_shadow_width=30&image_font_size=80&image_background_color=18181B&image_text_color=38AAFF&image_font_shadow_color=0070F0&image_url=&image_text=Pick my Game&image_font_family=Nickainley&" frameBorder='no' scrolling='no' width="600" height="200"></iframe>
                <p>You need to log in to search games</p>
            </CardBody>
        </Card>
    );
};