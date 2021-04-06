function getArticles() {
    return fetch('/api/articles', {
        'method': 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then((res) => res.json())
        .then((body) => body['hydra:member']);

}

function getArticleById(id) {
    return fetch(`/api/articles/${id}`, {
        'method': 'GET',
        'Content-Type': 'application/json',
    })
        .then((res) => res.json());
}

export default {
    getArticles,
    getArticleById,
};