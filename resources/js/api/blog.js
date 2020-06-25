import axios from 'axios'
let apiPosts = 'https://sq1-api-test.herokuapp.com/posts';

export function saveBlog(payload) {
    return axios.post('/v1/blogs', payload)
}

export function updateBlog({slug, formData}) {
    return axios.post(`/v1/blogs/${slug}`, formData)
}

export function getBlog({slug}) {
    return axios.get(`/v1/blogs/${slug}`)
}

export function deleteBlog({slug}) {
    return axios.delete(`/v1/blogs/${slug}`)
}

export function getBlogs(payload) {
    return axios.get('/v1/blogs', { params: payload})
}

export function getUserBlogs(payload) {
    return axios.get(`/v1/users/${payload.params.nickname}/blogs`, {params: payload.query})
}

export function getUserBlog({nickname, slug}) {
    return axios.get(`/v1/users/${nickname}/blogs/${slug}`)
}
export function importBlogs(payload) {
    return axios.get(apiPosts)
}
export function saveImportedBlogs(payload) {
    return axios.post('/v1/blogs/save_imported', payload)
}
