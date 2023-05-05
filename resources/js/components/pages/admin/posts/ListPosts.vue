<template>
<div class="w-11/12 m-16 p-8">
    <h1 class="my-8">All Categories</h1>
    <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        title
                    </th>
                    <th scope="col" class="px-6 py-3">
                       meta title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        meta description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        description
                    </th>


                    <th scope="col" class="px-6 py-3">
                        category
                    </th>


                    <th scope="col" class="px-6 py-3">
                        status
                    </th>



                    <th scope="col" class="px-6 py-3">
                        created at
                    </th>


                    <th scope="col" class="px-6 py-3">
                        updated at
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="post in posts" :key="post.id" class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                       {{post.id}}
                    </th>
                    <td class="px-6 py-4">
                        {{post.title}}
                    </td>
                    <td class="px-6 py-4">
                       {{post.meta_title}}
                    </td>
                    <td class="px-6 py-4">
                         {{post.meta_description}}
                    </td>
                    <td class="px-6 py-4">
                        {{post.description.substr(0, 8) + '..'}}
                    </td>
                    <td class="px-6 py-4">
                        {{post.category.name}}
                    </td>
                    <td class="px-6 py-4">
                        {{post.status}}
                    </td>
                    <td class="px-6 py-4">
                        {{post.created_at}}
                    </td>
                           <td class="px-6 py-4">
                        {{post.updated_at}}
                    </td>

                    <td>
                        <v-btn color="blue" size="small" @click="destroyPost(post.id)" > Delete </v-btn>
                    </td>

                    <td>
                        <v-btn color="red" size="small" @click="destroyPost(post.id)" > Delete </v-btn>
                    </td>


                </tr>

            </tbody>
        </table>
    </div>

</div>
</template>


<script>


import { onMounted } from 'vue';
import usePosts  from "../../../../composables/posts";
import { inject } from 'vue'

export default {
    name: 'ListPosts',

    setup(){
        const swal = inject('$swal')
        const {posts, getPosts, deletePost} = usePosts();


        console.log(posts);

        onMounted(getPosts);

        const destroyPost = (id) => {

            swal({
                title: "Delete this Post ?",
                text: "Are you sure? You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => { // <--
                if (result.value) { // <-- if confirmed
                       deletePost(id)
                       getPosts()
                }
            });

        }

        return {
            posts,
            destroyPost
        }
    }
}

</script>

<style>

</style>
