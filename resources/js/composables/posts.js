import { ref } from 'vue';

export default function usePosts(){

    const posts = ref([]);

    const getPosts = () => {

        axios.get("http://app.blog.test:8000/api/get/posts")
        .then((response) => {
            // handle success
            posts.value = response.data.data
        })
    }

    const deletePost = (id) => {
        axios.delete(`http://app.blog.test:8000/api/delete/posts/${id}`)
    }


    return {
        posts,
        getPosts,
        deletePost
    }
}
