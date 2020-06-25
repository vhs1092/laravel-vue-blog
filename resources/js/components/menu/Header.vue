<template>
<div class="d-flex flex-md-row align-items-center p-3 px-md-4 mb-1 bg-white border-bottom shadow-sm">
    <div class="container">
        <nav class="my-2 my-md-0 mr-md-3 nav">
            <h5 class="my-0 mr-md-auto font-weight-normal nav mt-2 home" @click="home">Victor Blog</h5>
            <div class="nav  justify-content-end" v-if="$auth.check">
                <div>
                    <b-nav tabs>
                        <b-nav-item v-if="$auth.user.role.name == 'admin'"><a @click.stop="importPost" v-if="$auth.check">Import Posts</a></b-nav-item>
                        <b-nav-item active><a @click.stop="stories" v-if="$auth.check">Stories</a></b-nav-item>
                        <b-nav-item><a @click.stop="newStory" v-if="$auth.check">New Post</a></b-nav-item>
                    </b-nav>
                </div>

            </div>

            <button class="btn btn-outline-info justify-content-end" @click="signIn" v-if="!$auth.check">
                Sign In
            </button>
            <button class="btn btn-outline-primary justify-content-end ml-2" @click="signUp" v-if="!$auth.check">
                Register
            </button>
            <div class="justify-content-end d-flex" v-if="$auth.check">
                <div class="dropdown">
                    <div type="button" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-50,23">
                        <avatar :image="$auth.user.avatar" :width="40" :height="40"></avatar>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" @click.stop="profile">Profile</a>
                        <a class="dropdown-item" @click.stop="signOut">Sign Out</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
</template>

<script>
import Avatar from '@/components/Avatar'

export default {
    name: "Header",
    components: {
        Avatar
    },
    methods: {
        signIn() {
            this.$eventBus.signIn()
        },
        signUp() {
            this.$eventBus.signUp()
        },
        signOut() {
            this.$store.dispatch('auth/logout')
        },
        home() {
            return this.$router.push('/')
        },
        profile() {
            return this.$router.push({
                name: 'edit-profile',
                params: {
                    nickname: this.$auth.user.nickname
                }
            })
        },
        stories() {
            return this.$router.push(`/@${this.$auth.user.nickname}`)
        },
        importPost() {
            return this.$router.push({
                name: 'import-posts'
            })
        },
        newStory() {
            return this.$router.push({
                name: 'new-blog'
            })
        }
    }
}
</script>

<style scoped>
.home {
    cursor: pointer
}
</style>
