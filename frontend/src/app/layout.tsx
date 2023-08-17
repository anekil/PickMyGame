import { Providers } from "@/providers";
import './globals.css'
export const metadata = {
  title: "Pick Board Game",
  description: "Generated by create next app",
};

export default function RootLayout({children}: { children: React.ReactNode }) {
    return (
        <html lang="en" className='dark'>
        <body>
        <Providers>
            {children}
        </Providers>
        </body>
        </html>
    );
}
