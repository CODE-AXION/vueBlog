<template>
    <div>
        <aside :class="`${is_expanded && 'is-expanded'}`">
            <div class="logo">
                <img src="https://avatars.githubusercontent.com/u/97381867?v=4" alt="">
            </div>

            <div class="menu-toggle-wrap">
                <button class="menu-toggle" @click="toggleMenu">
                    <span class="material-icons">keyboard_double_arrow_right</span>
                </button>
            </div>

            <h3>Menu</h3>

            <div class="menu">
                <router-link class="button" to="/admin-create-post">
                    <span class="material-icons">home</span>
                    <span class="text">Create Post</span>

                </router-link>

                <router-link class="button" to="/filter">
                    <span class="material-icons">home</span>
                    <span class="text">Footer</span>

                </router-link>

                <router-link class="button" to="/admin-list-posts">
                    <span class="material-icons">home</span>
                    <span class="text">List Posts</span>

                </router-link>


            </div>

            <div class="flex"></div>
            <div class="menu">
                <router-link to="/settings" class="button">
                    <span class="material-icons">settings</span>
                    <span class="text">Settings</span>
                </router-link>
		    </div>

        </aside>
    </div>
</template>



<script>

export default {

    name: 'Sidebar',

    data(){

        return {

            is_expanded: (localStorage.getItem("is_expanded") === "true"),

        }
    },

    methods:{
        toggleMenu(){

            this.is_expanded = !this.is_expanded

            localStorage.setItem("is_expanded", this.is_expanded)

        }
    }

}



</script>


<style lang="scss" scoped>

aside {

	display: flex;
	flex-direction: column;
	background-color: var(--dark);
	color: var(--light);
	width: calc(2rem + 2rem);
	overflow: hidden;
	min-height: 100vh;
	padding: 1rem;
	transition: 0.2s ease-in-out;

    .flex{
        flex: 1 1 0%
    }

	.logo {

		margin-bottom: 1rem;

		img {
			width: 2rem;
		}
	}

    .menu-toggle-wrap {
		display: flex;
		justify-content: flex-end;
		margin-bottom: 1rem;
		position: relative;
		top: 0;
		transition: 0.2s ease-in-out;
		.menu-toggle {
			transition: 0.2s ease-in-out;
			.material-icons {
				font-size: 2rem;
				color: var(--light);
				transition: 0.2s ease-out;
			}

			&:hover {
				.material-icons {
					color: var(--primary);
					transform: translateX(0.5rem);
				}
			}
		}
	}

    .menu{
        margin: 0 -1rem;
        .button{
            display: flex;
            align-items:center;
            text-decoration: none;
            padding: 0.5rem 1rem;

            transition: 0.2 ease-out;

            .material-icons {
                font-size: 2rem;
                color: var(--light);
                transition: 0.2s ease-out;

            }

            .text{
                color: var(--light);
                transition: 0.2s ease-out;
            }

            &:hover, &.router-link-exact-active {
                background-color: var(--dark-alt);

                .material-icons, .text{
                    color: var(--primary);
                }
            }

            &.router-link-exact-active{
                border-right: 5px solid var(--primary);
            }
        }
    }

    h3, .button .text{
        opacity: 0;
        transition: 0.3s ease-out;
    }


    h3{
        color: var(--grey);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    &.is-expanded{

        width:var(--sidebar-width);

        .menu-toggle-wrap{
            top: -3rem;

            .menu-toggle{
                transform: rotate(-180deg)
            }
        }

        h3, .button .text{
            opacity: 1;
        }

        .button {
            .material-icons{
                margin-right: 1rem;
            }
        }
    }

	@media (max-width: 1024px) {
		position: absolute;
		z-index: 99;
	}

}
</style>
