<template>
    <div>
        <div class="row shadow p-4 mb-4 bg-white rounded">
            <div class="col-md-12">
                <div class="row">
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="mr-2">
                                    <avatar :image="blog.author.avatar"></avatar>
                                </div>
                                <div class="blog-info">
                                    <a class="blog-link" @click.stop="gotoUsersBlogs">
                                        <p class="author-name">{{blog.author.name}}</p>
                                    </a>
                                    <p class="created_at">{{ago}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="nav-to-user-blog" @click.stop="gotoUserBlog" style="color: black">
                    <div class="row mt-1">
                        <h4>{{ blog.title }}</h4>
                    </div>
                    <div class="row mt-2">
                        <p>{{ body }}</p>
                    </div>
                </a>

                <div class="d-flex flex-row mt-3">
                    <div class="mr-auto">
                        <favourite :favourite="blog" v-if="blog"></favourite>
                    </div>
                    <div class="mt-2 comment-count" style="font-weight: bold">
                        {{ blog.comments_count }} comments
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Favourite from '@/components/Favourite'
    import Avatar from '@/components/Avatar'
    import BlogMixin from '@/mixins/BlogMixin'

    export default {
        name: "Blog",
        props: ['data'],
        mixins: [BlogMixin],
        components: {
            Favourite,
            Avatar
        },
        data() {
            return {
                blog: this.data,
                isDeleted: false
            }
        },
        methods: {
            gotoUsersBlogs() {
                this.$router.push({
                    name: 'users-blogs',
                    params: { nickname: this.blog.author.nickname }
                })
            },
            gotoUserBlog() {
                this.$router.push({
                    name: 'user-blog',
                    params:{
                        nickname: this.blog.author.nickname,
                        slug: this.blog.slug }
                })
            },
            editBlog(blog) {
                this.$router.push({name: 'edit-user-blog', params: { slug: blog.slug}})
            },
            deleteBlog(blog) {
                this.$store.dispatch('blog/deleteBlog', {slug: blog.slug})
                    .then(() => {
                        this.$flash.success({title: 'Delete Story', text: 'Story deleted saccessfully'})
                        this.$emit('deleted', this.blog.id)
                    })
                    .catch(() => {
                        this.$flash.error({title: 'Delete Story', text: 'Error occured deleting story'})
                    })
            }
        }
    }
</script>

<style scoped>
    .author-name {
        font-size: 13px;
    }

    .blog-link {
        color: #515a6e !important;
    }
</style>