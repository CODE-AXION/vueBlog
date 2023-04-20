<template>
    <div>

        <div class="flex w-8/12 mx-auto items-start mt-8 justify-center">

            <div class="w-full" >

                <h1 class="text-xl font-semibold ">Categories</h1>
                <div class="mt-4 flex items-center" v-for="(category,index) in categories" :key="category.id">

                    <input type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.filterCategories">
                    <h2>{{category.name}} <span>{{category.posts_count}}</span> </h2>
                </div>

            </div>

            <div class="flex flex-wrap gap-4 w-full justify-center items-center">

                <div v-for="post in posts" :key="post.id" class="w-full shadow-md p-4 rounded-md">
                    <h1> {{post.title}} </h1>
                </div>

            </div>
        </div>


    </div>
</template>

<script>


export default {

    name: 'Navbar',

    data(){

        return {
            categories: [],
            posts: [],
            loading: true,
            selected:{

                filterCategories: []
            }
        }
    },

    watch:{
        selected: {
            handler(newValue, oldValue) {
                this.loadCategories()
                this.loadPosts()
            },
            deep: true,
        },
    },
    mounted(){
        this.loadCategories()
        this.loadPosts()
    },

    methods:{

        loadCategories(){

            axios.get('/api/categories',{
                params:{
                    category_id: this.selected
                }
            })
            .then((response) => {this.categories = response.data.data})
        },

        loadPosts(){

            axios.get('/api/posts',{
                 params: this.selected
            })
                .then((response) => {this.posts = response.data.data})
        }
    }
}
</script>
