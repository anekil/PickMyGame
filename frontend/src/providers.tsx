"use client";

import { SessionProvider } from "next-auth/react";
import {NextUIProvider} from "@nextui-org/react";

type Props = {
    children?: React.ReactNode;
};

export const Providers = ({ children }: Props) => {
    return <NextUIProvider><SessionProvider>{children}</SessionProvider></NextUIProvider>;
};
