<template>
    <div>
        <form enctype="multipart/form-data" novalidate>
            <div class="post-inputs row mb-4">
                <div class="col-sm-12">
                    <div class="title-input form-group">
                        <label for="title">Title:</label>
                        <input v-model="blog.title"
                               placeholder="Post title"
                               name="title"
                               class="form-control"
                               id="title"
                               v-validate="'required|min:3'"/>
                        <error v-show="errors.has('title')">{{ errors.first('title') }}</error>
                    </div>
                    <div class="form-group">
                        <editor @delta="delta" :body="blog.body"></editor>
                        <input type="hidden" name="body" v-model="body" v-validate="'required|min:3'">
                        <error v-show="errors.has('body')">{{ errors.first('body') }}</error>
                    </div>
                </div>
            </div>

            <div class="row post-actions-row float-right mb-4">
                <button class="btn btn-primary" data-save @click="saveBlog" v-if="formType=='new'">Save</button>
                <button class="btn btn-primary" data-update @click="updateBlog" v-if="formType=='edit'">Update</button>
            </div>

            <div class="" ref="contentContainer"></div>
        </form>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Editor from '@/components/blog/Editor'

    export default {
        name: "BlogForm",
        props: {
            type: {
                type: String,
                required: true
            },
            slug: String
        },
        components: {
            Editor,
        },
        data() {
            return {
                body: '',
                image_url: '',
                blog: {
                    title: '',
                    body: ''
                },
                article: null,
                quill: null,
                formType: this.type
            }
        },
        created() {
            if (this.type == 'edit') {
                this.getBlog({slug: this.slug})
                    .then((response) => {
                        this.blog = response.blog
                    })
            }
        },
        methods: {
            ...mapActions({
                getBlog: 'blog/getBlog',
            }),
            delta(value) {
                if(value === '') {
                    return this.body = ''
                }
                this.body = value.getText()
                this.blog.body = value.getContents();
            },
            prepareFormData() {
                const formData = new FormData();
                Object.keys(this.blog).forEach((key) => {
                    if(key === 'body') {
                        formData.append(key, JSON.stringify(this.blog[key]))
                    }else{
                        formData.append(key, this.blog[key])
                    }
                })

                return formData;
            },
            resetForm() {
                this.blog = {
                    title: '',
                    body: '',
                };
                this.image_url = ''
                this.body = ''

                this.$nextTick(() => this.$validator.reset())
            },
            saveBlog(e) {
                e.preventDefault();
                this.$validator.validateAll()
                if (this.errors.any()) return;

                const formData = this.prepareFormData();

                this.$store.dispatch('blog/saveBlog', formData)
                    .then(() =>{
                        this.$flash.success({title: 'New Post', text: 'Post saved successfully'})
                        this.resetForm();
                    })
                    .catch(() => {
                        this.$flash.error({title: 'New Post', text: 'Error occured saving the story'})
                    })

            },
            updateBlog(e){
                e.preventDefault();
                this.$validator.validateAll()
                if (this.errors.any()) return;

                this.blog._method = "PUT"
                const formData = this.prepareFormData();

                this.$store.dispatch('blog/updateBlog', {slug: this.slug, formData})
                    .then(() =>{
                        this.$flash.success({title: 'Update Story', text: 'Story udpated successfully'})
                    })
                    .catch(() => {
                        this.$flash.error({title: 'Update Story', text: 'Error occured updtating story'})
                    })
            }
        }
    }
</script>

<style scoped>

</style>