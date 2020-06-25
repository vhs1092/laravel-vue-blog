<template>
<div>
    <div class="row mb-4 d-flex align-items-center justify-content-lg-center">
        <div class="col-md-9">

            <div class="row shadow p-4 mb-4 bg-white rounded">
                <div class="col-md-12">
                    <div class="row">
                        <div class="row col-sm-12">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="blog-info">
                                        <a class="blog-link" @click.stop="gotoUserBlog">
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
    </div>
</div>
</template>

<script>
import BlogMixin from '@/mixins/BlogMixin'
import Favourite from '@/components/Favourite'

export default {
    name: "Blog",
    props: ['data'],
    mixins: [BlogMixin],
    components: {
            Favourite
        },
    data() {
        return {
            blog: this.data,
        }
    },
    methods: {
        gotoUsersBlogs() {
            this.$router.push({
                name: 'users-blogs',
                params: {
                    nickname: this.blog.author.nickname
                }
            })
        },
        gotoUserBlog() {
            this.$router.push({
                name: 'user-blog',
                params: {
                    nickname: this.blog.author.nickname,
                    slug: this.blog.slug
                }
            })
        }
    }
}
</script>
