import { Providers } from "@/providers";
import React from "react";
import "./globals.css";

export const metadata = {
  title: "Pick Game",
  description: "Page for searching video games",
};

export default function RootLayout({children}: { children: React.ReactNode }) {
    return (
        <html lang="en" className='dark'>
        <body>
        <main className='flex justify-center items-center h-screen overflow-auto bg-pattern'>
        <Providers>
            {children}
        </Providers>
        </main>
        </body>
        </html>
    );
}
