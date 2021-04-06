export const login = (email, password, token) => {
    return fetch('/api/login_check', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Bearer': token,
        },
        body: JSON.stringify({
            username: email,
            password: password
        })
    })
        .then((res) => res.json())
        .then(body => body.token)
}