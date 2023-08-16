import CredentialsProvider from 'next-auth/providers/credentials'

export const authOptions = {
    providers: [
        CredentialsProvider({
            credentials: {
                username: { label: 'username', type: 'text' },
                password: { label: 'password', type: 'password' }
            },
            async authorize (credentials) {
                let url = process.env.BACKEND_URL + 'login_check'
                let res = await fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(credentials),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                const token = await res.json();
                if (!res.ok || !token) {
                    return null;
                }

                url = process.env.BACKEND_URL + 'profile'
                res = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token.token
                    }
                })
                const user = await res.json();
                if (res.ok && user) {
                    return {
                        token: token.token,
                        user
                    };
                } else {
                    return null;
                }
            }
        }),
    ],

    callbacks: {
        async jwt({ token, user }) {
            if (user) {
                token.user = user.user;
                token.token = user.token;
            }
            return token;
        },
        async session({ session, token }) {
            session.user = token.user;
            return session;
        },
    },
}