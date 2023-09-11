export { default } from "next-auth/middleware";

export const config = {
    matcher: ['/api/:path*', '/profile/:path*', '/library/:path*', '/search/:path*', '/about/:path*'],
};
