<template>
    <div class="w-full ">

        <div class="flex-1  flex flex-col overflow-hidden">
            <div class="ml-14">
                <Header />
            </div>

            <div class="m-8">

                <div>

                    <div class="mt-4 m-14">
                        <div class="p-6 bg-white rounded-md shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700 capitalize">Create Post</h2>


                        <form @submit.prevent="createPost">
                            <div class="grid grid-cols-1  gap-6 mt-4 sm:grid-cols-2">

                            <div>

                                <div class="mb-4">
                                    <label class="text-gray-700" for="username">Title</label>
                                    <input v-model="formData.title" type="text" class="w-full mt-2 border-gray-500 rounded-md p-2 border" />
                                    <div  v-if="allErrors.errors" >


                                        <div class="text-red-600" v-for="(errorTitle,err) in allErrors.errors.title" :key="err">
                                            {{errorTitle}}
                                        </div>

                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-700" for="username">Meta Title</label>
                                    <input v-model="formData.metaTitle" type="text" class="w-full mt-2 border-gray-500 rounded-md p-2 border" />

                                    <div v-if="allErrors.errors" >
                                        <div class="text-red-600" v-for="(metaTitle,err) in allErrors.errors.metaTitle" :key="err">
                                            {{metaTitle}}
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-700" for="username">Meta Description</label>
                                    <input v-model="formData.metaDescription" type="text" class="w-full mt-2 border-gray-500 rounded-md p-2 border" />
                                    <div v-if="allErrors.errors" >
                                        <div class="text-red-600" v-for="(metaDescription,err) in allErrors.errors.metaDescription" :key="err">
                                            {{metaDescription}}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-700" for="username">Select Your Category</label>
                                    <select v-model="formData.category" class="w-full mt-2 border-gray-500 rounded-md p-2 border" >

                                        <option value="">Select Your Category</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>

                                    </select>
                                    <div v-if="allErrors.errors" >
                                        <div class="text-red-600" v-for="(category,err) in allErrors.errors.category" :key="err">
                                            {{category}}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-4">
                                <div class="mb-4">
                                    <label for=""> Content : </label>
                                    <textarea v-model="formData.description" name="" class="border border-slate-700 rounded" id="" cols="70" rows="10"></textarea>
                                    <div v-if="allErrors.errors" >
                                        <div class="text-red-600" v-for="(description,err) in allErrors.errors.description" :key="err">
                                            {{description}}
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input true-value="1" false-value="0" type="checkbox" value="1" v-model="formData.status" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-900">Toggle me</span>
                                    </label>
                                </div>


                                <div>

                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800  font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2  focus:outline-none ">
                                        Create Post
                                    </button>
                                </div>

                            </div>


                            </div>
                        </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>


<script>

import Header from '../../../Navbar.vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';


import router from '../../../../router/router'

export default {

    name: 'CreatePost',
     components:{
        Header
    },

    data(){
        return {

            allErrors:[],
            categories:[],
            formData:{

                title: '',
                metaTitle: '',
                metaDescription: '',
                category: '',
                description: '',
                status: ''
            }
        }
    },

     mounted(){
        this.loadCategories()

    },

    methods: {

        createPost(){

            axios.post("http://app.blog.test:8000/api/store-post",this.formData ).then((response) => {

                this.allError = []

                toast.success("Post Created !", {
                    autoClose: 1000,
                });
                    router.push({ name: 'ListsPosts'});

            })
            .catch((error) => {

                if(error.response.status){
                    this.allErrors = error.response.data

                    setTimeout(() => {this.allErrors = []}, 3000);
                }
            });

        },

        loadCategories(){
            axios.get("http://app.blog.test:8000/api/get/categories")
            .then((response) => {
                // handle success
                this.categories = response.data.data
            })
        }

    }

}
</script>

<style>

</style>
