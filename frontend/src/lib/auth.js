import CredentialsProvider from 'next-auth/providers/credentials'

export const authOptions = {
    providers: [
        CredentialsProvider({
            name: 'Login',
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
                console.log("token: " + JSON.stringify(token) + "\nresponse: " + res.ok)
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
                console.log("user: " + JSON.stringify(user) + "\nresponse: " + res.ok)
                if (res.ok && user) {
                    return {
                        token: token.token,
                        user: user
                    };
                } else {
                    return null;
                }
            }
        }),
    ],

    callbacks: {
        async session({ session, token }) {
            session.user = token.user;
            return session;
        },
        async jwt({ token, user }) {
            if (user) {
                token.user = user;
            }
            return token;
        },
    },
}